<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg gradient-purple flex items-center justify-center text-white shadow-sm">
                    <i class="fas fa-calendar-alt text-sm"></i>
                </div>
                {{ __('ปฏิทินการฝึก') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ activeTab: 'summary' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Tabs -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-2 flex gap-2 overflow-x-auto">
                <button @click="activeTab = 'summary'" :class="{ 'bg-purple-100 text-custom-purple font-semibold shadow-sm': activeTab === 'summary', 'text-gray-600 hover:bg-gray-50': activeTab !== 'summary' }" class="px-6 py-2.5 rounded-lg text-sm transition-all whitespace-nowrap flex items-center gap-2">
                    <i class="fas fa-image"></i> อินโฟสรุปรวม / ปฏิทิน
                </button>
                <button @click="activeTab = 'university'" :class="{ 'bg-purple-100 text-custom-purple font-semibold shadow-sm': activeTab === 'university', 'text-gray-600 hover:bg-gray-50': activeTab !== 'university' }" class="px-6 py-2.5 rounded-lg text-sm transition-all whitespace-nowrap flex items-center gap-2">
                    <i class="fas fa-university"></i> ปฏิทินมหาวิทยาลัย
                </button>
                <button @click="activeTab = 'faculty'" :class="{ 'bg-purple-100 text-custom-purple font-semibold shadow-sm': activeTab === 'faculty', 'text-gray-600 hover:bg-gray-50': activeTab !== 'faculty' }" class="px-6 py-2.5 rounded-lg text-sm transition-all whitespace-nowrap flex items-center gap-2">
                    <i class="fas fa-graduation-cap"></i> ปฏิทินคณะครุศาสตร์
                </button>
            </div>

            <!-- Tab Content: Summary / Calendar (Infographics ONLY) -->
            <div x-show="activeTab === 'summary'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100">
                <div class="p-6 md:p-8 space-y-12">
                    @if(isset($uniCalendarSetting) && $uniCalendarSetting->image_file)
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 border-l-4 border-info pl-3 mb-4">ข้อมูลสรุป: มหาวิทยาลัย</h3>
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $uniCalendarSetting->image_file) }}" alt="อินโฟกราฟิกมหาวิทยาลัย" class="w-full rounded-xl shadow-md border border-gray-100">
                            </div>
                        </div>
                    @endif

                    @if(isset($facCalendarSetting) && $facCalendarSetting->image_file)
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 border-l-4 border-success pl-3 mb-4">ข้อมูลสรุป: คณะครุศาสตร์</h3>
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $facCalendarSetting->image_file) }}" alt="อินโฟกราฟิกคณะครุศาสตร์" class="w-full rounded-xl shadow-md border border-gray-100">
                            </div>
                        </div>
                    @endif
                    
                    @if((!isset($uniCalendarSetting) || !$uniCalendarSetting->image_file) && (!isset($facCalendarSetting) || !$facCalendarSetting->image_file))
                        <div class="text-center py-16 bg-gray-50 rounded-xl border border-gray-100">
                            <i class="fas fa-image text-gray-300 text-5xl mb-4"></i>
                            <p class="text-gray-500 font-medium">ยังไม่มีข้อมูลอินโฟกราฟิก</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Tab Content: University Calendar -->
            <div x-show="activeTab === 'university'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100">
                <div class="p-6 md:p-8 space-y-8">
                    @if(isset($uniCalendarSetting) && $uniCalendarSetting->pdf_file)
                        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                            <h3 class="text-xl font-bold text-gray-800 border-l-4 border-info pl-3 mb-4">ข้อมูลสรุป: มหาวิทยาลัย</h3>
                            <a href="{{ asset('storage/' . $uniCalendarSetting->pdf_file) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors">
                                <i class="fas fa-file-pdf mr-2"></i> ดาวน์โหลดตารางฉบับเต็ม (PDF)
                            </a>
                        </div>
                    @endif

                    <div>
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-1">กิจกรรมมหาวิทยาลัย</h3>
                            <p class="text-sm text-gray-500">กำหนดการสำคัญระดับมหาวิทยาลัย</p>
                        </div>

                        @if(isset($universitySchedules) && $universitySchedules->count() > 0)
                            <div class="grid md:grid-cols-2 gap-6">
                                @foreach($universitySchedules as $schedule)
                                <div class="border border-gray-100 p-6 rounded-xl flex gap-4 items-start hover:shadow-md transition-all border-l-4 border-l-info bg-white">
                                    <div class="w-14 h-14 rounded-xl bg-blue-50 flex flex-col items-center justify-center text-blue-600 shrink-0">
                                        <span class="text-xs font-medium">{{ $schedule->start_date->locale('th')->shortMonthName }}</span>
                                        <span class="text-xl font-bold leading-none">{{ $schedule->start_date->day }}</span>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-800">{{ $schedule->title }}</h3>
                                        <p class="text-sm text-gray-500 mt-1">{{ Str::limit($schedule->description, 100) }}</p>
                                        @if($schedule->location)
                                            <p class="text-xs text-gray-400 mt-2"><i class="fas fa-map-marker-alt mr-1"></i> {{ $schedule->location }}</p>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-10 bg-gray-50 rounded-xl border border-gray-100">
                                <p class="text-gray-500">ยังไม่มีกิจกรรม</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Tab Content: Faculty Calendar -->
            <div x-show="activeTab === 'faculty'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100">
                <div class="p-6 md:p-8 space-y-8">
                    @if(isset($facCalendarSetting) && $facCalendarSetting->pdf_file)
                        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                            <h3 class="text-xl font-bold text-gray-800 border-l-4 border-success pl-3 mb-4">ข้อมูลสรุป: คณะครุศาสตร์</h3>
                            <a href="{{ asset('storage/' . $facCalendarSetting->pdf_file) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-50 text-green-700 rounded-lg hover:bg-green-100 transition-colors">
                                <i class="fas fa-file-pdf mr-2"></i> ดาวน์โหลดตารางฉบับเต็ม (PDF)
                            </a>
                        </div>
                    @endif

                    <div>
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-1">กิจกรรมคณะครุศาสตร์</h3>
                            <p class="text-sm text-gray-500">กำหนดการสำหรับนักศึกษาครุศาสตร์ในการออกฝึกประสบการณ์วิชาชีพ</p>
                        </div>

                        @if(isset($facultySchedules) && $facultySchedules->count() > 0)
                            <div class="grid md:grid-cols-2 gap-6">
                                @foreach($facultySchedules as $schedule)
                                <div class="border border-gray-100 p-6 rounded-xl flex gap-4 items-start hover:shadow-md transition-all border-l-4 border-l-success bg-white">
                                    <div class="w-14 h-14 rounded-xl bg-green-50 flex flex-col items-center justify-center text-green-600 shrink-0">
                                        <span class="text-xs font-medium">{{ $schedule->start_date->locale('th')->shortMonthName }}</span>
                                        <span class="text-xl font-bold leading-none">{{ $schedule->start_date->day }}</span>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-800">{{ $schedule->title }}</h3>
                                        <p class="text-sm text-gray-500 mt-1">{{ Str::limit($schedule->description, 100) }}</p>
                                        @if($schedule->location)
                                            <p class="text-xs text-gray-400 mt-2"><i class="fas fa-map-marker-alt mr-1"></i> {{ $schedule->location }}</p>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-10 bg-gray-50 rounded-xl border border-gray-100">
                                <p class="text-gray-500">ยังไม่มีกิจกรรม</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
