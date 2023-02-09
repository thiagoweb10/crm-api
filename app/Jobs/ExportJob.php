<?php

namespace App\Jobs;

use App\Models\User;
use App\Exports\DataExport;
use Illuminate\Bus\Queueable;
use App\Exports\ExportProcess;
use App\Exports\SystemExportMethod;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\Demand\DemandService;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Notifications\ReportCreatedNotification;


class ExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        protected User $user,
        protected String $filename,
        protected Object $oDataReport,
    )
    {}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $oDataExport = (new ExportProcess($this->oDataReport))->export();

        Excel::store(new DataExport($oDataExport->toArray())
            ,'report/export/'.$this->filename
            ,'public'
        );

        $userExport = $this->user->exports->where('file_name', $this->filename)->first();
        $userExport->update(['status_id' => 2 ]);

        $this->user->notify(new ReportCreatedNotification($this->user, $this->filename));
    }
}