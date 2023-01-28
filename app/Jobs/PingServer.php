<?php

namespace App\Jobs;

use App\Models\Server;
use App\Models\ServerPlayer;
use App\Models\ServerStats;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use xPaw\MinecraftPing;

class PingServer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    private int $serverId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $serverId)
    {
        $this->serverId = $serverId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $server = Server::find($this->serverId);
        $online = 0;
        $isOnline = false;
        $max = 0;

        try {
            $ping = new MinecraftPing($server->ip, $server->port, 1);
            $status = $ping->Query();
            $ping->Close();

            $online = $status['players']['online'] ?? 0;
            $max = $status['players']['max'] ?? 0;
            $isOnline = true;
        } catch (Exception $ignored) {
        }

        ServerStats::create([
            'server_id' => $server->id,
            'online' => $online,
        ]);

        $server->update([
            'is_online' => $isOnline,
            'max_players' => max($max, $server->max_players),
            'online_record_players' => max($online, $server->online_record_players),
        ]);
    }

}
