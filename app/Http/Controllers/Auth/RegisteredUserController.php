<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\RegisterOtpMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request and send OTP.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validate inputs
        $request->validate([
            'role' => ['required', 'string', 'in:teacher,mentor'],
            'name_th' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'academic_rank' => ['required', 'string', 'max:255'],
            'school_name' => ['required', 'string', 'max:255'],
            'school_affiliation' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'subject_taught' => ['required', 'string', 'max:255'],
            'grade_level' => ['required', 'string', 'max:255'],
            'experience_years' => ['required', 'integer', 'min:0'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        ]);

        // 2. Generate 6-digit OTP
        $otp = sprintf("%06d", mt_rand(1, 999999));
        
        $data = $request->all();
        $data['email'] = strtolower($data['email']);

        // 3. Store registration data and OTP in Session
        session([
            'registration_data' => $data,
            'registration_otp' => $otp,
            'registration_otp_expires' => now()->addMinutes(15),
        ]);

        // 4. Send Email
        Mail::to($request->email)->send(new RegisterOtpMail($otp));

        // 5. Redirect to OTP verification page
        return redirect()->route('register.verify')->with('status', 'เราได้ส่งรหัส OTP ไปยังอีเมลของคุณแล้ว');
    }
}
