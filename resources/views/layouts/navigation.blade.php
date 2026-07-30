<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center gap-3">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                        <div class="w-10 h-10 flex items-center justify-center overflow-hidden">
                            <img src="{{ asset('images/cmru-logo.png') }}" alt="CMRU Logo" class="w-full h-full object-contain">
                        </div>
                        <div class="hidden md:block">
                            <h1 class="text-sm font-bold text-custom-purple leading-tight">ศูนย์ฝึกประสบการณ์วิชาชีพครู</h1>
                            <p class="text-xs text-gray-400 leading-tight">Teaching Experience Center</p>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ms-8 sm:flex items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="!text-sm">
                        <i class="fas fa-tachometer-alt mr-1.5 text-xs"></i>
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('announcements.index')" :active="request()->routeIs('announcements.*')" class="!text-sm">
                        <i class="fas fa-bullhorn mr-1.5 text-xs"></i>
                        {{ __('ข่าวประชาสัมพันธ์') }}
                    </x-nav-link>

                    <x-nav-link :href="route('calendar.index')" :active="request()->routeIs('calendar.*')" class="!text-sm">
                        <i class="fas fa-calendar-alt mr-1.5 text-xs"></i>
                        {{ __('ปฏิทินการฝึก') }}
                    </x-nav-link>

                    <x-nav-link :href="route('documents.index')" :active="request()->routeIs('documents.*')" class="!text-sm">
                        <i class="fas fa-download mr-1.5 text-xs"></i>
                        {{ __('ดาวน์โหลดเอกสาร') }}
                    </x-nav-link>

                    @if(auth()->user()->isStudent())
                        <x-nav-link :href="route('attendance.index')" :active="request()->routeIs('attendance.*')" class="!text-sm">
                            <i class="fas fa-calendar-check mr-1.5 text-xs"></i>
                            {{ __('บันทึกการฝึกสอน') }}
                        </x-nav-link>
                    @endif

                    @if(auth()->user()->hasRole('teacher', 'mentor'))
                        <x-nav-link :href="route('evaluations.type')" :active="request()->routeIs('evaluations.*')" class="!text-sm text-custom-purple font-semibold">
                            <i class="fas fa-clipboard-check mr-1.5 text-xs"></i>
                            {{ __('ประเมินนักศึกษา') }}
                        </x-nav-link>
                    @endif

                    @if(auth()->user()->hasRole('admin', 'teacher'))
                        <x-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.*')" class="!text-sm">
                            <i class="fas fa-file-alt mr-1.5 text-xs"></i>
                            {{ __('รายงาน') }}
                        </x-nav-link>
                    @endif

                    @if(auth()->user()->isAdmin())
                        <a href="/admin" class="inline-flex items-center px-3 py-2 text-sm font-medium text-custom-yellow hover:text-custom-yellow-700 transition-colors">
                            <i class="fas fa-cog mr-1.5 text-xs"></i>
                            จัดการระบบ
                        </a>
                    @endif
                </div>
            </div>

            <!-- Right Side -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">
                <!-- Role Badge -->
                <span class="badge badge-purple">
                    @switch(auth()->user()->role)
                        @case('admin') <i class="fas fa-shield-alt mr-1"></i> ผู้ดูแลระบบ @break
                        @case('teacher') <i class="fas fa-chalkboard-teacher mr-1"></i> อาจารย์ @break
                        @case('mentor') <i class="fas fa-user-tie mr-1"></i> ครูพี่เลี้ยง @break
                        @default <i class="fas fa-user-graduate mr-1"></i> นักศึกษา
                    @endswitch
                </span>

                <!-- Settings Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-3 py-2 border border-gray-200 text-sm font-medium rounded-lg text-gray-600 bg-white hover:bg-gray-50 hover:border-gray-300 focus:outline-none transition-all duration-200">
                            <div class="w-7 h-7 gradient-purple rounded-full flex items-center justify-center text-white text-xs font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="hidden md:inline">{{ Auth::user()->name }}</span>
                            <svg class="fill-current h-3 w-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2">
                            <i class="fas fa-user-edit text-gray-400"></i>
                            {{ __('โปรไฟล์') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="flex items-center gap-2 text-red-600 hover:text-red-700">
                                <i class="fas fa-sign-out-alt"></i>
                                {{ __('ออกจากระบบ') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-400 hover:text-custom-purple hover:bg-purple-50 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-100">
        <div class="pt-2 pb-3 space-y-1 px-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <i class="fas fa-tachometer-alt mr-2"></i> {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('announcements.index')" :active="request()->routeIs('announcements.*')">
                <i class="fas fa-bullhorn mr-2"></i> {{ __('ข่าวประชาสัมพันธ์') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('calendar.index')" :active="request()->routeIs('calendar.*')">
                <i class="fas fa-calendar-alt mr-2"></i> {{ __('ปฏิทินการฝึก') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('documents.index')" :active="request()->routeIs('documents.*')">
                <i class="fas fa-download mr-2"></i> {{ __('ดาวน์โหลดเอกสาร') }}
            </x-responsive-nav-link>
            @if(auth()->user()->isStudent())
                <x-responsive-nav-link :href="route('attendance.index')" :active="request()->routeIs('attendance.*')">
                    <i class="fas fa-calendar-check mr-2"></i> {{ __('บันทึกการฝึกสอน') }}
                </x-responsive-nav-link>
            @endif
            @if(auth()->user()->hasRole('teacher', 'mentor'))
                <x-responsive-nav-link :href="route('evaluations.type')" :active="request()->routeIs('evaluations.*')" class="text-custom-purple">
                    <i class="fas fa-clipboard-check mr-2"></i> {{ __('ประเมินนักศึกษา') }}
                </x-responsive-nav-link>
            @endif
            @if(auth()->user()->hasRole('admin', 'teacher'))
                <x-responsive-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.*')">
                    <i class="fas fa-file-alt mr-2"></i> {{ __('รายงาน') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4 flex items-center gap-3">
                <div class="w-10 h-10 gradient-purple rounded-full flex items-center justify-center text-white font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-2">
                <x-responsive-nav-link :href="route('profile.edit')">
                    <i class="fas fa-user-edit mr-2"></i> {{ __('โปรไฟล์') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i> {{ __('ออกจากระบบ') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
