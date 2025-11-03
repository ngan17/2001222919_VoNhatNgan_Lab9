<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\CheckAdmin;
return Application::configure(basePath: dirname(__DIR__))
// ...
->withMiddleware(function (Middleware $middleware): void {
// 1) Đăng ký alias: dùng tên ngắn 'admin' trong route
$middleware->alias([
'admin' => CheckAdmin::class,
]);
// 2) (Tuỳ chọn) Thao tác với nhóm 'web'/'api'
// Ví dụ: thêm một middleware tuỳ biến vào group 'web'
// $middleware->appendToGroup('web',\App\Http\Middleware\AddSecurityHeaders::class);
// 3) (Tuỳ chọn) Cấu hình ngoại lệ CSRF
// $middleware->validateCsrfTokens(except: ['webhook/*']);
})
->withExceptions(function (Exceptions $exceptions): void {
//
})->create();