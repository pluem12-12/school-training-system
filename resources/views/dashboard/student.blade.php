<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-custom-purple">
            <i class="fas fa-user-graduate mr-2"></i>Dashboard สำหรับนักศึกษา
        </h2>
        <p class="text-sm text-gray-500 mt-1">ยินดีต้อนรับ, {{ auth()->user()->name }}</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Welcome Card + Check-in --}}
            <div class="grid lg:grid-cols-3 gap-6">
                {{-- Welcome --}}
                <div class="lg:col-span-2 card border-l-4 border-custom-purple">
                    <div class="card-body">
                        <h1 class="text-2xl font-bold text-custom-purple mb-2">
                            <i class="fas fa-hand-sparkles text-custom-yellow mr-2"></i>ยินดีต้อนรับนักศึกษา
                        </h1>
                        <p class="text-gray-600">ที่นี่คือหน้าแรกสำหรับนักศึกษาฝึกประสบการณ์วิชาชีพครู คณะครุศาสตร์</p>

                        @if($announcements->count() > 0)
                        <div class="mt-4 p-3 bg-purple-50 rounded-lg">
                            <p class="text-sm text-custom-purple font-medium">
                                <i class="fas fa-bullhorn mr-1"></i> {{ $announcements->first()->title }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">{{ Str::limit(strip_tags($announcements->first()->content), 100) }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Check-in Card --}}
                <div class="card border-t-4 {{ $todayAttendance ? 'border-green-500' : 'border-custom-yellow' }}">
                    <div class="card-body text-center">
                        <div class="text-sm text-gray-500 mb-2">{{ now()->locale('th')->translatedFormat('l j F Y') }}</div>

                        @if(!$todayAttendance)
                            <div class="mb-3">
                                <i class="fas fa-clock text-4xl text-gray-300"></i>
                            </div>
                            <p class="text-sm text-gray-500 mb-3">ยังไม่ได้ลงเวลาวันนี้</p>
                            <form action="{{ route('attendance.checkIn') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success w-full">
                                    <i class="fas fa-sign-in-alt mr-2"></i> ลงเวลาเข้า
                                </button>
                            </form>
                        @elseif(!$todayAttendance->check_out_time)
                            <div class="mb-3">
                                <i class="fas fa-check-circle text-4xl text-green-500"></i>
                            </div>
                            <p class="text-sm text-green-600 font-medium mb-1">เข้าเวลา: {{ $todayAttendance->check_in_time }}</p>
                            <form action="{{ route('attendance.checkOut') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger w-full mt-2">
                                    <i class="fas fa-sign-out-alt mr-2"></i> ลงเวลาออก
                                </button>
                            </form>
                        @else
                            <div class="mb-3">
                                <i class="fas fa-check-double text-4xl text-green-500"></i>
                            </div>
                            <p class="text-sm text-green-600 font-medium">เข้า: {{ $todayAttendance->check_in_time }}</p>
                            <p class="text-sm text-green-600 font-medium">ออก: {{ $todayAttendance->check_out_time }}</p>
                            <p class="text-xs text-gray-400 mt-2">ลงเวลาครบแล้ววันนี้</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- ข้อมูลสถานศึกษา --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="section-title !border-0 !pb-0 !mb-0">
                        <i class="fas fa-school text-custom-yellow"></i> ข้อมูลสถานศึกษาที่ฝึกประสบการณ์
                    </h3>
                </div>
                <div class="card-body">
                    @if(auth()->user()->memberProfile && auth()->user()->memberProfile->school)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach(['โรงเรียน' => 'school_name', 'สังกัด' => 'affiliation', 'จังหวัด' => 'province', 'ครูพี่เลี้ยง' => 'mentor_name'] as $label => $field)
                                <div class="p-4 bg-gradient-to-r from-purple-50 to-white rounded-xl border border-purple-100">
                                    <p class="text-xs text-gray-500 uppercase tracking-wider">{{ $label }}</p>
                                    <p class="text-lg font-semibold text-gray-800 mt-1">{{ auth()->user()->memberProfile->school->$field ?? 'ยังไม่ได้ระบุ' }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-4 bg-yellow-50 text-custom-purple rounded-xl border border-yellow-200 flex items-center gap-3">
                            <i class="fas fa-info-circle text-custom-yellow text-xl"></i>
                            <p>ยังไม่มีข้อมูลสถานศึกษาที่ได้รับมอบหมาย กรุณาติดต่อเจ้าหน้าที่ศูนย์ฯ</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                {{-- เอกสารสำคัญ --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="section-title !border-0 !pb-0 !mb-0">
                            <i class="fas fa-download text-green-500"></i> ดาวน์โหลดเอกสารสำคัญ
                        </h3>
                    </div>
                    <div class="card-body overflow-x-auto p-0">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>ชื่อเอกสาร</th>
                                    <th>ดาวน์โหลด</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($documents ?? [] as $doc)
                                    <tr>
                                        <td>
                                            <div class="flex items-center gap-2">
                                                <i class="fas fa-file-pdf text-red-400"></i>
                                                {{ $doc->title }}
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="btn btn-primary text-xs !px-3 !py-1">
                                                <i class="fas fa-download mr-1"></i> ดาวน์โหลด
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="2" class="text-center text-gray-500 py-6">ไม่มีเอกสารให้ดาวน์โหลด</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- ผลการประเมิน --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="section-title !border-0 !pb-0 !mb-0">
                            <i class="fas fa-chart-bar text-blue-500"></i> ผลการประเมินการฝึกสอน
                        </h3>
                    </div>
                    <div class="card-body overflow-x-auto p-0">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>คะแนน</th>
                                    <th>ข้อเสนอแนะ</th>
                                    <th>วันที่</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($evaluations ?? [] as $evaluation)
                                    <tr>
                                        <td>
                                            <span class="text-lg font-bold {{ $evaluation->score >= 80 ? 'text-green-600' : ($evaluation->score >= 60 ? 'text-yellow-600' : 'text-red-600') }}">
                                                {{ $evaluation->score }}
                                            </span>
                                        </td>
                                        <td class="text-sm">{{ $evaluation->comment ?? '-' }}</td>
                                        <td class="text-sm">{{ $evaluation->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-gray-500 py-6">ยังไม่มีข้อมูลการประเมิน</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- ฟอร์มส่งรายงาน --}}
            <div class="card border-t-4 border-custom-purple">
                <div class="card-header">
                    <h3 class="section-title !border-0 !pb-0 !mb-0">
                        <i class="fas fa-paper-plane text-custom-purple"></i> ส่งรายงานการฝึกสอน
                    </h3>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success mb-4 flex items-center gap-2">
                            <i class="fas fa-check-circle"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">ชื่อรายงาน <span class="text-red-500">*</span></label>
                                <input type="text" name="title" placeholder="เช่น รายงานการฝึกสอนสัปดาห์ที่ 1" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-custom-purple focus:border-custom-purple transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">ไฟล์รายงาน <span class="text-red-500">*</span></label>
                                <input type="file" name="report_file" required accept=".pdf,.doc,.docx"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm file:mr-4 file:py-1 file:px-4 file:rounded-lg file:border-0 file:text-sm file:bg-custom-purple file:text-white hover:file:bg-custom-purple-700 transition-colors">
                                <p class="text-xs text-gray-400 mt-1">รองรับไฟล์ PDF, DOC, DOCX (สูงสุด 5MB)</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">รายละเอียดเพิ่มเติม</label>
                            <textarea name="description" rows="2" placeholder="อธิบายเนื้อหาของรายงาน (ไม่บังคับ)"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-custom-purple focus:border-custom-purple transition-colors"></textarea>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary px-8 py-2.5">
                                <i class="fas fa-paper-plane mr-2"></i> ส่งรายงาน
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- ประวัติการส่งรายงาน --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="section-title !border-0 !pb-0 !mb-0">
                        <i class="fas fa-history text-custom-yellow"></i> ประวัติการส่งรายงาน
                    </h3>
                </div>
                <div class="card-body overflow-x-auto p-0">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ชื่อรายงาน</th>
                                <th>วันที่ส่ง</th>
                                <th>สถานะ</th>
                                <th>ความคิดเห็น</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($myReports as $report)
                            <tr>
                                <td class="font-medium">{{ $report->title }}</td>
                                <td>{{ $report->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <span class="badge {{ $report->status === 'approved' ? 'badge-success' : ($report->status === 'rejected' ? 'badge-danger' : 'badge-warning') }}">
                                        @if($report->status === 'approved')
                                            <i class="fas fa-check mr-1"></i> อนุมัติ
                                        @elseif($report->status === 'rejected')
                                            <i class="fas fa-times mr-1"></i> ส่งกลับ
                                        @else
                                            <i class="fas fa-clock mr-1"></i> รอตรวจ
                                        @endif
                                    </span>
                                </td>
                                <td class="text-sm text-gray-500">{{ $report->teacher_comment ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-gray-500 py-6">ยังไม่มีรายงานที่ส่ง</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ประวัติการเข้าฝึกสอน --}}
            <div class="card">
                <div class="card-header flex items-center justify-between">
                    <h3 class="section-title !border-0 !pb-0 !mb-0">
                        <i class="fas fa-calendar-check text-green-500"></i> ประวัติการเข้าฝึกสอน
                    </h3>
                    <a href="{{ route('attendance.index') }}" class="text-sm text-custom-purple hover:underline">ดูทั้งหมด</a>
                </div>
                <div class="card-body overflow-x-auto p-0">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>วันที่</th>
                                <th>เวลาเข้า</th>
                                <th>เวลาออก</th>
                                <th>สถานะ</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($attendances as $att)
                            <tr>
                                <td>{{ $att->date->format('d/m/Y') }}</td>
                                <td>{{ $att->check_in_time ?? '-' }}</td>
                                <td>{{ $att->check_out_time ?? '-' }}</td>
                                <td>
                                    <span class="badge {{ $att->status === 'present' ? 'badge-success' : ($att->status === 'late' ? 'badge-warning' : 'badge-danger') }}">
                                        {{ $att->status === 'present' ? 'มา' : ($att->status === 'late' ? 'สาย' : ($att->status === 'leave' ? 'ลา' : 'ขาด')) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-gray-500 py-6">ยังไม่มีข้อมูลการเข้าฝึกสอน</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>