<x-app-layout>

    <div class="flex flex-row flex-wrap justify-center items-center m-10">
        <div class="bg-white rounded-lg shadow-lg card max-w-300 sm:max-w-250 overflow-hidden text-center">
            <div class="p-6">
                <h2 class="text-xl font-bold mb-2">{{ $user->name }}</h2>
            </div>
            <i class="fa-solid fa-bars-progress fa-bounce text-4xl"></i>

            <h3 class="text-xl font-bold my-3">Select an option</h3>

            <div class="swappy-radios" role="radiogroup" aria-labelledby="swappy-radios-label">
                
                <label class="text-left">
                    <input type="radio" name="options" checked />
                    <span class="radio"></span>
                    @if($user->gender==0)
                        <span>レベル1：あきらめないで。</span>
                    @else
                        <span>レベル1：修行編エピソード１的な。。</span>
                    @endif
                </label>
                <label class="text-left">
                    <input type="radio" name="options" />
                    <span class="radio"></span>
                    @if($user->gender==0)
                        <span>レベル2：まずは自分磨きね。</span>
                    @else
                        <span>レベル2：まずは自分磨きをしよう。。</span>
                    @endif
                </label>
                <label class="text-left">
                    <input type="radio" name="options" />
                    <span class="radio"></span>
                    @if($user->gender==0)
                        <span>レベル3：まだ自分が見えてない。</span>
                    @else
                        <span>レベル3：自分が見えてないと思う。</span>
                    @endif
                </label>
                <label class="text-left">
                    <input type="radio" name="options" />
                    <span class="radio"></span>
                    @if($user->gender==0)
                        <span>レベル4：少し実力不足。</span>
                    @else
                        <span>レベル4：イマイチかな。。</span>
                    @endif
                </label>
                <label class="text-left">
                    <input type="radio" name="options" />
                    <span class="radio"></span>
                    @if($user->gender==0)
                        <span>レベル5：まぁまぁ。</span>
                    @else
                        <span>レベル5：まぁまぁかな。</span>
                    @endif
                </label>
            </div>    

            <div class="flex justify-center m-5">
                <x-secondary-button>
                    測定する
                </x-secondary-button>
            </div>
        </div>
    </div>

</x-app-layout>
