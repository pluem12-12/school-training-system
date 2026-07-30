<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center text-sm text-gray-500 gap-2">
            <i class="fas fa-home"></i>
            <a href="/" class="hover:text-gray-700">หน้าแรก</a>
            <span>/</span>
            <span>ข้อมูลสารสนเทศ</span>
            <span>/</span>
            <span class="text-gray-700">ดาวน์โหลดแบบฟอร์มเอกสารราชการ</span>
        </div>
    </x-slot>

    <div class="py-8 bg-white min-h-screen" x-data="{ 
        activeCategory: 'all',
        categories: {
            'all': 'เอกสารทั้งหมด',
            'general': 'เอกสารทั่วไป',
            'orders': 'คำสั่งแต่งตั้ง',
            'memos': 'บันทึกข้อความ',
            'leaves': 'ใบลาสำหรับนักศึกษา'
        },
        documents: [
            @foreach($documents as $doc)
            { 
                id: {{ $doc->id }}, 
                title: '{{ addslashes($doc->title) }}', 
                category: '{{ $doc->category }}', 
                type: '{{ strtolower(pathinfo($doc->file_path, PATHINFO_EXTENSION)) === "pdf" ? "pdf" : "word" }}',
                url: '{{ asset("storage/" . $doc->file_path) }}'
            },
            @endforeach
        ],
        get filteredDocuments() {
            return this.documents.filter(doc => this.activeCategory === 'all' || doc.category === this.activeCategory);
        }
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800 border-b border-gray-200 pb-4">ดาวน์โหลดแบบฟอร์มเอกสารราชการ</h1>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                
                <!-- Sidebar Navigation -->
                <div class="lg:col-span-1 bg-[#f5f5f5] rounded-lg py-2 self-start border border-gray-200">
                    <nav class="flex flex-col">
                        <template x-for="(name, key) in categories" :key="key">
                            <button @click="activeCategory = key" 
                                    :class="{'bg-custom-purple text-white mx-2 rounded': activeCategory === key, 'text-gray-700 hover:bg-gray-200 mx-2 rounded': activeCategory !== key}" 
                                    class="text-left px-4 py-3 text-sm transition-colors duration-150 my-1 font-medium">
                                <span x-text="name"></span>
                            </button>
                        </template>
                    </nav>
                </div>

                <!-- Main Content Area -->
                <div class="lg:col-span-3">
                    
                    <!-- Header Section for List -->
                    <div class="mb-6 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500">
                            <i class="fas fa-cloud-download-alt text-lg"></i>
                        </div>
                        <h3 class="text-xl font-medium text-gray-800" x-text="categories[activeCategory]"></h3>
                    </div>

                    <!-- Documents List -->
                    <div class="border-t border-gray-200">
                        <template x-for="doc in filteredDocuments" :key="doc.id">
                            <a :href="doc.url" 
                               target="_blank"
                               class="border-b border-gray-200 py-4 flex items-center gap-4 hover:bg-gray-50 transition-colors group w-full">
                                <!-- Document Icon -->
                                <div class="w-8 h-8 flex items-center justify-center text-gray-600 border border-gray-300 rounded shadow-sm bg-white shrink-0">
                                    <template x-if="doc.type === 'word'">
                                        <span class="font-bold text-xs">W</span>
                                    </template>
                                    <template x-if="doc.type === 'pdf'">
                                        <span class="font-bold text-[10px]">PDF</span>
                                    </template>
                                    <template x-if="doc.type === 'link'">
                                        <i class="fas fa-external-link-alt text-xs"></i>
                                    </template>
                                </div>
                                
                                <!-- Document Info -->
                                <div class="flex-1">
                                    <span class="text-gray-700 text-base group-hover:text-black transition-colors" x-text="doc.title"></span>
                                </div>
                            </a>
                        </template>
                        
                        <!-- Empty State -->
                        <div x-show="filteredDocuments.length === 0" x-cloak class="py-12 text-center text-gray-500">
                            <i class="fas fa-folder-open text-3xl mb-3 text-gray-300"></i>
                            <p>ไม่มีเอกสารในหมวดหมู่นี้</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
