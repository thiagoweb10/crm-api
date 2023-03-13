<?php

namespace App\Observers;

use App\Models\Demand;
use App\Notifications\DemandCreatedNotification;
use App\Notifications\DemandUpdatedNotification;

class DemandObserver
{
    /**
     * Handle the Demand "created" event.
     *
     * @param  \App\Models\Demand  $demand
     * @return void
     */
    public function created(Demand $demand)
    {
        $demand = ($demand->createdBy->id == auth()->user()->id) ? $demand->createdBy : $demand->developerBy;

        $demand->notify(new DemandCreatedNotification($demand));
    }

    /**
     * Handle the Demand "updated" event.
     *
     * @param  \App\Models\Demand  $demand
     * @return void
     */
    public function updated(Demand $demand)
    {
        $demand = ($demand->createdBy->id == auth()->user()->id) ? $demand->createdBy : $demand->developerBy;

        $demand->notify(new DemandUpdatedNotification($demand));
    }

    /**
     * Handle the Demand "deleted" event.
     *
     * @param  \App\Models\Demand  $demand
     * @return void
     */
    public function deleted(Demand $demand)
    {
        //
    }

    /**
     * Handle the Demand "restored" event.
     *
     * @param  \App\Models\Demand  $demand
     * @return void
     */
    public function restored(Demand $demand)
    {
        //
    }

    /**
     * Handle the Demand "force deleted" event.
     *
     * @param  \App\Models\Demand  $demand
     * @return void
     */
    public function forceDeleted(Demand $demand)
    {
        //
    }
}
