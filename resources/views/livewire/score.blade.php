<div class="overflow-auto p-2  flex justify-center mt-6">

    <div class="w-full  md:w-[800px]">
        <div class="md:flex md:justify-end mb-5">
            <a wire:navigate href="{{route('home')}}">
                <div
                    class="text-slate-600 text-center text-sm font-semibold py-2 md:py-1 px-2 border border-slate-500  rounded-sm  hover:bg-slate-800 hover:text-white">

                    Back
                </div>
            </a>
        </div>

        <table class=" bg-white border w-full border-gray-300 text-sm">
            <thead>
                <tr class="bg-green-100 border-b">
                    <th class="text-left py-3 px-4 font-semibold text-sm text-gray-800">No.</th>
                    <th class="text-left py-3 px-4 font-semibold text-sm text-gray-800">Test</th>
                    <th class="text-left py-3 px-4 font-semibold text-sm text-gray-800">Questions</th>
                    <th class="text-left py-3 px-4 font-semibold text-sm text-gray-800">User</th>
                    <th class="text-left py-3 px-4 font-semibold text-sm text-gray-800">Score</th>
                    <th class="text-left py-3 px-4 font-semibold text-sm text-gray-800">Created at</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $result)
                <tr class="hover:bg-green-50">
                    <td class="py-3 px-4 border-b">{{$loop->iteration}}.</td>
                    <td class="py-3 px-4 border-b">{{$result->test->title}}</td>
                    <td class="py-3 px-4 text-center border-b">{{$result->test->number_of_questions}}</td>
                    <td class="py-3 px-4 border-b">{{$result->user->name}}</td>
                    <td class="py-3 px-4 border-b">{{$result->score}}</td>
                    <td class="py-3 px-4 border-b">{{
                        \Carbon\Carbon::parse($result->created_at)->locale('id')->translatedFormat('d M Y, H:i:s') }}
                    </td>


                </tr>
                @endforeach

                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>


</div>