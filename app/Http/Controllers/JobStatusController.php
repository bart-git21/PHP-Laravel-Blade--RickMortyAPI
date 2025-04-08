<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobStatus;

class JobStatusController extends Controller
{
    public function check($job_id)
    {
        $jobStatus = JobStatus::where('job_id', $job_id)->first();
        return response()->json(['status' => $jobStatus ? $jobStatus->status : 'not found',]);
    }
}
