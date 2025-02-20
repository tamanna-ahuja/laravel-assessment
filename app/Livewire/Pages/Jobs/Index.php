<?php

namespace App\Livewire\Pages\Jobs;

use App\Models\Job;
use Livewire\Component;
use Storage;

use function Laravel\Prompts\confirm;

class Index extends Component
{
    public array $jobs = [];

    public function mount()
    {
      $this->jobs = Job::with('skills')->get()->map(function ($job) {
            return [
                "id" => $job->id,
                "title" => $job->title,
                "description" => $job->description,
                "company_name" => $job->company_name,
             "company_logo" => $job->logo ? Storage::url($job->logo) : null,
                "experience" => $job->experience,
                "salary" => $job->salary,
                "location" => $job->location,
                "skills" => $job->skills->pluck('name')->toArray(), 
                 "extra" => $job->extra_info ? explode(',', $job->extra_info) : [],
            ];
        })->toArray();
    }


    public function deleteJob($jobId)
    {
        Job::findOrFail($jobId)->delete();
        $this->jobs = Job::with('skills')->get()->map(function ($job) {
            return [
                "id" => $job->id,
                "title" => $job->title,
                "description" => $job->description,
                "company_name" => $job->company_name,
             "company_logo" => $job->logo ? Storage::url($job->logo) : null,
                "experience" => $job->experience,
                "salary" => $job->salary,
                "location" => $job->location,
                "skills" => $job->skills->pluck('name')->toArray(), 
                "extra" => $job->extra_info ? explode(',', $job->extra_info) : [],
            ];
        })->toArray();
    }
    public function render()
    {
        return view('livewire.pages.jobs.index');
    }


}