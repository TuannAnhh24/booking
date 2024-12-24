<?php

namespace App\Http\Middleware;

use App\Repositories\Contracts\DestinationRepository;
use Closure;
use Illuminate\Http\Request;

class CheckHotelIdExists
{
    protected $destinationRepository;
    public function __construct(DestinationRepository $destinationRepository)
    {
        $this->destinationRepository = $destinationRepository;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $destinationId = $request->route('id');

        if (!$this->destinationRepository->find($destinationId)) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}
