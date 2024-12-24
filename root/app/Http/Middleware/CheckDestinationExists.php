<?php
namespace App\Http\Middleware;

use App\Repositories\Contracts\DestinationRepository;
use Closure;
use Illuminate\Http\Request;

class CheckDestinationExists
{
    protected $destinationRepository;

    public function __construct(DestinationRepository $destinationRepository)
    {
        $this->destinationRepository = $destinationRepository;
    }

    public function handle(Request $request, Closure $next)
    {
        // Lấy id từ route
        $destinationId = $request->route('id'); 

        // Kiểm tra nếu id không tồn tại hoặc không phải là số
        if (empty($destinationId) || !is_numeric($destinationId)) {
            return redirect()->route('admin.destinations.index')
                ->with('error', __('content.midleware.invalidid'));
        }

        // Kiểm tra nếu destination không tồn tại trong database
        if (!$this->destinationRepository->find($destinationId)) {
            return redirect()->route('admin.destinations.index')
                ->with('error', __('content.midleware.notfound'));
        }

        // Nếu tồn tại thì cho phép request tiếp tục
        return $next($request);
    }
}
