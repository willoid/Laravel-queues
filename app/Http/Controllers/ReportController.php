<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendBookReport;

class ReportController extends Controller
{
    public function sendReport(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'book_id' => 'required|integer|exists:books,id',
        ]);

        // Dispatch the job to the queue
        SendBookReport::dispatch($request->email, $request->book_id);

        return response()->json(['message' => 'Report is being generated and will be sent to your email.']);
    }

    public function sendDelayedReport(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'book_id' => 'required|integer|exists:books,id',
            'minutes' => 'required|integer|min:1',
        ]);

        // Dispatch the job to the queue with a delay
        SendBookReport::dispatch($request->email, $request->book_id)
            ->delay(now()->addMinutes($request->delay));

        return response()->json(['message' => "Report will be sent to your email after a delay of {$request->delay} minutes."]);
    }
}
