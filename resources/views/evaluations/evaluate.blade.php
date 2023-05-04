<x-app-layout>

    <div class="flex flex-row flex-wrap justify-center items-center m-10">
        <div class="bg-white rounded-lg shadow-lg card max-w-300 sm:max-w-250 overflow-hidden text-center">
            <div class="p-6">
                <h2 class="text-xl font-bold mb-2">{{ $user->name }}<span class="text-sm">さん</span></h2>
            </div>
            <i class="fa-solid fa-bars-progress fa-bounce text-4xl"></i>
            
            <form action="{{ route('evaluations.store') }}" method="POST">
                @csrf
                <div class="swappy-radios" role="radiogroup" aria-labelledby="swappy-radios-label">
                    <input type="hidden" name="user_id" value="{{ $auth->id }}" />
                    <input type="hidden" name="target_user_id" value="{{ $user->id }}" />

                    <label class="text-left">
                        <input type="radio" name="options" value="1" checked />
                        <span class="radio"></span>
                        @if($user->gender==0)
                            <span>あきらめないで。(レベル1)</span>
                        @else
                            <span>修行編エピソード１的な。。(レベル1)</span>
                        @endif
                    </label>
                    <label class="text-left">
                        <input type="radio" name="options" value="2" />
                        <span class="radio"></span>
                        @if($user->gender==0)
                            <span>まずは自分磨きね。(レベル2)</span>
                        @else
                            <span>まずは自分磨きをしよう。。(レベル2)</span>
                        @endif
                    </label>
                    <label class="text-left">
                        <input type="radio" name="options" value="3" />
                        <span class="radio"></span>
                        @if($user->gender==0)
                            <span>まだ自分が見えてない。(レベル3)</span>
                        @else
                            <span>自分が見えてないと思う。(レベル3)</span>
                        @endif
                    </label>
                    <label class="text-left">
                        <input type="radio" name="options" value="4" />
                        <span class="radio"></span>
                        @if($user->gender==0)
                            <span>少し実力不足。(レベル4)</span>
                        @else
                            <span>イマイチかな。。(レベル4)</span>
                        @endif
                    </label>
                    <label class="text-left">
                        <input type="radio" name="options" value="5" />
                        <span class="radio"></span>
                        @if($user->gender==0)
                            <span>まぁまぁ。(レベル5)</span>
                        @else
                            <span>まぁまぁかな。(レベル5)</span>
                        @endif
                    </label>
                </div>    
    
                <div class="flex justify-center m-5">
                    <x-secondary-button type="submit">
                        測定する
                    </x-secondary-button>
                </div>
            </form>
            
        </div>
    </div>

</x-app-layout>
