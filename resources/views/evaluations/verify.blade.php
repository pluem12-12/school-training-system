<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ตรวจสอบข้อมูลนักศึกษา') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-8 border-t-4 border-custom-purple">
                
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">ข้อมูลนักศึกษา</h3>
                    <p class="text-gray-500">กรุณาตรวจสอบความถูกต้องก่อนเริ่มการประเมิน</p>
                </div>

                <div class="flex flex-col items-center justify-center p-6 bg-gray-50 rounded-2xl mb-8">
                    <!-- Photo -->
                    <div class="w-32 h-32 rounded-full bg-gray-200 border-4 border-white shadow-lg overflow-hidden mb-6">
                        @if($student->avatar)
                            <img src="{{ Storage::url($student->avatar) }}" alt="Student Photo" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-100">
                                <i class="fas fa-user text-5xl"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Details -->
                    <div class="text-center space-y-2">
                        <p class="text-sm text-gray-500 uppercase tracking-wider font-semibold">รหัสนักศึกษา</p>
                        <p class="text-xl font-bold text-custom-purple mb-4">{{ $student->student_id }}</p>

                        <p class="text-sm text-gray-500 uppercase tracking-wider font-semibold mt-4">ชื่อ-สกุล</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $student->memberProfile->name_th ?? $student->name }}</p>

                        <p class="text-sm text-gray-500 uppercase tracking-wider font-semibold mt-4">สาขาวิชา</p>
                        <p class="text-lg font-medium text-gray-700">{{ $student->memberProfile->subject_taught ?? 'ไม่ได้ระบุสาขา' }}</p>
                    </div>
                </div>

                <div class="flex justify-center gap-4">
                    <a href="{{ route('evaluations.search') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 font-semibold transition-colors">
                        <i class="fas fa-times mr-2"></i> ยกเลิก
                    </a>
                    <a href="{{ route('evaluations.form', $student->id) }}" class="px-8 py-3 bg-custom-purple text-white rounded-xl hover:bg-purple-700 font-semibold shadow-lg transition-colors">
                        <i class="fas fa-check mr-2"></i> ยืนยันข้อมูลถูกต้อง
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
