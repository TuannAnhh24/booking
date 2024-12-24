<?php

namespace App\Jobs;

use App\Models\RoomList;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteRoomNameJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $roomId;

    /**
     * Tạo một instance mới của Job.
     *
     * @param  int  $roomId
     * @return void
     */
    public function __construct(int $roomId)
    {
        $this->roomId = $roomId;
    }

    /**
     * Xử lý Job.
     *
     * @return void
     */
    public function handle()
    {
        $room = RoomList::find($this->roomId);
        if ($room && $room->name_room !== null) {
            $room->name_room = null;
            $room->save();
        }
    }
}
