<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('スカウターメンバー一覧') }}
        </h2>
    </x-slot>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> --}}

    <div class="flex flex-row flex-wrap justify-center items-center mt-10">
        @foreach($users as $user)
        <a href="{{ route('users.show', $user) }}">
            <div class="flex-column justify-center m-3">
                <div class="border border-gray-300 rounded-full w-32 h-32 overflow-hidden m-auto">
                    @if($user->main_image)
                        <img src="https://picsum.photos/300/300/?random&category=people" alt="Profile picture" class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset('img/default_profile_img.png') }}" alt="Profile picture" class="w-full h-full object-cover">
                    @endif
                </div>
                <p class="text-center">{{ $user->name }}</p>
            </div>
        </a>
            
        @endforeach
    </div>

    <div class="m-10">
        {{ $users->links() }}
    </div>

</x-app-layout>
