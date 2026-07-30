<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('แบบประเมินนักศึกษา') }}
            <span class="text-sm font-normal text-gray-500 ml-2">({{ $type == 'training' ? 'การฝึกระหว่างเรียน' : 'การฝึกปฏิบัติการสอน' }})</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-8">
                
                <div class="mb-8 p-4 bg-purple-50 rounded-xl flex items-center justify-between">
                    <div>
                        <p class="text-sm text-purple-600 font-semibold mb-1">นักศึกษาที่รับการประเมิน</p>
                        <p class="text-lg font-bold text-gray-800">{{ $student->memberProfile->name_th ?? $student->name }} ({{ $student->student_id }})</p>
                    </div>
                    <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-200">
                        @if($student->avatar)
                            <img src="{{ Storage::url($student->avatar) }}" alt="Student Photo" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-100"><i class="fas fa-user"></i></div>
                        @endif
                    </div>
                </div>

                <form action="{{ route('evaluations.store', $student->id) }}" method="POST">
                    @csrf

                    <style>
                        /* Force active state styles without relying on Vite compilation */
                        input.rating-radio:checked + label {
                            border-color: #6b21a8 !important;
                            background-color: #faf5ff !important;
                            color: #6b21a8 !important;
                        }
                        input.rating-radio:checked + label .text-gray-500 {
                            color: #6b21a8 !important;
                        }
                    </style>

                    <div class="space-y-6">
                        @foreach($questions as $key => $question)
                        <div class="p-6 border border-gray-100 rounded-xl hover:border-blue-200 hover:bg-blue-50/30 transition-colors">
                            <p class="font-bold text-gray-800 mb-4">{{ $question }}</p>
                            
                            <div class="flex items-center gap-2 sm:gap-6">
                                @for($i = 1; $i <= 5; $i++)
                                <div class="flex-1">
                                    <input type="radio" name="scores[{{ $key }}]" id="score_{{ $key }}_{{ $i }}" value="{{ $i }}" class="rating-radio peer sr-only" required>
                                    <label for="score_{{ $key }}_{{ $i }}" class="block w-full cursor-pointer select-none text-center py-3 rounded-lg border-2 border-gray-200 peer-checked:border-custom-purple peer-checked:bg-purple-50 peer-checked:text-custom-purple hover:border-custom-purple hover:bg-purple-50/50 transition-all">
                                        <span class="block text-xl font-bold">{{ $i }}</span>
                                        <span class="text-xs text-gray-500 mt-1 block">
                                            @if($i == 1) ปรับปรุง @elseif($i == 5) ดีมาก @else &nbsp; @endif
                                        </span>
                                    </label>
                                </div>
                                @endfor
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-10 flex justify-end">
                        <x-primary-button class="px-8 py-3 text-lg rounded-xl bg-custom-purple hover:bg-purple-700">
                            {{ __('บันทึกคะแนนประเมิน') }} <i class="fas fa-save ml-2"></i>
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
