<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach($lists as $list)
                    <div class="p-6 bg-white border-b border-gray-200">
                        <strong>{{ $list->name }}</strong>
                        <hr />
                        <ul class="list-disc">
                            @foreach($list->Tasks as $task)
                                <li class="ml-10">{{ $task->text }}</li>
                            @endforeach
                        </ul>
                        <button data-list-id="{{ $list->id }}" class="modal-open-0 bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full">TAAK TOEVOEGEN</button>
                    </div>
                @endforeach
                <button class="modal-open-1 border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline">LIJST TOEVOEGEN</button>

                <x-modal id="0" title="Taak toevoegen">
                    <form id="task_form" method="POST" action="{{ route('add_task') }}">
                        @csrf

                        <input id="list_id" type="hidden" name="list_id" value="">

                        <label for="task">Inhoud: </label>
                        <input id="task" type="text" name="task" required autofocus>
                    </form>
                </x-modal>

                <x-modal id="1" title="Lijst toevoegen">
                    <form id="list_form" method="POST" action="{{ route('add_list') }}">
                        @csrf

                        <label for="list">Naam: </label>
                        <input id="list" type="text" name="list" required autofocus>
                    </form>
                </x-modal>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="{{ asset('js/dashboard.js') }}" defer></script>
