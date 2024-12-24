<?php

namespace App\Http\Middleware;

use App\Repositories\Contracts\LocationRepository;
use Closure;
use Illuminate\Http\Request;

class CheckLocationExists
{
    protected $locationRepository;

    public function __construct(LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }
    public function handle(Request $request, Closure $next)
    {
        $locationId = $request->route('id');

        if (!$this->locationRepository->find($locationId)) {
            return redirect()->route('admin.locations.index')
                ->with('error', __('content.midleware.notfound'));
        }
        return $next($request);
    }
}
