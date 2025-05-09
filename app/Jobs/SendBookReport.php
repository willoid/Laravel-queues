<?php

namespace App\Jobs;

use App\Models\Book;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Log;

class SendBookReport implements ShouldQueue
{
    use Queueable, SerializesModels, Dispatchable, InteractsWithQueue;

    protected $email;
    protected $bookId;

    //number of times the job may be attempted
    public $tries = 3;
    //time in seconds before the job is retried
    public $timeout = 60;

    /**
     * Create a new job instance.
     */
    public function __construct($email,$bookId)
    {
        $this->email = $email;
        $this->bookId = $bookId;
        $this->queue = 'reports';
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //get book from database
        $book = Book::findOrFail($this->bookId);
        //simulate processing time
        sleep(3);
        //generate PDF
        $pdf = PDF::loadView('reports.book', ['book' => $book]);
        //send email
        Mail::raw("Here is your book report {$book->title}", function ($message) use ($pdf, $book) {
            $message->to($this->email)
                    ->subject("{$book->name}'s Book Report")
                    ->attachData($pdf->output(), 'book_report.pdf');
        });
    }
    /**
     * The job failed to process.
     */
    public function failed(\Throwable $exception){
        Log::error("Job {$this->bookId} failed with exception: {$exception->getMessage()}");
    }
}
