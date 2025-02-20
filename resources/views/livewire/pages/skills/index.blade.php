<div>
    <div class="container mx-auto py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Skills</h1>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <!-- Skills List -->
            <div class="w-full col-span-2">
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">Name</th>
                                    <th scope="col" class="px-4 py-3 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($skills as $skill)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3">{{ $skill->name }}</td>
                                    <td class="px-4 py-3 flex items-center justify-end space-x-2">
                                        <button wire:click="edit({{ $skill->id }})"
                                            class="text-sm px-3 py-1.5 rounded hover:bg-slate-100 transition-colors text-blue-500">
                                            Edit
                                        </button>
                                        <button wire:click="delete({{ $skill->id }})"
                                            class="text-sm px-3 py-1.5 rounded hover:bg-slate-100 transition-colors text-red-500">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="px-4 py-3 text-center text-gray-500">No skills added yet.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Add / Edit Skill Form -->
            <div
                class="w-full max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <h1 class="py-3 font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $editId ? 'Edit Skill' : 'Add new Skill' }}
                </h1>

                @if(session()->has('message'))
                <div class="mb-3 text-sm text-green-600">
                    {{ session('message') }}
                </div>
                @endif

                <form wire:submit.prevent="save">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-900 text-xs mb-2" for="skill">
                                Name
                            </label>
                            <input wire:model="name"
                                class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-2 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="skill" type="text" placeholder="Skill Name">
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex space-x-2">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            {{ $editId ? 'Update' : 'Save' }}
                        </button>

                        @if($editId)
                        <button type="button" wire:click="cancelEdit"
                            class="text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
                            Cancel
                        </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>