<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function index()
    { 
        $jobs = Job::where('payload', 'LIKE', 'CommentPosted')
                ->orWhere('payload', 'LIKE', 'ComposerMessagedEmail')
                ->paginate(20);
        
        return view(
            'account.jobs',
            compact(
                'jobs'
            )
        );
    }
    
    public function delete(Job $job)
    {
        $job->delete();
        
        return redirect('/jobs');
    }
}