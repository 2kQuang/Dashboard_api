<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Kiểm tra nếu yêu cầu đến từ trang admin
        if ($request->is('admin') || $request->is('admin/*')) {
            return route('admin.login'); // Chuyển hướng đến trang admin login
        }

        // Chuyển hướng người dùng thông thường đến trang login mặc định
        return $request->expectsJson() ? null : route('login');
    }
}
