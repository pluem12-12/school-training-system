<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="ศูนย์ฝึกประสบการณ์วิชาชีพครู คณะครุศาสตร์ - ระบบจัดการฝึกประสบการณ์วิชาชีพครูสำหรับนักศึกษา อาจารย์ และครูพี่เลี้ยง">
        <title>ศูนย์ฝึกประสบการณ์วิชาชีพครู | คณะครุศาสตร์</title>
        <link rel="icon" href="{{ asset('images/cmru-logo.png') }}?v=2">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-800">

        {{-- ===== NAVIGATION ===== --}}
        <nav class="bg-white/90 backdrop-blur-md border-b border-gray-100 fixed w-full top-0 z-50 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center">
                            <img src="{{ asset('images/cmru-logo.png') }}" alt="CMRU Logo" class="h-10 sm:h-12 w-auto object-contain">
                        </div>
                        <div>
                            <h1 class="text-sm font-bold text-custom-purple leading-tight">ศูนย์ฝึกประสบการณ์วิชาชีพครู</h1>
                            <p class="text-xs text-gray-400">Teaching Experience Center</p>
                        </div>
                    </div>
                    <div class="flex flex-1 justify-center items-center gap-4 text-sm font-medium text-gray-600 flex-wrap px-4">
                        <a href="#about" class="hover:text-custom-purple transition">เกี่ยวกับศูนย์</a>
                        <a href="#agencies" class="hover:text-custom-purple transition">หน่วยงานที่เกี่ยวข้อง</a>
                        <a href="#calendar" class="hover:text-custom-purple transition">ปฏิทินการฝึก</a>
                        <a href="#documents" class="hover:text-custom-purple transition">ดาวน์โหลดเอกสาร</a>
                    </div>
                    @if (Route::has('login'))
                        <div class="flex items-center gap-3">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-primary text-sm">
                                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline text-sm border-custom-purple text-custom-purple hover:bg-custom-purple hover:text-white">
                                    <i class="fas fa-sign-in-alt mr-2"></i> เข้าระบบประเมิน
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-primary text-sm hidden sm:inline-flex bg-custom-purple text-white hover:bg-purple-700">
                                        <i class="fas fa-user-plus mr-2"></i> สมัครสมาชิก
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </nav>

        {{-- ===== HERO SECTION ===== --}}
        <section class="gradient-hero text-white pt-28 pb-20 relative overflow-hidden">
            <!-- Decorative elements -->
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute -top-40 -right-40 w-80 h-80 bg-white/5 rounded-full"></div>
                <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-white/5 rounded-full"></div>
                <div class="absolute top-20 left-1/3 w-40 h-40 bg-white/3 rounded-full"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="text-center max-w-3xl mx-auto">
                    <div class="inline-flex items-center gap-2 bg-white/10 rounded-full px-4 py-2 mb-6 backdrop-blur-sm border border-white/20">
                        <i class="fas fa-university text-custom-yellow-400"></i>
                        <span class="text-sm font-medium">คณะครุศาสตร์</span>
                    </div>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
                        ศูนย์ฝึกประสบการณ์
                        <span class="block text-custom-yellow-400">วิชาชีพครู</span>
                    </h1>
                    <p class="text-lg sm:text-xl text-purple-200 mb-10 max-w-2xl mx-auto leading-relaxed">
                        ระบบจัดการฝึกประสบการณ์วิชาชีพครูสำหรับนักศึกษา อาจารย์นิเทศก์ และครูพี่เลี้ยง
                        เพื่อพัฒนาทักษะวิชาชีพครูอย่างมีคุณภาพ
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn bg-custom-yellow text-gray-900 hover:bg-custom-yellow-400 px-8 py-3 text-base font-bold shadow-lg">
                                <i class="fas fa-tachometer-alt mr-2"></i> เข้าสู่ Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn bg-white text-custom-purple hover:bg-gray-100 px-8 py-3 text-base font-bold shadow-lg">
                                <i class="fas fa-sign-in-alt mr-2"></i> เข้าระบบประเมิน
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn border-2 border-white/50 text-white hover:bg-white/10 px-8 py-3 text-base font-bold">
                                    <i class="fas fa-user-plus mr-2"></i> สมัครสมาชิก
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>

                {{-- Stats Bar --}}
                {{-- <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-16">
                    <div class="glass rounded-xl p-4 text-center">
                        <div class="text-3xl font-bold text-custom-yellow-400">{{ App\Models\User::where('role','student')->count() ?: '100+' }}</div>
                        <div class="text-sm text-purple-200 mt-1">นักศึกษาฝึกสอน</div>
                    </div>
                    <div class="glass rounded-xl p-4 text-center">
                        <div class="text-3xl font-bold text-custom-yellow-400">{{ App\Models\School::count() ?: '50+' }}</div>
                        <div class="text-sm text-purple-200 mt-1">สถานศึกษา</div>
                    </div>
                    <div class="glass rounded-xl p-4 text-center">
                        <div class="text-3xl font-bold text-custom-yellow-400">{{ App\Models\User::where('role','teacher')->count() ?: '20+' }}</div>
                        <div class="text-sm text-purple-200 mt-1">อาจารย์นิเทศก์</div>
                    </div>
                    <div class="glass rounded-xl p-4 text-center">
                        <div class="text-3xl font-bold text-custom-yellow-400">{{ App\Models\User::where('role','mentor')->count() ?: '50+' }}</div>
                        <div class="text-sm text-purple-200 mt-1">ครูพี่เลี้ยง</div>
                    </div>
                </div> --}}
            </div>
        </section>

        {{-- ===== FEATURES SECTION ===== --}}
        <section id="about" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 items-center mb-20">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-6">{{ $about->title ?? 'เกี่ยวกับศูนย์ฝึกประสบการณ์วิชาชีพครู' }}</h2>
                        <p class="text-gray-600 mb-4 leading-relaxed">
                            {{ $about->description_1 ?? 'ศูนย์ฝึกประสบการณ์วิชาชีพครู คณะครุศาสตร์ มหาวิทยาลัยราชภัฏเชียงใหม่ เป็นหน่วยงานที่รับผิดชอบในการบริหารจัดการและประสานงานการฝึกประสบการณ์วิชาชีพครูของนักศึกษา เพื่อให้นักศึกษาได้นำความรู้ไปประยุกต์ใช้ในการปฏิบัติงานจริงในสถานศึกษา' }}
                        </p>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            {{ $about->description_2 ?? 'เรามุ่งมั่นที่จะพัฒนานักศึกษาครูให้มีทักษะและศักยภาพ พร้อมที่จะเป็นครูที่ดีในอนาคต ผ่านกิจกรรมการเรียนรู้และการฝึกปฏิบัติงานที่หลากหลายร่วมกับเครือข่ายสถานศึกษา' }}
                        </p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <img src="{{ isset($about->image_1) ? asset('storage/' . $about->image_1) : 'https://www.cmru.ac.th/assets/images/articles/08-07-2026/200bd90d6db9add5de83da7531699b53aea7849d.jpg' }}" alt="กิจกรรมคณะครุศาสตร์ 1" class="rounded-xl shadow-lg w-full h-48 object-cover">
                        <img src="{{ isset($about->image_2) ? asset('storage/' . $about->image_2) : 'https://www.cmru.ac.th/assets/images/articles/05-07-2026/e20f7a470a12b4c9e72402b3a343745c9521b540.jpg' }}" alt="กิจกรรมคณะครุศาสตร์ 2" class="rounded-xl shadow-lg w-full h-48 object-cover mt-8">
                        <img src="{{ isset($about->image_3) ? asset('storage/' . $about->image_3) : 'https://www.cmru.ac.th/assets/images/articles/08-07-2026/3ff61c52668b9fe0e343e52892ee3dec11e6de8b.png' }}" alt="กิจกรรมคณะครุศาสตร์ 3" class="rounded-xl shadow-lg w-full h-48 object-cover">
                        <img src="{{ isset($about->image_4) ? asset('storage/' . $about->image_4) : 'https://www.cmru.ac.th/assets/images/cmru.jpg' }}" alt="บรรยากาศมหาวิทยาลัย" class="rounded-xl shadow-lg w-full h-48 object-cover mt-8">
                    </div>
                </div>


                <div class="text-center mb-16">
                    <h3 class="text-3xl font-bold text-gray-800 mb-4">ระบบที่ครอบคลุม<span class="text-custom-purple">ทุกขั้นตอน</span></h3>
                    <p class="text-gray-500 max-w-2xl mx-auto">จัดการกระบวนการฝึกประสบการณ์วิชาชีพครูอย่างเป็นระบบ ตั้งแต่เริ่มต้นจนจบ</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    {{-- Feature 1 --}}
                    <div class="card p-6 text-center group hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                        <div class="w-16 h-16 gradient-purple rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-user-graduate text-2xl text-white"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-2">จัดการนักศึกษา</h3>
                        <p class="text-sm text-gray-500">ข้อมูลนักศึกษาฝึกสอน สถานศึกษา และครูพี่เลี้ยง</p>
                    </div>

                    {{-- Feature 2 --}}
                    <div class="card p-6 text-center group hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                        <div class="w-16 h-16 gradient-gold rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-file-alt text-2xl text-white"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-2">ส่งรายงาน</h3>
                        <p class="text-sm text-gray-500">ส่งและติดตามรายงานการฝึกสอนออนไลน์</p>
                    </div>

                    {{-- Feature 3 --}}
                    <div class="card p-6 text-center group hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-clipboard-check text-2xl text-white"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-2">ประเมินผล</h3>
                        <p class="text-sm text-gray-500">ระบบประเมินผลการฝึกสอนจากครูพี่เลี้ยงและอาจารย์</p>
                    </div>

                    {{-- Feature 4 --}}
                    <div class="card p-6 text-center group hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-calendar-check text-2xl text-white"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-2">บันทึกการฝึกสอน</h3>
                        <p class="text-sm text-gray-500">ลงเวลาเข้า-ออก และบันทึกกิจกรรมประจำวัน</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ===== ANNOUNCEMENTS SECTION ===== --}}
        @if(isset($announcements) && $announcements->count() > 0)
        <section id="news" class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-10">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800">ข่าวสารประชาสัมพันธ์</h2>
                        <p class="text-gray-500 mt-1">ของคณะครุศาสตร์มหาวิทยาลัยราชภัฏเชียงใหม่</p>
                    </div>
                    <a href="{{ route('announcements.index') }}" class="btn btn-outline text-sm hidden sm:inline-flex">
                        ดูทั้งหมด <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($announcements as $news)
                    <article class="card group hover:shadow-xl transition-all duration-300">
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-3">
                                @if($news->is_pinned)
                                    <span class="badge badge-danger"><i class="fas fa-thumbtack mr-1"></i> ปักหมุด</span>
                                @endif
                                <span class="badge badge-purple">
                                    @switch($news->category)
                                        @case('urgent') <i class="fas fa-exclamation-circle mr-1"></i> ด่วน @break
                                        @case('event') <i class="fas fa-calendar mr-1"></i> กิจกรรม @break
                                        @default <i class="fas fa-info-circle mr-1"></i> ทั่วไป
                                    @endswitch
                                </span>
                            </div>
                            <h3 class="font-bold text-gray-800 text-lg mb-2 group-hover:text-custom-purple transition-colors line-clamp-2">{{ $news->title }}</h3>
                            <p class="text-sm text-gray-500 line-clamp-3 mb-4">{{ Str::limit(strip_tags($news->content), 120) }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-400">
                                    <i class="fas fa-clock mr-1"></i> {{ $news->created_at->diffForHumans() }}
                                </span>
                                <a href="{{ route('announcements.show', $news) }}" class="text-custom-purple text-sm font-medium hover:underline">
                                    อ่านเพิ่มเติม <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- ===== CALENDAR TABS SECTION ===== --}}
        <section id="calendar" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-bold text-gray-800">ปฏิทิน<span class="text-custom-purple">กิจกรรม</span></h2>
                    <p class="text-gray-500 mt-1">ข้อมูลและกำหนดการสำคัญต่างๆ</p>
                </div>

                <!-- Tab Headers -->
                <div class="flex flex-wrap justify-center gap-2 mb-10 border-b border-gray-100 pb-4">
                    <button onclick="switchTab('tab-info')" id="btn-tab-info" class="tab-btn px-6 py-3 rounded-xl font-medium transition-all duration-300 bg-purple-100 text-purple-700 shadow-sm">
                        <i class="fas fa-image mr-2"></i> อินโฟสรุปรวม / ปฏิทิน
                    </button>
                    <button onclick="switchTab('tab-university')" id="btn-tab-university" class="tab-btn px-6 py-3 rounded-xl font-medium text-gray-500 hover:bg-gray-100 transition-all duration-300">
                        <i class="fas fa-university mr-2"></i> ปฏิทินมหาวิทยาลัย
                    </button>
                    <button onclick="switchTab('tab-faculty')" id="btn-tab-faculty" class="tab-btn px-6 py-3 rounded-xl font-medium text-gray-500 hover:bg-gray-100 transition-all duration-300">
                        <i class="fas fa-graduation-cap mr-2"></i> ปฏิทินคณะครุศาสตร์
                    </button>
                </div>

            <!-- Tab 1: Infographics ONLY -->
            <div id="tab-info" class="tab-content block animate-fade-in">
                <div class="max-w-4xl mx-auto space-y-12">
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
                        <div class="text-center py-10 bg-gray-50 rounded-xl border border-gray-100">
                            <i class="fas fa-image text-gray-300 text-4xl mb-3"></i>
                            <p class="text-gray-500">ยังไม่มีข้อมูลอินโฟกราฟิก</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Tab 2: University Calendar -->
            <div id="tab-university" class="tab-content hidden animate-fade-in">
                <div class="max-w-4xl mx-auto space-y-8">
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
                                <div class="card p-6 flex gap-4 items-start hover:shadow-lg transition-all border-l-4 border-info bg-white">
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

            <!-- Tab 3: Faculty Calendar -->
            <div id="tab-faculty" class="tab-content hidden animate-fade-in">
                <div class="max-w-4xl mx-auto space-y-8">
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
                                <div class="card p-6 flex gap-4 items-start hover:shadow-lg transition-all border-l-4 border-success bg-white">
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
        </section>

        <script>
            function switchTab(tabId) {
                // ซ่อนเนื้อหาทั้งหมด
                document.querySelectorAll('.tab-content').forEach(el => {
                    el.classList.remove('block');
                    el.classList.add('hidden');
                });
                
                // คืนค่าปุ่มแท็บทั้งหมดให้เป็นสไตล์ปกติ
                document.querySelectorAll('.tab-btn').forEach(el => {
                    el.classList.remove('bg-purple-100', 'text-purple-700', 'shadow-sm');
                    el.classList.add('text-gray-500');
                });

                // แสดงเนื้อหาแท็บที่เลือก
                const activeTab = document.getElementById(tabId);
                if (activeTab) {
                    activeTab.classList.remove('hidden');
                    activeTab.classList.add('block');
                }

                // เน้นสีปุ่มแท็บที่เลือก
                const activeBtn = document.getElementById('btn-' + tabId);
                if (activeBtn) {
                    activeBtn.classList.remove('text-gray-500');
                    activeBtn.classList.add('bg-purple-100', 'text-purple-700', 'shadow-sm');
                }
            }
        </script>

        {{-- ===== AGENCIES SECTION ===== --}}
        @if(isset($agencies) && $agencies->count() > 0)
        <section id="agencies" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">หน่วยงาน<span class="text-custom-purple">ที่เกี่ยวข้อง</span></h2>
                    <p class="text-gray-500">เว็บไซต์หน่วยงานและองค์กรที่เกี่ยวข้องกับวิชาชีพครู</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($agencies as $agency)
                    <a href="{{ $agency->url ?? '#' }}" target="_blank" class="card p-6 text-center border border-gray-100 hover:border-custom-purple hover:shadow-lg transition-all group flex flex-col items-center justify-center min-h-[200px]">
                        <div class="w-16 h-16 rounded-full bg-purple-50 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <i class="{{ $agency->icon_class ?? 'fas fa-building' }} text-2xl text-custom-purple"></i>
                        </div>
                        <h3 class="font-bold text-gray-800">{{ $agency->name }}</h3>
                    </a>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- ===== DOCUMENTS SECTION ===== --}}
        @if(isset($documents) && $documents->count() > 0)
        <section id="documents" class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">ดาวน์โหลด<span class="text-custom-purple">เอกสาร</span></h2>
                    <p class="text-gray-500">เอกสารแบบฟอร์มและคู่มือต่างๆ สำหรับการฝึกประสบการณ์วิชาชีพ</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-5xl mx-auto">
                    @foreach($documents->take(3) as $doc)
                    <div class="card p-6 border-l-4 border-custom-purple hover:shadow-lg transition-all flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-purple-50 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-file-pdf text-xl text-custom-purple"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 text-lg mb-1">{{ $doc->title }}</h3>
                            <p class="text-sm text-gray-500 mb-3">{{ $doc->category }}</p>
                            <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="text-custom-purple text-sm font-medium hover:underline">
                                <i class="fas fa-download mr-1"></i> ดาวน์โหลด
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @if($documents->count() > 3)
                <div class="text-center w-full" style="margin-top: 40px; clear: both;">
                    <a href="{{ route('documents.index') }}" class="inline-flex items-center px-6 py-3 bg-white border-2 border-custom-purple text-custom-purple font-semibold rounded-xl hover:bg-custom-purple hover:text-white transition-all shadow-sm">
                        ดูเอกสารทั้งหมด <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                @endif
            </div>
        </section>
        @endif

        {{-- ===== ROLES SECTION ===== --}}
        <section id="roles" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">สำหรับ<span class="text-custom-purple">ผู้ใช้ทุกบทบาท</span></h2>
                    <p class="text-gray-500">ระบบรองรับผู้ใช้ 4 บทบาทหลัก</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="card p-6 text-center border-t-4 border-custom-purple hover:shadow-lg transition-all">
                        <i class="fas fa-user-graduate text-4xl text-custom-purple mb-4"></i>
                        <h3 class="font-bold text-gray-800 mb-2">นักศึกษา</h3>
                        <ul class="text-sm text-gray-500 space-y-1.5 text-left">
                            <li><i class="fas fa-check text-green-500 mr-2"></i>ดูข้อมูลสถานศึกษา</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>ส่งรายงานการฝึกสอน</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>ลงเวลาฝึกสอน</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>ดูผลการประเมิน</li>
                        </ul>
                    </div>

                    <div class="card p-6 text-center border-t-4 border-custom-yellow hover:shadow-lg transition-all">
                        <i class="fas fa-chalkboard-teacher text-4xl text-custom-yellow mb-4"></i>
                        <h3 class="font-bold text-gray-800 mb-2">อาจารย์นิเทศก์</h3>
                        <ul class="text-sm text-gray-500 space-y-1.5 text-left">
                            <li><i class="fas fa-check text-green-500 mr-2"></i>ตรวจรายงานนักศึกษา</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>ประเมินผลการฝึกสอน</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>ดูสถิติภาพรวม</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>ดูตารางฝึกสอน</li>
                        </ul>
                    </div>

                    <div class="card p-6 text-center border-t-4 border-green-500 hover:shadow-lg transition-all">
                        <i class="fas fa-user-tie text-4xl text-green-500 mb-4"></i>
                        <h3 class="font-bold text-gray-800 mb-2">ครูพี่เลี้ยง</h3>
                        <ul class="text-sm text-gray-500 space-y-1.5 text-left">
                            <li><i class="fas fa-check text-green-500 mr-2"></i>ดูนักศึกษาในความดูแล</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>ประเมินผลนักศึกษา</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>ดูรายงานนักศึกษา</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>รับข่าวประชาสัมพันธ์</li>
                        </ul>
                    </div>

                    <div class="card p-6 text-center border-t-4 border-blue-500 hover:shadow-lg transition-all">
                        <i class="fas fa-shield-alt text-4xl text-blue-500 mb-4"></i>
                        <h3 class="font-bold text-gray-800 mb-2">ผู้ดูแลระบบ</h3>
                        <ul class="text-sm text-gray-500 space-y-1.5 text-left">
                            <li><i class="fas fa-check text-green-500 mr-2"></i>จัดการผู้ใช้ทั้งหมด</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>จัดการสถานศึกษา</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>จัดการเอกสาร/ข่าว</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>ดูสถิติภาพรวม</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- ===== FOOTER ===== --}}
        <footer class="gradient-hero text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-3 gap-8">
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-graduation-cap text-custom-yellow-400"></i>
                            </div>
                            <h3 class="font-bold">ศูนย์ฝึกประสบการณ์วิชาชีพครู</h3>
                        </div>
                        <p class="text-sm text-purple-200 leading-relaxed">
                            {{ $siteSetting->footer_description ?? 'ระบบจัดการฝึกประสบการณ์วิชาชีพครู คณะครุศาสตร์ พัฒนาเพื่อรองรับการทำงานของนักศึกษา อาจารย์ และครูพี่เลี้ยง' }}
                        </p>
                    </div>
                    <div>
                        <h4 class="font-bold mb-4 text-custom-yellow-400">ลิงก์ด่วน</h4>
                        <ul class="space-y-2 text-sm text-purple-200">
                            @if(isset($quickLinks) && $quickLinks->count() > 0)
                                @foreach($quickLinks as $link)
                                    <li>
                                        @if($link->url)
                                            <a href="{{ url($link->url) }}" class="hover:text-white transition-colors">
                                                @if($link->icon) <i class="{{ $link->icon }} mr-2"></i> @endif {{ $link->title }}
                                            </a>
                                        @else
                                            <span class="hover:text-white transition-colors">
                                                @if($link->icon) <i class="{{ $link->icon }} mr-2"></i> @endif {{ $link->title }}
                                            </span>
                                        @endif
                                    </li>
                                @endforeach
                            @else
                                <li><a href="{{ route('login') }}" class="hover:text-white transition-colors"><i class="fas fa-sign-in-alt mr-2"></i>เข้าสู่ระบบ</a></li>
                                @if(Route::has('register'))
                                <li><a href="{{ route('register') }}" class="hover:text-white transition-colors"><i class="fas fa-user-plus mr-2"></i>ลงทะเบียน</a></li>
                                @endif
                                <li><a href="{{ route('announcements.index') }}" class="hover:text-white transition-colors"><i class="fas fa-bullhorn mr-2"></i>ข่าวประชาสัมพันธ์</a></li>
                            @endif
                        </ul>
                    </div>
                    <div id="contact">
                        <h4 class="font-bold mb-4 text-custom-yellow-400">Contact Us ติดต่อศูนย์ฝึกประสบการณ์วิชาชีพครู</h4>
                        <ul class="space-y-2 text-sm text-purple-200">
                            @if(isset($contactLinks) && $contactLinks->count() > 0)
                                @foreach($contactLinks as $contact)
                                    <li>
                                        @if($contact->url)
                                            <a href="{{ url($contact->url) }}" class="hover:text-white transition-colors">
                                                @if($contact->icon) <i class="{{ $contact->icon }} mr-2"></i> @endif {{ $contact->title }}
                                            </a>
                                        @else
                                            @if($contact->icon) <i class="{{ $contact->icon }} mr-2"></i> @endif {{ $contact->title }}
                                        @endif
                                    </li>
                                @endforeach
                            @else
                                <li><i class="fas fa-university mr-2"></i>คณะครุศาสตร์</li>
                                <li><i class="fas fa-phone mr-2"></i>053-885-500</li>
                                <li><i class="fas fa-envelope mr-2"></i>training@cmru.ac.th</li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="border-t border-white/20 mt-8 pt-8 text-center text-sm text-purple-300">
                    © {{ date('Y') }} {{ $siteSetting->footer_copyright ?? 'ศูนย์ฝึกประสบการณ์วิชาชีพครู คณะครุศาสตร์ | พัฒนาโดยทีมพัฒนาระบบสารสนเทศ' }}
                </div>
            </div>
        </footer>

    </body>
</html>
