<?php

namespace App\Http\Middleware;

use App\Repositories\Contracts\CharacteristicRepository;
use App\Repositories\Contracts\ConvenientRepository;
use Closure;
use Illuminate\Http\Request;

class CheckConvenientExists
{
    protected $convenientRepository;

    public function __construct(ConvenientRepository $convenientRepository)
    {
        $this->convenientRepository = $convenientRepository;
    }
    public function handle(Request $request, Closure $next)
    {
        $convenientId = $request->route('id');

        if (!$this->convenientRepository->find($convenientId)) {
            return redirect()->route('admin.convenients.index')
                ->with('error', __('content.midleware.notfound'));
        }
        return $next($request);
    }
}
