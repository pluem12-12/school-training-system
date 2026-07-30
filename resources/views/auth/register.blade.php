<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-800">สมัครสมาชิก</h2>
        <p class="text-sm text-gray-500 mt-1">สำหรับอาจารย์และครูพี่เลี้ยง</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- เลือกตำแหน่ง -->
        <div>
            <x-input-label for="role" :value="__('สมัครในตำแหน่ง')" />
            <select id="role" name="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required autofocus>
                <option value="">-- กรุณาเลือกตำแหน่ง --</option>
                <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>อาจารย์</option>
                <option value="mentor" {{ old('role') == 'mentor' ? 'selected' : '' }}>ครูพี่เลี้ยง</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- ชื่อ สกุล ภาษาไทย -->
            <div>
                <x-input-label for="name_th" :value="__('ชื่อ-สกุล (ภาษาไทย)')" />
                <x-text-input id="name_th" class="block mt-1 w-full" type="text" name="name_th" :value="old('name_th')" required />
                <x-input-error :messages="$errors->get('name_th')" class="mt-2" />
            </div>

            <!-- ชื่อ สกุล ภาษาอังกฤษ -->
            <div>
                <x-input-label for="name_en" :value="__('ชื่อ-สกุล (ภาษาอังกฤษ)')" />
                <x-text-input id="name_en" class="block mt-1 w-full" type="text" name="name_en" :value="old('name_en')" required />
                <x-input-error :messages="$errors->get('name_en')" class="mt-2" />
            </div>
        </div>

        <!-- ตำแหน่งงาน -->
        <div>
            <x-input-label for="position" :value="__('ตำแหน่งงาน')" />
            <x-text-input id="position" class="block mt-1 w-full" type="text" name="position" :value="old('position')" required />
            <x-input-error :messages="$errors->get('position')" class="mt-2" />
        </div>

        <!-- วิทยฐานะหรือตำแหน่งทางวิชาการ -->
        <div>
            <x-input-label for="academic_rank" :value="__('วิทยฐานะหรือตำแหน่งทางวิชาการ')" />
            <x-text-input id="academic_rank" class="block mt-1 w-full" type="text" name="academic_rank" :value="old('academic_rank')" required />
            <x-input-error :messages="$errors->get('academic_rank')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- โรงเรียน -->
            <div>
                <x-input-label for="school_name" :value="__('โรงเรียน')" />
                <x-text-input id="school_name" class="block mt-1 w-full" type="text" name="school_name" :value="old('school_name')" required />
                <x-input-error :messages="$errors->get('school_name')" class="mt-2" />
            </div>

            <!-- สังกัดของโรงเรียน -->
            <div>
                <x-input-label for="school_affiliation" :value="__('สังกัดของโรงเรียน')" />
                <x-text-input id="school_affiliation" class="block mt-1 w-full" type="text" name="school_affiliation" :value="old('school_affiliation')" required />
                <x-input-error :messages="$errors->get('school_affiliation')" class="mt-2" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- จังหวัด -->
            <div>
                <x-input-label for="province" :value="__('จังหวัด')" />
                <x-text-input id="province" class="block mt-1 w-full" type="text" name="province" :value="old('province')" required />
                <x-input-error :messages="$errors->get('province')" class="mt-2" />
            </div>

            <!-- เบอร์โทรติดต่อ -->
            <div>
                <x-input-label for="phone" :value="__('เบอร์โทรติดต่อ')" />
                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- วิชาที่สอน -->
            <div>
                <x-input-label for="subject_taught" :value="__('วิชาที่สอน')" />
                <x-text-input id="subject_taught" class="block mt-1 w-full" type="text" name="subject_taught" :value="old('subject_taught')" required />
                <x-input-error :messages="$errors->get('subject_taught')" class="mt-2" />
            </div>

            <!-- ระดับชั้น -->
            <div>
                <x-input-label for="grade_level" :value="__('ระดับชั้น')" />
                <x-text-input id="grade_level" class="block mt-1 w-full" type="text" name="grade_level" :value="old('grade_level')" required />
                <x-input-error :messages="$errors->get('grade_level')" class="mt-2" />
            </div>
        </div>

        <!-- ประสบการณ์การทำงาน (ปี) -->
        <div>
            <x-input-label for="experience_years" :value="__('ประสบการณ์การทำงาน (ปี)')" />
            <x-text-input id="experience_years" class="block mt-1 w-full" type="number" min="0" name="experience_years" :value="old('experience_years')" required />
            <x-input-error :messages="$errors->get('experience_years')" class="mt-2" />
        </div>

        <!-- E-mail -->
        <div>
            <x-input-label for="email" :value="__('อีเมล (E-mail)')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('มีบัญชีอยู่แล้ว?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('สมัครสมาชิก') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
