<?php

namespace App\Livewire\Pages\Jobs;

use App\Models\Job;
use App\Models\Skill;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Create extends Component
{
        use WithFileUploads;

    public $title, $description, $experience, $salary, $location, $extra_info;
    public $company_name, $logo;
    public $selectedSkills = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'experience' => 'nullable|string|max:100',
        'salary' => 'nullable|string|max:100',
        'location' => 'required|string|max:255',
        'extra_info' => 'nullable|string',
        'company_name' => 'required|string|max:255',
        'logo' => 'nullable|image|max:1024', // 1MB max file size
        'selectedSkills' => 'array|min:1',
    ];

   public function save()
{
    $this->validate([
        'title' => 'required',
        'description' => 'required',
        'experience' => 'nullable',
        'salary' => 'nullable',
        'location' => 'required',
        'extra_info' => 'nullable',
        'company_name' => 'required',
        'selectedSkills' => 'array',
    ]);
$logoPath = null;
        if ($this->logo) {
            $logoPath = $this->logo->store('logos', 'public'); // Store in public storage
        }
    // Ensure Job is created before attaching skills
    $job = Job::create([
        'title' => $this->title,
        'description' => $this->description,
        'experience' => $this->experience,
        'salary' => $this->salary,
        'location' => $this->location,
        'extra_info' => $this->extra_info,
        'company_name' => $this->company_name,
        'logo' => $logoPath, 
    ]);

    if ($job) {
        // Attach skills AFTER job creation
        $job->skills()->sync($this->selectedSkills);
    } else {
        session()->flash('error', 'Job could not be created.');
        return;
    }

    session()->flash('message', 'Job posted successfully.');
}
    public function render()
    {
        return view('livewire.pages.jobs.create', [
            'skills' => Skill::all(),
        ]);
    }
}