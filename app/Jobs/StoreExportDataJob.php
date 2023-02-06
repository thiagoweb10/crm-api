<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Export;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class StoreExportDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        protected $user,
        protected String $filename
    )
    {}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       ($this->user)->exports()->create([
            'file_name' => $this->filename,
            'status_id' => 1
        ]);
    }
}
