<?php

namespace App\Repositories\Eloquent;

use App\Models\Destination;
use App\Repositories\Contracts\SearchRepository;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;

class SearchRepositoryEloquent extends BaseRepository implements SearchRepository
{
    public function model()
    {
        return Destination::class;
    }

    public function searchByLocation($keywords, $startTime, $endTime, $requiredRooms, $people_old)
    {
        $query = $this->model->with($this->hotelRelations($startTime, $endTime));
        $query->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('name', 'like', "%{$keyword}%")
                    ->orWhereHas('locations', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    });
            }
        });
        $query->whereHas('rooms.roomLists', function ($q) use ($startTime, $endTime, $requiredRooms, $people_old) {
            $this->roomAvailabilityQuery($q, $startTime, $endTime, $requiredRooms, $people_old);
        });
        return $query->first();
    }

    public function hotelRelations($startTime, $endTime)
    {
        return [
            'rooms.variants',
            'images',
            'rooms.roomLists' => function ($query) use ($startTime, $endTime) {
                $query->whereDoesntHave('bookings', function ($subQuery) use ($startTime, $endTime) {
                    $subQuery->where(function ($dateQuery) use ($startTime, $endTime) {
                        $dateQuery->whereBetween('available_from', [$startTime, $endTime])
                            ->orWhereBetween('available_to', [$startTime, $endTime])
                            ->orWhere(function ($overlapQuery) use ($startTime, $endTime) {
                                $overlapQuery->where('available_from', '<=', $startTime)
                                    ->where('available_to', '>=', $endTime);
                            });
                    });
                });
            },
            'reviews' => fn($q) => $q
                ->select('destination_id')
                ->selectRaw('
                            AVG(rating +
                                staff_rating + 
                                comfort_rating + 
                                amenities_rating + 
                                value_for_money_rating + 
                                location_rating + 
                                cleanliness_rating
                            ) / 7 as avg_rating
                        ') // Tính trung bình dựa trên tổng các trường
                ->selectRaw('COUNT(id) as review_count')
                ->groupBy('destination_id'),
            'categories',
        ];
    }

    public function roomAvailabilityQuery($query, $startTime, $endTime, $requiredRooms, $people_old)
    {
        $query->join('rooms', 'destinations.id', '=', 'rooms.destination_id')
            ->join('room_lists as room_lists_1', 'rooms.id', '=', 'room_lists_1.room_id')
            ->where('room_lists_1.deleted_at', '=', null)
            ->whereDoesntHave('bookings', function ($subQuery) use ($startTime, $endTime) {
                $subQuery->where(function ($dateQuery) use ($startTime, $endTime) {
                    $dateQuery->whereBetween('available_from', [$startTime, $endTime])
                        ->orWhereBetween('available_to', [$startTime, $endTime])
                        ->orWhere(function ($overlapQuery) use ($startTime, $endTime) {
                            $overlapQuery->where('available_from', '<=', $startTime)
                                ->where('available_to', '>=', $endTime);
                        });
                });
            });
        $query->selectRaw('
        destinations.id AS destination_id,  
        destinations.name AS destination_name,  
        COUNT(DISTINCT room_lists_1.room_id) AS total_rooms,  
        SUM(rooms.guest_quantity) AS total_guests')
            ->groupBy('destinations.id')
            ->havingRaw('SUM(rooms.guest_quantity) >= ?', [$people_old])
            ->havingRaw('COUNT(DISTINCT room_lists_1.id) >= ?', [$requiredRooms]);

        return $query;
    }


    public function searchOtherHotels($exactHotel, $locationName, $startTime, $endTime, $requiredRooms, $people_old)
    {
        return $this->model->with($this->hotelRelations($startTime, $endTime))
            ->whereHas('locations', function ($q) use ($locationName) {
                $q->where('name', 'like', "%{$locationName}%");
            })
            ->where('id', '!=', $exactHotel->id)
            ->whereHas('rooms.roomLists', function ($q) use ($startTime, $endTime, $requiredRooms, $people_old) {
                $this->roomAvailabilityQuery($q, $startTime, $endTime, $requiredRooms, $people_old);
            })
            ->get();
    }

    public function filterHotels($locationName, $minPrice, $maxPrice, $categories, $ratings, $convenients, $variants, $startTime, $endTime, $requiredRooms, $people_old)
    {
        $hotelsQuery = $this->model->with($this->hotelRelations($startTime, $endTime));

        if ($locationName) {
            $hotelsQuery->whereHas('locations', fn($q) => $q->where('locations.name', 'like', "%{$locationName}%"));
        }

        if ($minPrice !== null && $maxPrice !== null) {
            $hotelsQuery->whereHas(
                'rooms.variants',
                fn($q) =>
                $q->whereBetween('room_variant.price_per_night', [$minPrice, $maxPrice])
            );
        }

        if (!empty($categories)) {
            $hotelsQuery->whereHas('categories', fn($q) => $q->whereIn('categories.id', $categories));
        }

        if (!empty($ratings)) {
            $hotelsQuery->whereHas(
                'reviews',
                fn($q) =>
                $q->havingRaw('AVG(rating) > ?', [min($ratings)])
            );
        }

        if (!empty($convenients)) {
            $hotelsQuery->whereHas('convenients', fn($q) => $q->whereIn('convenients.id', $convenients));
        }

        if (!empty($variants)) {
            $hotelsQuery->whereHas('rooms.variants', fn($q) => $q->whereIn('variants.id', $variants));
        }

        $hotelsQuery->whereHas('rooms.roomLists', fn($q) => $this->roomAvailabilityQuery($q, $startTime, $endTime, $requiredRooms, $people_old));

        return $hotelsQuery->paginate(PAGINATE_MAX_RECORD);
    }
    public function searchHotelsForPagination($exactHotel, $otherHotels, $locationName, $startTime, $endTime, $requiredRooms, $people_old)
    {
        $query = $this->model->with($this->hotelRelations($startTime, $endTime));
        if ($exactHotel) {
            $query->where('id', '=', $exactHotel->id);
        }

        if ($otherHotels) {
            foreach ($otherHotels as $hotel) {
                $query->orWhere('id', '=', $hotel->id);
            }
        }
        $query->whereHas('locations', function ($q) use ($locationName) {
            $q->where('name', 'like', "%{$locationName}%");
        });

        $query->whereHas('rooms.roomLists', function ($q) use ($startTime, $endTime, $requiredRooms, $people_old) {
            $this->roomAvailabilityQuery($q, $startTime, $endTime, $requiredRooms, $people_old);
        });

        return $query->paginate(10);
    }
}
