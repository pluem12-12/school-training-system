<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 text-center">
        <div class="w-16 h-16 bg-purple-100 text-custom-purple rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-envelope-open-text text-2xl"></i>
        </div>
        <h2 class="text-xl font-bold text-gray-800 mb-2">{{ __('ยืนยันรหัส OTP') }}</h2>
        {{ __('เราได้ส่งรหัสยืนยัน 6 หลักไปที่อีเมลของคุณแล้ว กรุณานำรหัสดังกล่าวมากรอกเพื่อเสร็จสิ้นการสมัครสมาชิก') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    @if(!empty($devOtp))
        <div class="mb-6 bg-yellow-50 text-yellow-800 p-4 rounded-xl text-sm text-center border border-yellow-200">
            <div class="font-semibold mb-1"><i class="fas fa-tools mr-1"></i> โหมดพัฒนา (Local Development)</div>
            รหัส OTP ของคุณคือ: <strong class="text-lg tracking-widest">{{ $devOtp }}</strong>
        </div>
    @endif

    <form method="POST" action="{{ route('register.verify.store') }}">
        @csrf

        <!-- OTP Input -->
        <div>
            <x-input-label for="otp" :value="__('รหัส OTP (6 หลัก)')" />
            <x-text-input id="otp" class="block mt-1 w-full text-center text-xl tracking-[0.5em] font-mono" type="text" name="otp" required autofocus autocomplete="one-time-code" maxlength="6" />
            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                {{ __('ยกเลิก') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('ยืนยันรหัส') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
