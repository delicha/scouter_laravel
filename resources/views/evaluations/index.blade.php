<x-app-layout>

    <div class="flex flex-row flex-wrap justify-center items-center m-10 max-w-400 ">
        <div class="bg-white rounded-lg shadow-lg card max-w-400 sm:max-w-250 overflow-hidden text-center">
            <div class="p-6">
                <h2 class="text-xl font-bold mb-2">{{ $auth->name }}さんへの評価一覧</h2>
            </div>
            
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            評価した人
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            評価点
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            評価日
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('users.show', $user->id) }}">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="https://picsum.photos/300/300/?random&category=people" alt="">
                                </div>
                                <span class="text-sm text-gray-600">{{ $user->name }}</span>
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">
                                @php
                                    $eval = $evaluations->where('user_id', $user->id)->first();
                                @endphp
                                {{ $eval->evaluation_point }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">
                                {{ $user->created_at->format("Y") }}<br />
                                {{ $user->created_at->format("m/d H:i") }}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- <div class="m-10">
        {{ $evaluations->links() }}
    </div> --}}

</x-app-layout>
