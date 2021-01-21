<x-app-layout>
    <x-slot name="header">
        <h2 class="py-6 font-semibold text-2xl text-white  leading-tight font-bold font-serif underline-red-400">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="font-serif">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach($lists as $list)
                    <div class="p-6 bg-white border-b border-black">
                        <div class="relative p-5">
                            <strong class="text-xl text-gray-800 tracking-wide uppercase">{{ $list->name }}</strong>
                            <button data-list-id="{{ $list->id }}" class="modal-open-3 absolute right-10">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="black" width="30px" height="30px">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </button>
                            <button data-list-id="{{ $list->id }}" class="modal-open-5 absolute right-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="black" width="30px" height="30px">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                        <hr class="border-red-400 border-1"/>
                        <ul class="list-disc">
                            @foreach($list->Tasks as $task)
                                <li class="ml-10 relative mt-5">
                                    <span>{{ $task->text }}</span> 
                                    <span data-task-id="{{ $task->id }}" class="{{ ($task->status == 'actief') ? 'text-blue-600' : 'text-green-600' }} hover:underline-red-400 status text-black font-bold absolute left-20" width="10px" height="10px">
                                        {{ $task->status }}
                                    </span>
                                    <button data-task-id="{{ $task->id }}" class="modal-open-2 absolute right-11">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="black" width="22px" height="22px">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <button data-task-id="{{ $task->id }}" class="modal-open-4 absolute right-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="black" width="22px" height="22px">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                        <button data-list-id="{{ $list->id }}" class="modal-open-0 border border-red-400 text-red-400 font-bold rounded-md px-6 py-2 m-7 transition duration-500 ease select-none focus:outline-none focus:shadow-outline">TAAK TOEVOEGEN</button>
                    </div>
                @endforeach
                <div class="p-6 bg-white">
                    <button class="modal-open-1 border border-red-400 text-red-400 font-bold rounded-md px-6 py-2 m-7 transition duration-500 ease select-none focus:outline-none focus:shadow-outline">LIJST TOEVOEGEN</button>
                </div>
                

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

                <x-modal id="2" title="Bewerk taak">
                    <form method="POST" action="{{ route('edit_task') }}">
                        @csrf
                        <input id="task_id" type="hidden" name="task_id" value="" required>

                        <label for="edittask">Inhoud: </label>
                        <input id="edittask" type="text" name="task" autofocus>
                    </form>
                </x-modal>

                <x-modal id="3" title="Bewerk lijst">
                    <form method="POST" action="{{ route('edit_list') }}">
                        @csrf
                        <input id="editlist_id" type="hidden" name="list_id" value="" required>

                        <label for="editlist">Naam: </label>
                        <input id="editlist" type="text" name="list" autofocus>
                    </form>
                </x-modal>

                <x-modal id="4" title="Verwijder taak">
                    <form method="POST" action="{{ route('delete_task') }}">
                        @csrf
                        <h1>WEET U HET ZEKER?</h1>
                        <input id="deletetask_id" type="hidden" name="task_id" value="">
                    </form>
                </x-modal>

                <x-modal id="5" title="Verwijder lijst">
                    <form method="POST" action="{{ route('delete_list') }}">
                        @csrf
                        <h1>WEET U HET ZEKER?</h1>
                        <input id="deletelist_id" type="hidden" name="list_id" value="">
                    </form>
                </x-modal>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="{{ asset('js/dashboard.js') }}" defer></script>
