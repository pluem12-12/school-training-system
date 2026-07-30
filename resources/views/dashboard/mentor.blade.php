<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-custom-purple">
            <i class="fas fa-user-tie mr-2"></i>แผงควบคุมครูพี่เลี้ยง
        </h2>
        <p class="text-sm text-gray-500 mt-1">ดูแลและประเมินนักศึกษาในความดูแล</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Stats --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="stat-value">{{ $stats['total_students'] }}</div>
                            <div class="stat-label">นักศึกษาในความดูแล</div>
                        </div>
                        <div class="stat-icon gradient-purple">
                            <i class="fas fa-user-graduate text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="stat-value">{{ $stats['total_evaluations'] }}</div>
                            <div class="stat-label">การประเมินทั้งหมด</div>
                        </div>
                        <div class="stat-icon gradient-gold">
                            <i class="fas fa-clipboard-check text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="stat-value">{{ $stats['total_reports'] }}</div>
                            <div class="stat-label">รายงานนักศึกษา</div>
                        </div>
                        <div class="stat-icon bg-gradient-to-br from-green-500 to-emerald-600">
                            <i class="fas fa-file-alt text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                {{-- นักศึกษาในความดูแล --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="section-title !border-0 !pb-0 !mb-0"><i class="fas fa-users"></i> นักศึกษาในความดูแล</h3>
                    </div>
                    <div class="card-body p-0">
                        @forelse($students as $student)
                        <div class="px-6 py-4 flex items-center gap-4 border-b border-gray-50 last:border-0 hover:bg-purple-50/30 transition-colors">
                            <div class="w-10 h-10 gradient-purple rounded-full flex items-center justify-center text-white font-bold text-sm">
                                {{ strtoupper(substr($student->name, 0, 1)) }}
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800">{{ $student->name }}</p>
                                <p class="text-xs text-gray-500">{{ $student->email }}</p>
                            </div>
                            @php
                                $latestEval = $evaluations->where('student_id', $student->id)->first();
                            @endphp
                            @if($latestEval)
                                <span class="badge badge-success">คะแนน: {{ $latestEval->score }}</span>
                            @else
                                <span class="badge badge-warning">ยังไม่ประเมิน</span>
                            @endif
                        </div>
                        @empty
                        <p class="px-6 py-8 text-center text-gray-500 text-sm">ยังไม่มีนักศึกษาในความดูแล</p>
                        @endforelse
                    </div>
                </div>

                {{-- ผลการประเมินล่าสุด --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="section-title !border-0 !pb-0 !mb-0"><i class="fas fa-clipboard-check"></i> ผลการประเมินล่าสุด</h3>
                    </div>
                    <div class="card-body p-0">
                        @forelse($evaluations->take(5) as $eval)
                        <div class="px-6 py-4 border-b border-gray-50 last:border-0 hover:bg-purple-50/30 transition-colors">
                            <div class="flex items-center justify-between mb-1">
                                <p class="font-medium text-gray-800 text-sm">{{ $eval->student->name ?? '-' }}</p>
                                <span class="text-lg font-bold {{ $eval->score >= 80 ? 'text-green-600' : ($eval->score >= 60 ? 'text-yellow-600' : 'text-red-600') }}">
                                    {{ $eval->score }}
                                </span>
                            </div>
                            <p class="text-xs text-gray-500">{{ $eval->comment ? Str::limit($eval->comment, 80) : 'ไม่มีข้อเสนอแนะ' }}</p>
                            <p class="text-xs text-gray-400 mt-1"><i class="fas fa-clock mr-1"></i>{{ $eval->created_at->diffForHumans() }}</p>
                        </div>
                        @empty
                        <p class="px-6 py-8 text-center text-gray-500 text-sm">ยังไม่มีการประเมิน</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- รายงานนักศึกษา --}}
            <div class="card">
                <div class="card-header flex items-center justify-between">
                    <h3 class="section-title !border-0 !pb-0 !mb-0"><i class="fas fa-file-alt"></i> รายงานจากนักศึกษา</h3>
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
                                <td>{{ $report->student->name ?? '-' }}</td>
                                <td>{{ $report->title }}</td>
                                <td>
                                    <span class="badge {{ $report->status === 'approved' ? 'badge-success' : ($report->status === 'rejected' ? 'badge-danger' : 'badge-warning') }}">
                                        {{ $report->status === 'approved' ? 'อนุมัติ' : ($report->status === 'rejected' ? 'ส่งกลับ' : 'รอตรวจ') }}
                                    </span>
                                </td>
                                <td>{{ $report->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ Storage::url($report->file_path) }}" target="_blank" class="text-custom-purple hover:underline font-medium text-sm">
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

            {{-- ข่าวประชาสัมพันธ์ --}}
            @if($announcements->count() > 0)
            <div class="card">
                <div class="card-header">
                    <h3 class="section-title !border-0 !pb-0 !mb-0"><i class="fas fa-bullhorn"></i> ข่าวประชาสัมพันธ์</h3>
                </div>
                <div class="card-body space-y-4">
                    @foreach($announcements as $news)
                    <div class="flex items-start gap-4 p-4 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="w-10 h-10 rounded-lg gradient-purple flex items-center justify-center text-white shrink-0">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">{{ $news->title }}</h4>
                            <p class="text-sm text-gray-500 mt-1">{{ Str::limit(strip_tags($news->content), 100) }}</p>
                            <p class="text-xs text-gray-400 mt-1"><i class="fas fa-clock mr-1"></i>{{ $news->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
