<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ค้นหานักศึกษา') }}
            <span class="text-sm font-normal text-gray-500 ml-2">({{ session('evaluation_type') == 'training' ? 'การฝึกระหว่างเรียน' : 'การฝึกปฏิบัติการสอน' }})</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-8">
                
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">ระบุรหัสนักศึกษา</h3>
                    <p class="text-gray-500">กรอกรหัสนักศึกษาที่ต้องการประเมินผล</p>
                </div>

                @if(session('error'))
                    <div class="mb-6 bg-red-50 text-red-700 p-4 rounded-xl border border-red-200">
                        <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('evaluations.search.post') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <x-input-label for="student_id" :value="__('รหัสนักศึกษา')" class="text-lg" />
                        <x-text-input id="student_id" name="student_id" type="text" class="mt-2 block w-full text-center text-2xl tracking-widest py-3" required autofocus placeholder="เช่น 64xxxxxx" />
                        <x-input-error class="mt-2" :messages="$errors->get('student_id')" />
                    </div>

                    <div class="flex items-center justify-between mt-8">
                        <a href="{{ route('evaluations.type') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
                            <i class="fas fa-arrow-left mr-1"></i> ย้อนกลับ
                        </a>
                        <x-primary-button class="px-8 py-3 text-lg rounded-xl">
                            {{ __('ค้นหาและตกลง') }} <i class="fas fa-arrow-right ml-2"></i>
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
