<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::latest()->with(['employer', 'tags'])->get()->groupBy('featured');

        return view('jobs.index', [
            'jobs' => $jobs[1],
            'featuredJobs' => $jobs[0],
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        Log::debug('[D] Starting job creation');

        $attributes = request()->validate([
            'title' => ['required', 'string'],
            'salary' => ['required', 'string'],
            'location' => ['required', 'string'],
            'schedule' => ['required', 'string', Rule::in(['Full Time', 'Part Time', 'Contract'])],
            'url' => ['required', 'active_url'],
            'tags' => ['nullable', 'string'],
        ]);

        Log::debug('[D] Job creation validation passed');

        $attributes['featured'] = request()->has('featured');

        Log::debug('[D] Job creation featured: ' . $attributes['featured']);

        $job = Auth::user()->employer->jobs()->create(Arr::except($attributes, ['tags']));

        Log::debug('[D] Job created');

        if ($attributes['tags']) {
            foreach (explode(',', $attributes['tags']) as $tag) {
                $job->tag($tag);
            }
        }

        Log::debug('[D] Job tags added');
        Log::debug('[D] Redirecting to home');

        return redirect('/');
    }
}
