<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-custom-purple">
            <i class="fas fa-file-alt mr-2"></i>รายงานทั้งหมด
        </h2>
        <p class="text-sm text-gray-500 mt-1">ดูและจัดการรายงานของนักศึกษา</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="card-body overflow-x-auto p-0">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ชื่อนักศึกษา</th>
                                <th>ชื่อรายงาน</th>
                                <th>สถานะ</th>
                                <th>วันที่ส่ง</th>
                                <th>ดาวน์โหลด</th>
                                <th>จัดการ</th>
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
                                    <a href="{{ Storage::url($report->file_path) }}" target="_blank" class="text-custom-purple hover:underline text-sm">
                                        <i class="fas fa-download mr-1"></i> ดาวน์โหลด
                                    </a>
                                </td>
                                <td>
                                    @if($report->status === 'pending')
                                    <div class="flex gap-1">
                                        <form action="{{ route('reports.approve', $report) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success text-xs !px-2 !py-1" onclick="return confirm('ยืนยันอนุมัติ?')">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('reports.reject', $report) }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="teacher_comment" value="กรุณาแก้ไขและส่งใหม่">
                                            <button type="submit" class="btn btn-danger text-xs !px-2 !py-1" onclick="return confirm('ยืนยันส่งกลับ?')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                    @else
                                        <span class="text-xs text-gray-400">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center text-gray-500 py-8">ยังไม่มีรายงาน</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-4">
                {{ $reports->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
