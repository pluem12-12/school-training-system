<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MemberProfile;
use App\Models\School;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisterOtpController extends Controller
{
    /**
     * Display the OTP verification view.
     */
    public function create()
    {
        // Check if there's an active registration in session
        if (!session()->has('registration_data')) {
            return redirect()->route('register')->withErrors(['email' => 'ไม่พบข้อมูลการสมัครสมาชิก กรุณาเริ่มใหม่']);
        }

        return view('auth.verify-otp', [
            'devOtp' => session('registration_otp')
        ]);
    }

    /**
     * Handle the OTP verification and create user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $sessionOtp = session('registration_otp');
        $expires = session('registration_otp_expires');
        $data = session('registration_data');

        if (!$sessionOtp || !$data) {
            return redirect()->route('register')->withErrors(['email' => 'เซสชันหมดอายุ กรุณาสมัครสมาชิกใหม่']);
        }

        if (now()->greaterThan($expires)) {
            session()->forget(['registration_otp', 'registration_otp_expires']);
            return back()->withErrors(['otp' => 'รหัส OTP หมดอายุแล้ว กรุณากดส่งรหัสใหม่ (หรือสมัครใหม่)']);
        }

        if ($request->otp !== $sessionOtp) {
            return back()->withErrors(['otp' => 'รหัส OTP ไม่ถูกต้อง']);
        }

        // Determine default password based on role
        $plainPassword = $data['role'] === 'teacher' ? $data['email'] : $data['phone'];

        // Create User
        $user = User::create([
            'name' => $data['name_th'], // Use Thai name as default display name
            'email' => $data['email'],
            'password' => Hash::make($plainPassword),
            'role' => $data['role'], // teacher or mentor
            'phone' => $data['phone'],
        ]);

        // Find or create school to link to member profile if needed
        // Assuming we might not link it to schools table strictly, or we can just create a basic profile without school_id for now if it's not strictly enforced by foreign key.
        // The migration member_profiles has school_name as string.

        // Create Member Profile
        MemberProfile::create([
            'user_id' => $user->id,
            'name_th' => $data['name_th'],
            'name_en' => $data['name_en'],
            'position' => $data['position'],
            'academic_rank' => $data['academic_rank'],
            'school_name' => $data['school_name'],
            'school_affiliation' => $data['school_affiliation'],
            'province' => $data['province'],
            'phone' => $data['phone'],
            'subject_taught' => $data['subject_taught'],
            'grade_level' => $data['grade_level'],
            'experience_years' => $data['experience_years'],
            // 'school_id' => null // Optional, if you want to strictly link to schools table later
        ]);

        // Trigger registered event
        event(new Registered($user));

        // Clear session data
        session()->forget([
            'registration_data',
            'registration_otp',
            'registration_otp_expires',
        ]);

        // Login user
        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
