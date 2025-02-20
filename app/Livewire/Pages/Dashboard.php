<?php

namespace App\Livewire\Pages;
use Storage;
use App\Models\Job;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
                $jobs = Job::with('skills')->latest()->take(10)->get()->map(function ($job) {
            return [
                'id' => $job->id,
                'title' => $job->title,
                'description' => $job->description,
                'company_name' => $job->company_name,
                "company_logo" => $job->logo ? Storage::url($job->logo) : null,
                'experience' => $job->experience,
                'salary' => $job->salary,
                'location' => $job->location,
                 "skills" => $job->skills->pluck('name')->toArray(), 
                "extra" => $job->extra_info ? explode(',', $job->extra_info) : [],
                'posted_at' => $job->created_at->diffForHumans(),
            ];
        });

        return view('livewire.pages.dashboard',compact('jobs'));
    }
}