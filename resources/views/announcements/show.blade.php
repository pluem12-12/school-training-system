<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('announcements.index') }}" class="text-gray-400 hover:text-custom-purple transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="text-xl font-bold text-custom-purple">ข่าวประชาสัมพันธ์</h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <article class="card">
                <div class="p-8">
                    {{-- Category + Date --}}
                    <div class="flex items-center gap-3 mb-4">
                        @if($announcement->is_pinned)
                            <span class="badge badge-danger"><i class="fas fa-thumbtack mr-1"></i> ปักหมุด</span>
                        @endif
                        <span class="badge badge-purple">
                            @switch($announcement->category)
                                @case('urgent') <i class="fas fa-exclamation-circle mr-1"></i> ด่วน @break
                                @case('event') <i class="fas fa-calendar mr-1"></i> กิจกรรม @break
                                @default <i class="fas fa-info-circle mr-1"></i> ทั่วไป
                            @endswitch
                        </span>
                        <span class="text-sm text-gray-400">
                            <i class="fas fa-clock mr-1"></i> {{ $announcement->created_at->locale('th')->translatedFormat('j F Y H:i น.') }}
                        </span>
                    </div>

                    {{-- Title --}}
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $announcement->title }}</h1>

                    {{-- Author --}}
                    @if($announcement->author)
                    <div class="flex items-center gap-3 mb-6 pb-6 border-b border-gray-100">
                        <div class="w-10 h-10 gradient-purple rounded-full flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr($announcement->author->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">{{ $announcement->author->name }}</p>
                            <p class="text-xs text-gray-500">{{ $announcement->author->role === 'admin' ? 'ผู้ดูแลระบบ' : 'เจ้าหน้าที่' }}</p>
                        </div>
                    </div>
                    @endif

                    {{-- Content --}}
                    <div class="prose prose-purple max-w-none text-gray-700 leading-relaxed">
                        {!! nl2br(e($announcement->content)) !!}
                    </div>

                    {{-- Image --}}
                    @if($announcement->image)
                    <div class="mt-6">
                        <img src="{{ Storage::url($announcement->image) }}" alt="{{ $announcement->title }}" class="rounded-xl shadow-sm max-w-full">
                    </div>
                    @endif
                </div>
            </article>

            <div class="mt-6">
                <a href="{{ route('announcements.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-left mr-2"></i> กลับไปรายการข่าว
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
