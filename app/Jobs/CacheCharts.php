<?php

namespace App\Jobs;

use App\Http\Controllers\ServerController;
use App\Models\Server;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CacheCharts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    private int $serverId;
    private string $days;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $serverId, string $days)
    {
        $this->serverId = $serverId;
        $this->days = $days;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $server = Server::find($this->serverId);
        if ($this->days === 'all') {
            ServerController::calcAll($server, true);
        } else {
            ServerController::calcCharts($server, $this->days, true);
        }
    }
}
