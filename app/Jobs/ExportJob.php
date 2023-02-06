<?php

namespace App\Jobs;

use App\Models\User;
use App\Exports\DataExport;
use Illuminate\Bus\Queueable;
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
        protected Array $data,
        protected DemandService $service = new DemandService
    )
    {}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $oDemands = $this->service->getData($this->data, true);

        Excel::store(new DataExport($oDemands->toArray())
            ,'report/export/'.$this->filename
            ,'public'
        );

        $userExport = $this->user->exports->where('file_name', $this->filename)->first();
        $userExport->update(['status_id' => 2 ]);

        $this->user->notify(new ReportCreatedNotification($this->user, $this->filename));
    }
}