<?php

namespace App\Http\Middleware;

use App\Repositories\Contracts\CharacteristicRepository;
use Closure;
use Illuminate\Http\Request;

class CheckCharacteristicExists
{
    protected $characteristicRepository;

    public function __construct(CharacteristicRepository $characteristicRepository)
    {
        $this->characteristicRepository = $characteristicRepository;
    }
    public function handle(Request $request, Closure $next)
    {
        $characteristicId = $request->route('id');

        if (!$this->characteristicRepository->find($characteristicId)) {
            return redirect()->route('admin.characteristic.index')
                ->with('error', __('content.midleware.notfound'));
        }
        return $next($request);
    }
}
