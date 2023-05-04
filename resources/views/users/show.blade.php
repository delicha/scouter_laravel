<x-app-layout>

    <div class="flex flex-row flex-wrap justify-center items-center m-10">
        <div class="bg-white rounded-lg shadow-lg card max-w-300 sm:max-w-250 overflow-hidden">
            @if($user->main_image)
                <img src="https://picsum.photos/300/300/?random&category=people" alt="Profile picture" class="w-full h-48 object-cover rounded-t-lg">
            @else
                <img src="{{ asset('img/default_profile_img.png') }}" alt="Profile picture" class="w-full h-48 object-cover rounded-t-lg">
            @endif

            <div class="p-6">
                <h2 class="text-2xl font-bold mb-2 text-center">{{ $user->name }}<span class="text-sm font-normal">さん</span></h2>
                <div class="text-center mb-3">
                    <i class="fa-solid fa-p fa-bounce text-3xl" style="color: orange;font-weight:bold;"></i>
                    <span class="text-3xl px-3">{{ $point->point }}</span>ポイントを所持
                </div>
                <h3 class="text-white bg-gray-400 p-1 pl-2 rounded-sm">Hobby</h3>
                <p class="my-2">{{ $user->hobby }}</p>
                <h3 class="text-white bg-gray-400 p-1 pl-2 rounded-sm">Character</h3>
                <p class="break-word max-w-300 sm:max-w-250 overflow-hidden my-2">{{ $user->character }}</p>
                <h3 class="text-white bg-gray-400 p-1 pl-2 rounded-sm">Generation</h3>
                <p class="my-2">{{ $user->generation }}</p>

                <div class="photos photos_slide">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            {{-- @foreach($refilldetail->refilldetailimages as $image) --}}
                                <div class="swiper-slide">
                                    <img src="https://picsum.photos/300/300/?random&category=people" alt="Profile picture" class="w-full h-48 object-cover">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://picsum.photos/300/300/?random&category=people" alt="Profile picture" class="w-full h-48 object-cover">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://picsum.photos/300/300/?random&category=people" alt="Profile picture" class="w-full h-48 object-cover">
                                </div>
                            {{-- @endforeach --}}
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
            @if($auth)
                <div class="flex justify-center m-3">
                    <x-secondary-button>
                        <a href="{{ route('profile.edit') }}">プロフィール編集</a>
                    </x-secondary-button>
                </div>
            @else
                <div class="flex justify-center m-3">
                    <x-secondary-button>
                        <a href="{{ route('evaluations.evaluate', $user->id) }}">測定する</a>
                    </x-secondary-button>
                </div>
            @endif
        </div>
    </div>
    @if($auth)
        <div class="flex flex-row m-10 justify-between mb-10">
            <div class="bg-white rounded-lg shadow-lg card max-w-300 sm:max-w-250 overflow-hidden p-5">
                <div class="text-center mb-2">
                    <i class="fa-solid fa-bars-progress fa-bounce text-4xl"></i>
                </div>
                <h2 class="text-center text-xl font-bold mb-2">印象</h2>
                <p class="break-word max-w-300 sm:max-w-250 overflow-hidden mb-1">{{ $user->character }}</p>
            </div>
            <div class="bg-white rounded-lg shadow-lg card max-w-300 sm:max-w-250 overflow-hidden p-5">
                <div class="text-center mb-2">
                    <i class="fa-solid fa-user-group fa-bounce text-4xl"></i>
                </div>
                <h2 class="text-center text-xl font-bold mb-2">世代別支持率</h2>
                <p class="break-word max-w-300 sm:max-w-250 overflow-hidden mb-1">{{ $user->character }}</p>
            </div>
            <div class="bg-white rounded-lg shadow-lg card max-w-300 sm:max-w-250 overflow-hidden p-5">
                <div class="text-center mb-2">
                    <i class="fa-solid fa-venus-mars fa-bounce text-4xl"></i>
                </div>
                <h2 class="text-center text-xl font-bold mb-2">性別別支持率</h2>
                <p class="break-word max-w-300 sm:max-w-250 overflow-hidden mb-1">{{ $user->character }}</p>
            </div>
        </div>
        <div class="flex justify-center m-3">
            <x-secondary-button>
                <a href="{{ route('evaluations.index') }}">自分を評価した人を見る</a>
            </x-secondary-button>
        </div>
    @endif
</x-app-layout>
