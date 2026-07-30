<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-custom-purple">
            <i class="fas fa-calendar-check mr-2"></i>บันทึกการเข้าฝึกสอน
        </h2>
        <p class="text-sm text-gray-500 mt-1">ประวัติการลงเวลาเข้า-ออกฝึกสอน</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Stats --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="stat-value">{{ $stats['total_days'] }}</div>
                            <div class="stat-label">วันทั้งหมด</div>
                        </div>
                        <div class="stat-icon gradient-purple"><i class="fas fa-calendar text-xl"></i></div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="stat-value text-green-600">{{ $stats['present_days'] }}</div>
                            <div class="stat-label">มาตรงเวลา</div>
                        </div>
                        <div class="stat-icon bg-gradient-to-br from-green-500 to-emerald-600"><i class="fas fa-check text-xl"></i></div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="stat-value text-yellow-600">{{ $stats['late_days'] }}</div>
                            <div class="stat-label">มาสาย</div>
                        </div>
                        <div class="stat-icon bg-gradient-to-br from-yellow-400 to-yellow-600"><i class="fas fa-clock text-xl"></i></div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="stat-value text-red-600">{{ $stats['absent_days'] }}</div>
                            <div class="stat-label">ขาด</div>
                        </div>
                        <div class="stat-icon bg-gradient-to-br from-red-400 to-red-600"><i class="fas fa-times text-xl"></i></div>
                    </div>
                </div>
            </div>

            {{-- Today check-in --}}
            <div class="card border-t-4 {{ $todayAttendance ? 'border-green-500' : 'border-custom-yellow' }}">
                <div class="card-body">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                        <div class="text-center md:text-left">
                            <h3 class="text-lg font-bold text-gray-800">{{ now()->locale('th')->translatedFormat('l j F Y') }}</h3>
                            <p class="text-sm text-gray-500">
                                @if(!$todayAttendance)
                                    ยังไม่ได้ลงเวลาวันนี้
                                @elseif(!$todayAttendance->check_out_time)
                                    เข้าเวลา: {{ $todayAttendance->check_in_time }} · ยังไม่ลงเวลาออก
                                @else
                                    เข้า: {{ $todayAttendance->check_in_time }} · ออก: {{ $todayAttendance->check_out_time }}
                                @endif
                            </p>
                        </div>
                        <div class="flex gap-3 items-center flex-wrap">
                            <a href="{{ route('attendance.leave-form') }}" target="_blank" class="btn bg-blue-100 text-blue-700 hover:bg-blue-200 px-4 whitespace-nowrap">
                                <i class="fas fa-file-pdf mr-2"></i> ใบลา (รายวิชา)
                            </a>
                            <a href="{{ route('attendance.leave-form-internship') }}" target="_blank" class="btn bg-purple-100 text-purple-700 hover:bg-purple-200 px-4 whitespace-nowrap">
                                <i class="fas fa-file-pdf mr-2"></i> ใบลา (ฝึกสอน)
                            </a>
                            
                            @if(!$todayAttendance)
                                <form action="{{ route('attendance.checkIn') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success px-6">
                                        <i class="fas fa-sign-in-alt mr-2"></i> ลงเวลาเข้า
                                    </button>
                                </form>
                            @elseif(!$todayAttendance->check_out_time)
                                <form action="{{ route('attendance.checkOut') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger px-6">
                                        <i class="fas fa-sign-out-alt mr-2"></i> ลงเวลาออก
                                    </button>
                                </form>
                            @else
                                <span class="btn bg-green-100 text-green-700 cursor-default">
                                    <i class="fas fa-check-double mr-2"></i> ลงเวลาครบแล้ว
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- History Table --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="section-title !border-0 !pb-0 !mb-0">
                        <i class="fas fa-history text-custom-yellow"></i> ประวัติการเข้าฝึกสอน
                    </h3>
                </div>
                <div class="card-body overflow-x-auto p-0">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>วันที่</th>
                                <th>เวลาเข้า</th>
                                <th>เวลาออก</th>
                                <th>สถานะ</th>
                                <th>หมายเหตุ</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($attendances as $att)
                            <tr>
                                <td>{{ $att->date->format('d/m/Y') }}</td>
                                <td>{{ $att->check_in_time ?? '-' }}</td>
                                <td>{{ $att->check_out_time ?? '-' }}</td>
                                <td>
                                    <span class="badge {{ $att->status === 'present' ? 'badge-success' : ($att->status === 'late' ? 'badge-warning' : ($att->status === 'leave' ? 'badge-info' : 'badge-danger')) }}">
                                        @switch($att->status)
                                            @case('present') <i class="fas fa-check mr-1"></i> มา @break
                                            @case('late') <i class="fas fa-clock mr-1"></i> สาย @break
                                            @case('leave') <i class="fas fa-home mr-1"></i> ลา @break
                                            @default <i class="fas fa-times mr-1"></i> ขาด
                                        @endswitch
                                    </span>
                                </td>
                                <td class="text-sm text-gray-500">{{ $att->note ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center text-gray-500 py-8">ยังไม่มีข้อมูล</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                {{ $attendances->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
