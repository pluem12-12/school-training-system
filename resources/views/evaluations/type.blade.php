<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('เลือกระบบประเมิน') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-8">
                
                <div class="text-center mb-10">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">เลือกประเภทการประเมิน</h3>
                    <p class="text-gray-500">กรุณาเลือกประเภทการฝึกประสบการณ์ที่ต้องการประเมินนักศึกษา</p>
                </div>

                @if(session('error'))
                    <div class="mb-6 bg-red-50 text-red-700 p-4 rounded-xl border border-red-200">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- การฝึกระหว่างเรียน -->
                    <a href="{{ route('evaluations.search', ['type' => 'training']) }}" class="block group relative bg-white border-2 border-gray-100 hover:border-custom-purple rounded-2xl p-8 text-center transition-all duration-300 hover:shadow-xl hover:-translate-y-1 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-50 to-white opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative z-10">
                            <div class="w-20 h-20 mx-auto bg-purple-100 text-custom-purple rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <i class="fas fa-book-reader text-3xl"></i>
                            </div>
                            <h4 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-custom-purple transition-colors">การฝึกระหว่างเรียน</h4>
                            <p class="text-sm text-gray-500">สำหรับการประเมินผลการฝึกปฏิบัติวิชาชีพระหว่างเรียน (Practicum)</p>
                        </div>
                    </a>

                    <!-- การฝึกปฏิบัติการสอน -->
                    <a href="{{ route('evaluations.search', ['type' => 'teaching']) }}" class="block group relative bg-white border-2 border-gray-100 hover:border-custom-yellow rounded-2xl p-8 text-center transition-all duration-300 hover:shadow-xl hover:-translate-y-1 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-yellow-50 to-white opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative z-10">
                            <div class="w-20 h-20 mx-auto bg-yellow-100 text-custom-yellow-400 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <i class="fas fa-chalkboard-teacher text-3xl"></i>
                            </div>
                            <h4 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-custom-yellow-400 transition-colors">การฝึกปฏิบัติการสอน</h4>
                            <p class="text-sm text-gray-500">สำหรับการประเมินผลการปฏิบัติการสอนในสถานศึกษา (Internship)</p>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
