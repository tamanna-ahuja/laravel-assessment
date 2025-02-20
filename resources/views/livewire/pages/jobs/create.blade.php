<div class="container mx-auto py-4">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">Create new job posting</h1>
    </div>

    <div class="grid grid-cols-3 gap-6">
        <!-- Job Details Form -->
        <div class="col-span-2 bg-white p-6 shadow rounded">
            <h2 class="text-xl font-semibold mb-4">Post a Job</h2>

            @if(session()->has('message'))
            <div class="mb-3 text-green-600">
                {{ session('message') }}
            </div>
            @endif

            <form wire:submit.prevent="save">
                <div class="mb-4">
                    <label class="block text-sm font-medium">Title</label>
                    <input type="text" wire:model="title" placeholder="Job Posting Title"
                        class="w-full p-2 border rounded focus:outline-none focus:ring">
                    @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Description</label>
                    <textarea wire:model="description" placeholder="Job Posting Description"
                        class="w-full p-2 border rounded focus:outline-none focus:ring"></textarea>
                    @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Experience</label>
                        <input type="text" wire:model="experience" placeholder="Eg. 1-3 Yrs"
                            class="w-full p-2 border rounded focus:outline-none focus:ring">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Salary</label>
                        <input type="text" wire:model="salary" placeholder="Eg. 2.75-5 Lacs PA"
                            class="w-full p-2 border rounded focus:outline-none focus:ring">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Location</label>
                        <input type="text" wire:model="location" placeholder="Eg. Remote / Pune"
                            class="w-full p-2 border rounded focus:outline-none focus:ring">
                        @error('location') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Extra Info</label>
                        <input type="text" wire:model="extra_info"
                            placeholder="Eg. Full Time, Urgent/ Part Time, Flexible"
                            class="w-full p-2 border rounded focus:outline-none focus:ring">
                        <span>Please Use Comma Seperated Values</span>
                    </div>
                </div> <!-- Save Button -->
                <button type="submit"
                    class="w-full px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none">
                    Save
                </button>
            </form>
        </div>

        <!-- Right Sidebar (Company & Skills) -->
        <div class="space-y-6">
            <!-- Company Details -->
            <div class="bg-white p-6 shadow rounded">
                <h2 class="text-xl font-semibold mb-4">Company Details</h2>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Company Name</label>
                    <input type="text" wire:model="company_name" placeholder="Company Name"
                        class="w-full p-2 border rounded focus:outline-none focus:ring">
                    @error('company_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Company Logo</label>
                    <input type="file" wire:model="logo" class="w-full p-2 border rounded">
                    @if ($logo)
                    <img src="{{ $logo->temporaryUrl() }}" class="mt-2 w-32">
                    @endif
                    @error('logo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Skills Multi-Select -->
            <div class="bg-white p-6 shadow rounded">
                <h2 class="text-xl font-semibold mb-4">Required Skills</h2>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Select Skills</label>
                    <select multiple wire:model="selectedSkills"
                        class="w-full p-2 border rounded focus:outline-none focus:ring">
                        @foreach ($skills as $skill)
                        <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                        @endforeach
                    </select>
                    @error('selectedSkills') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>
</div>