<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-custom-purple">
            <i class="fas fa-chalkboard-teacher mr-2"></i>แผงควบคุมอาจารย์
        </h2>
        <p class="text-sm text-gray-500 mt-1">ตรวจสอบรายงานและประเมินนักศึกษาฝึกสอน</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Statistics --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="stat-value">{{ $stats['total_reports'] }}</div>
                            <div class="stat-label">รายงานทั้งหมด</div>
                        </div>
                        <div class="stat-icon gradient-purple">
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

                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="stat-value text-green-600">{{ $stats['approved_reports'] }}</div>
                            <div class="stat-label">อนุมัติแล้ว</div>
                        </div>
                        <div class="stat-icon bg-gradient-to-br from-green-500 to-emerald-600">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="stat-value">{{ $stats['total_students'] }}</div>
                            <div class="stat-label">นักศึกษาทั้งหมด</div>
                        </div>
                        <div class="stat-icon gradient-gold">
                            <i class="fas fa-user-graduate text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pending Reports --}}
            @if($pendingReports->count() > 0)
            <div class="card border-t-4 border-orange-400">
                <div class="card-header flex items-center justify-between">
                    <h3 class="section-title !border-0 !pb-0 !mb-0">
                        <i class="fas fa-exclamation-triangle text-orange-500"></i> รายงานที่รอตรวจสอบ ({{ $pendingReports->count() }})
                    </h3>
                </div>
                <div class="card-body space-y-4">
                    @foreach($pendingReports as $report)
                    <div class="p-4 bg-orange-50/50 rounded-xl border border-orange-100">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="w-8 h-8 gradient-purple rounded-full flex items-center justify-center text-white text-xs font-bold">
                                        {{ strtoupper(substr($report->student->name ?? '?', 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800">{{ $report->title }}</p>
                                        <p class="text-xs text-gray-500">{{ $report->student->name ?? '-' }} · {{ $report->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                                @if($report->description)
                                    <p class="text-sm text-gray-500 ml-11">{{ $report->description }}</p>
                                @endif
                            </div>
                            <div class="flex items-center gap-2 ml-11 md:ml-0">
                                <a href="{{ Storage::url($report->file_path) }}" target="_blank" class="btn btn-outline text-xs !px-3 !py-1.5">
                                    <i class="fas fa-download mr-1"></i> ดาวน์โหลด
                                </a>

                                {{-- Approve Form --}}
                                <form action="{{ route('reports.approve', $report) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success text-xs !px-3 !py-1.5"
                                        onclick="return confirm('ยืนยันอนุมัติรายงานนี้?')">
                                        <i class="fas fa-check mr-1"></i> อนุมัติ
                                    </button>
                                </form>

                                {{-- Reject button triggers modal-like inline form --}}
                                <button type="button" class="btn btn-danger text-xs !px-3 !py-1.5"
                                    onclick="document.getElementById('reject-form-{{ $report->id }}').classList.toggle('hidden')">
                                    <i class="fas fa-times mr-1"></i> ส่งกลับ
                                </button>
                            </div>
                        </div>

                        {{-- Reject form (hidden by default) --}}
                        <form id="reject-form-{{ $report->id }}" action="{{ route('reports.reject', $report) }}" method="POST" class="hidden mt-4 ml-11 p-3 bg-white rounded-lg border border-red-100">
                            @csrf
                            <label class="block text-sm font-medium text-gray-700 mb-1">เหตุผลที่ส่งกลับ <span class="text-red-500">*</span></label>
                            <textarea name="teacher_comment" rows="2" required placeholder="กรุณาระบุเหตุผล..."
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500"></textarea>
                            <button type="submit" class="btn btn-danger text-xs mt-2">
                                <i class="fas fa-paper-plane mr-1"></i> ยืนยันส่งกลับ
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- All Reports --}}
            <div class="card">
                <div class="card-header flex items-center justify-between">
                    <h3 class="section-title !border-0 !pb-0 !mb-0">
                        <i class="fas fa-list"></i> รายงานทั้งหมด
                    </h3>
                </div>
                <div class="card-body overflow-x-auto p-0">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ชื่อนักศึกษา</th>
                                <th>ชื่อรายงาน</th>
                                <th>สถานะ</th>
                                <th>วันที่ส่ง</th>
                                <th>ดาวน์โหลด</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($reports as $report)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 gradient-purple rounded-full flex items-center justify-center text-white text-xs font-bold">
                                            {{ strtoupper(substr($report->student->name ?? '?', 0, 1)) }}
                                        </div>
                                        {{ $report->student->name ?? '-' }}
                                    </div>
                                </td>
                                <td class="font-medium">{{ $report->title }}</td>
                                <td>
                                    <span class="badge {{ $report->status === 'approved' ? 'badge-success' : ($report->status === 'rejected' ? 'badge-danger' : 'badge-warning') }}">
                                        {{ $report->status === 'approved' ? 'อนุมัติ' : ($report->status === 'rejected' ? 'ส่งกลับ' : 'รอตรวจ') }}
                                    </span>
                                </td>
                                <td>{{ $report->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ Storage::url($report->file_path) }}" target="_blank" class="text-custom-purple hover:underline text-sm font-medium">
                                        <i class="fas fa-download mr-1"></i> ดาวน์โหลด
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center text-gray-500 py-8">ยังไม่มีรายงาน</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Upcoming Schedules --}}
            @if(isset($schedules) && $schedules->count() > 0)
            <div class="card">
                <div class="card-header">
                    <h3 class="section-title !border-0 !pb-0 !mb-0">
                        <i class="fas fa-calendar text-custom-yellow"></i> ตารางกิจกรรมที่จะมาถึง
                    </h3>
                </div>
                <div class="card-body">
                    <div class="grid md:grid-cols-2 gap-4">
                        @foreach($schedules as $schedule)
                        <div class="flex items-start gap-4 p-4 rounded-xl hover:bg-purple-50/30 transition-colors border border-gray-100">
                            <div class="w-12 h-12 rounded-xl gradient-purple flex flex-col items-center justify-center text-white shrink-0">
                                <span class="text-[10px] font-medium uppercase">{{ $schedule->start_date->locale('th')->shortMonthName }}</span>
                                <span class="text-lg font-bold leading-none">{{ $schedule->start_date->day }}</span>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">{{ $schedule->title }}</h4>
                                @if($schedule->location)
                                    <p class="text-xs text-gray-400 mt-1"><i class="fas fa-map-marker-alt mr-1"></i>{{ $schedule->location }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>