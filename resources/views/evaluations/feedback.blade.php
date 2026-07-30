<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ข้อเสนอแนะเพิ่มเติม') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-8">
                
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check-circle text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">บันทึกคะแนนเรียบร้อยแล้ว</h3>
                    <p class="text-gray-500">ขั้นตอนสุดท้าย: กรุณากรอกข้อเสนอแนะเพิ่มเติมสำหรับนักศึกษา</p>
                </div>

                <form action="{{ route('evaluations.feedback.store', $evaluation->id) }}" method="POST">
                    @csrf
                    
                    <div class="mb-6">
                        <x-input-label for="comment" :value="__('ข้อเสนอแนะเพิ่มเติม (ถ้ามี)')" class="text-lg font-bold" />
                        <textarea id="comment" name="comment" rows="6" class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm p-4" placeholder="พิมพ์ข้อเสนอแนะ คำแนะนำ หรือสิ่งที่นักศึกษาควรปรับปรุง..."></textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('comment')" />
                    </div>

                    <div class="flex justify-end mt-8">
                        <x-primary-button class="px-8 py-3 text-lg rounded-xl bg-custom-purple hover:bg-purple-700">
                            {{ __('บันทึกข้อเสนอแนะและเสร็จสิ้น') }} <i class="fas fa-check ml-2"></i>
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
