<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
   public function index(): Response
    {
        $jobs = Job::with('skills')->latest()->take(10)->get()->map(function ($job) {
            return [
                'id' => $job->id,
                'title' => $job->title,
                'description' => $job->description,
                'company_name' => $job->company_name,
                'company_logo' => $job->logo ? asset('storage/' . $job->logo) : null,
                'experience' => $job->experience,
                'salary' => $job->salary,
                'location' => $job->location,
                'skills' => $job->skills->pluck('name')->toArray(),
                'extra' => explode(',', $job->extra_info),
                'posted_at' => $job->created_at->diffForHumans(),
            ];
        });

        return Inertia::render('Dashboard', [
            'jobs' => $jobs
        ]);
    }
}