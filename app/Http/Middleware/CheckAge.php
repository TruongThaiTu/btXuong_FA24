<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra tuổi (giả sử tuổi được gửi qua request với key 'age')
        if ($request->age < 18) {
            // Nếu dưới 18 tuổi, chuyển hướng về trang chủ và thông báo
            return redirect('/')->with('error', 'Bạn chưa đủ 18 tuổi để truy cập trang này.');
        }

        // Nếu đủ 18 tuổi, tiếp tục truy cập trang
        return $next($request);
    }
}
