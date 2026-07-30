<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRoleIs
{
    /**
     * Handle an incoming request.
     * รองรับหลาย roles เช่น: middleware('role:admin,teacher')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // ตรวจสอบว่าผู้ใช้ล็อกอินไหม และมี role ตรงกับที่ระบุใน Route ไหม
        if ($request->user() && in_array($request->user()->role, $roles)) {
            return $next($request);
        }

        // ถ้าไม่ใช่ ให้เด้งกลับไปที่หน้าหลักหรือ dashboard
        return redirect('/dashboard')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้');
    }
}