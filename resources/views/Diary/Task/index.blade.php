<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('tasks.tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-3">#</th>
                            <th class="px-6 py-3">{{__('tasks.title')}}</th>
                            <th class="px-6 py-3">{{__('tasks.status')}}</th>
                            <th class="px-6 py-3">{{__('tasks.dueDate')}}</th>
                            <th class="px-6 py-3">{{__('tasks.statusChangeDate')}}</th>
                            <th class="px-6 py-3">{{__('tasks.createdDate')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">{{ $task->id }}</td>
                                    <td class="px-6 py-4">{{ $task->title }}</td>
                                    <td class="px-6 py-4">{{ __('tasks.statuses.' . $task->status->value ) }}</td>
                                    <td class="px-6 py-4">{{ $task->due_date }}</td>
                                    <td class="px-6 py-4">{{ $task->status_change_date ?? 'brak' }}</td>
                                    <td class="px-6 py-4">{{ $task->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $tasks->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
