<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-custom-purple">
            <i class="fas fa-bullhorn mr-2"></i>ข่าวประชาสัมพันธ์
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($announcements as $news)
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
                        <h3 class="font-bold text-gray-800 text-lg mb-2 group-hover:text-custom-purple transition-colors line-clamp-2">
                            {{ $news->title }}
                        </h3>
                        <p class="text-sm text-gray-500 line-clamp-3 mb-4">
                            {{ Str::limit(strip_tags($news->content), 150) }}
                        </p>
                        <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                            <span class="text-xs text-gray-400">
                                <i class="fas fa-clock mr-1"></i> {{ $news->created_at->diffForHumans() }}
                            </span>
                            <a href="{{ route('announcements.show', $news) }}" class="text-custom-purple text-sm font-medium hover:underline">
                                อ่านเพิ่มเติม <i class="fas fa-arrow-right ml-1 text-xs"></i>
                            </a>
                        </div>
                    </div>
                </article>
                @empty
                <div class="col-span-full text-center py-16">
                    <i class="fas fa-bullhorn text-6xl text-gray-200 mb-4"></i>
                    <p class="text-gray-500 text-lg">ยังไม่มีข่าวประชาสัมพันธ์</p>
                </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $announcements->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
