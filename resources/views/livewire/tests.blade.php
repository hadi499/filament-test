<div class="max-w-2xl mx-auto px-2 mt-6">
  
  
    <h1 class="text-2xl text-center font-bold text-blue-600 mb-6">{{ $title }}</h1>           


    <!-- Timer -->
    @if (!$test)
        <!-- Daftar Quiz -->
        @if (!empty($tests))
            <div class="flex justify-end">
                <a wire:navigate href="{{route('home')}}">
                    <div class="text-slate-600 text-center mb-5 text-sm font-semibold py-1 px-2 border border-slate-500 rounded-sm hover:bg-slate-800 hover:text-white">
                        Back
                    </div>
                </a>
            </div>
            <div class="flex justify-evenly flex-wrap">
                @foreach($tests as $test)
                    <div class="border shadow mb-3 p-4 w-[300px] flex flex-col items-center">
                        <div class="text-center">
                            <h1 class="text-xl font-semibold">{{ $test->title }}</h1>
                        </div>
                        <button
                            class="mt-3 text-center text-blue-700 py-2 px-2 border border-blue-500 rounded hover:text-white hover:bg-blue-700 w-56"
                            wire:click="startTest({{ $test->id }})">
                            Start Test
                        </button>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">NO.</p>
        @endif
    @else
        <!-- Pertanyaan Quiz -->
        @if (!empty($questions) && $score === 0 && empty($incorrectQuestions))
            <div id="timer"
                class="fixed top-[70px] right-0 md:right-0 lg:right-[300px] w-24 text-xl font-semibold text-red-600"
                wire:ignore 
                x-data="{ timeRemaining: @entangle('timeRemaining'), interval: null }" 
                x-init="
                    interval = setInterval(() => {
                        if (timeRemaining > 0) {
                            timeRemaining--;
                        } else {
                            clearInterval(interval);
                            $wire.call('submitTest'); 
                        }
                    }, 1000);
                " 
                x-text="Math.floor(timeRemaining / 60) + ':' + ('0' + (timeRemaining % 60)).slice(-2)">
            </div>

            <form wire:submit.prevent="submitTest" class="p-4 mb-6">
                <div class="flex flex-col gap-2 ">
             
                    <div class="">                      
                        <h3 class="text-xl font-bold">{{ $command }}</h3>
                    </div>

                    @foreach($questions as $question)                   
                
                        <div>Pertanyaan no. {{$loop->iteration}}</div>
                        <div class="border">
                            <div class="bg-blue-100 p-2">
                                <h4 class="text-lg font-semibold ml-3">{{ $question['text'] ?? $question->text }}</h4>
                            </div>
                            <div class="space-y-4 md:ml-6 my-4 px-2">
                                @foreach(['option_a', 'option_b', 'option_c'] as $option)
                                    <label class="block ml-4">
                                        <input type="radio" 
                                            wire:model="answers.{{ $question['id'] ?? $question->id }}" 
                                            value="{{ $question[$option] ?? $question->$option }}">
                                        <span class="ml-2">{{ $question[$option] ?? $question->$option }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-between mt-6">
                    <div>
                        <a wire:navigate href="{{route('tests')}}" 
                            class="text-slate-600 text-center text-sm font-semibold py-1 px-2 border border-slate-500 rounded-sm hover:bg-slate-800 hover:text-white">
                            Back
                        </a>
                    </div>
                    <button type="submit"
                        class="bg-indigo-600 text-white text-center text-sm font-semibold py-1 px-2 rounded-sm hover:bg-indigo-700 transition">
                        Submit
                    </button>
                </div>
            </form>
        @endif

        <!-- Skor dan Pertanyaan Salah -->
        @if ($score > 0 || !empty($incorrectQuestions))
            <div class="flex justify-center">
                <div class="w-full md:w-[360px]">
                    

                    <h3 class="text-xl text-blue-600 font-bold mt-6 mb-2">Skor Anda: {{ $score }}</h3>
                    
                    @if (!empty($incorrectQuestions))
                        <h4 class="text-lg font-semibold mb-3">Jawaban salah:</h4>
                        @foreach($incorrectQuestions as $incorrect)
                            <div class="bg-red-100 p-4 mb-4 rounded-lg w-full flex gap-2">
                                <strong>{{ $incorrect['question'] }}</strong> |
                                <p>{{ $incorrect['your_answer'] }}</p>
                            </div>
                        @endforeach
                    @endif
                    <a wire:navigate href="{{route('tests')}}">
                        <div class="text-slate-600 text-center text-sm font-semibold py-1 px-2 border border-slate-500 rounded-sm hover:bg-slate-800 hover:text-white">
                            Back
                        </div>
                    </a>
                </div>
            </div>
        @endif
    @endif
</div>