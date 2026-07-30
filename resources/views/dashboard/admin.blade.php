<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-custom-purple">
                    <i class="fas fa-shield-alt mr-2"></i>แผงควบคุมผู้ดูแลระบบ
                </h2>
                <p class="text-sm text-gray-500 mt-1">ภาพรวมข้อมูลระบบศูนย์ฝึกประสบการณ์วิชาชีพครู</p>
            </div>
            <a href="/admin" class="btn btn-primary">
                <i class="fas fa-cog mr-2"></i> จัดการระบบ (Filament)
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Statistics Cards --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="stat-value">{{ $stats['total_students'] }}</div>
                            <div class="stat-label">นักศึกษา</div>
                        </div>
                        <div class="stat-icon gradient-purple">
                            <i class="fas fa-user-graduate text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="stat-value">{{ $stats['total_schools'] }}</div>
                            <div class="stat-label">สถานศึกษา</div>
                        </div>
                        <div class="stat-icon gradient-gold">
                            <i class="fas fa-school text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="stat-value">{{ $stats['total_reports'] }}</div>
                            <div class="stat-label">รายงานทั้งหมด</div>
                        </div>
                        <div class="stat-icon bg-gradient-to-br from-green-500 to-emerald-600">
                            <i class="fas fa-file-alt text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="stat-value text-orange-500">{{ $stats['pending_reports'] }}</div>
                            <div class="stat-label">รอตรวจสอบ</div>
                        </div>
                        <div class="stat-icon bg-gradient-to-br from-orange-400 to-orange-600">
                            <i class="fas fa-clock text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Secondary Stats --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="card p-4 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center">
                        <i class="fas fa-chalkboard-teacher text-custom-purple"></i>
                    </div>
                    <div>
                        <div class="text-xl font-bold text-gray-800">{{ $stats['total_teachers'] }}</div>
                        <div class="text-xs text-gray-500">อาจารย์</div>
                    </div>
                </div>
                <div class="card p-4 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                        <i class="fas fa-user-tie text-green-600"></i>
                    </div>
                    <div>
                        <div class="text-xl font-bold text-gray-800">{{ $stats['total_mentors'] }}</div>
                        <div class="text-xs text-gray-500">ครูพี่เลี้ยง</div>
                    </div>
                </div>
                <div class="card p-4 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-clipboard-check text-blue-600"></i>
                    </div>
                    <div>
                        <div class="text-xl font-bold text-gray-800">{{ $stats['total_evaluations'] }}</div>
                        <div class="text-xs text-gray-500">การประเมิน</div>
                    </div>
                </div>
                <div class="card p-4 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-yellow-100 flex items-center justify-center">
                        <i class="fas fa-folder-open text-custom-yellow"></i>
                    </div>
                    <div>
                        <div class="text-xl font-bold text-gray-800">{{ $stats['total_documents'] }}</div>
                        <div class="text-xs text-gray-500">เอกสาร</div>
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                {{-- Recent Reports --}}
                <div class="card">
                    <div class="card-header flex items-center justify-between">
                        <h3 class="font-bold text-custom-purple"><i class="fas fa-file-alt mr-2"></i>รายงานล่าสุด</h3>
                        <a href="/admin/student-reports" class="text-sm text-custom-yellow hover:underline">ดูทั้งหมด</a>
                    </div>
                    <div class="card-body p-0">
                        @forelse($recentReports as $report)
                        <div class="px-6 py-3 flex items-center justify-between border-b border-gray-50 last:border-0 hover:bg-gray-50 transition-colors">
                            <div>
                                <p class="font-medium text-gray-800 text-sm">{{ $report->title }}</p>
                                <p class="text-xs text-gray-500">{{ $report->student->name ?? '-' }} · {{ $report->created_at->diffForHumans() }}</p>
                            </div>
                            <span class="badge {{ $report->status === 'approved' ? 'badge-success' : ($report->status === 'rejected' ? 'badge-danger' : 'badge-warning') }}">
                                {{ $report->status === 'approved' ? 'อนุมัติ' : ($report->status === 'rejected' ? 'ส่งกลับ' : 'รอตรวจ') }}
                            </span>
                        </div>
                        @empty
                        <p class="px-6 py-4 text-sm text-gray-500 text-center">ยังไม่มีรายงาน</p>
                        @endforelse
                    </div>
                </div>

                {{-- Recent Users --}}
                <div class="card">
                    <div class="card-header flex items-center justify-between">
                        <h3 class="font-bold text-custom-purple"><i class="fas fa-users mr-2"></i>สมาชิกล่าสุด</h3>
                        <a href="/admin/users" class="text-sm text-custom-yellow hover:underline">ดูทั้งหมด</a>
                    </div>
                    <div class="card-body p-0">
                        @forelse($recentUsers as $u)
                        <div class="px-6 py-3 flex items-center justify-between border-b border-gray-50 last:border-0 hover:bg-gray-50 transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 gradient-purple rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    {{ strtoupper(substr($u->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800 text-sm">{{ $u->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $u->email }}</p>
                                </div>
                            </div>
                            <span class="badge badge-purple">{{ $u->role }}</span>
                        </div>
                        @empty
                        <p class="px-6 py-4 text-sm text-gray-500 text-center">ยังไม่มีสมาชิก</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="font-bold text-custom-purple"><i class="fas fa-bolt mr-2"></i>จัดการด่วน</h3>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="/admin/users" class="flex flex-col items-center gap-2 p-4 rounded-xl hover:bg-purple-50 transition-colors group">
                            <div class="w-12 h-12 gradient-purple rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="fas fa-users text-white"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700">จัดการผู้ใช้</span>
                        </a>
                        <a href="/admin/schools" class="flex flex-col items-center gap-2 p-4 rounded-xl hover:bg-yellow-50 transition-colors group">
                            <div class="w-12 h-12 gradient-gold rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="fas fa-school text-white"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700">จัดการโรงเรียน</span>
                        </a>
                        <a href="/admin/documents" class="flex flex-col items-center gap-2 p-4 rounded-xl hover:bg-green-50 transition-colors group">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="fas fa-folder-open text-white"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700">จัดการเอกสาร</span>
                        </a>
                        <a href="/admin/announcements" class="flex flex-col items-center gap-2 p-4 rounded-xl hover:bg-blue-50 transition-colors group">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="fas fa-bullhorn text-white"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700">ประชาสัมพันธ์</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
