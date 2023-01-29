<?php

namespace App\Http\Controllers;

use App\Charts\Charts;
use App\Models\Server;
use App\Models\ServerPlayer;
use App\Models\ServerStats;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServerController extends Controller
{
    const DAYS = [2, 7, 14, 30];
    const DAYS_MINUTES = array(
        2 => 10,
        7 => 10,
        14 => 20,
        30 => 30
    );

    /**
     * Show server information
     *
     * @param string $name
     * @param Server $server
     * @return Factory|View|Application
     */
    public function index(string $name, Server $server): Factory|View|Application
    {
        return view('server', [
            'server' => $server,
        ]);
    }

    /**
     * Display statistics on days
     *
     * @param Server $server
     * @param int $days
     * @return array
     */
    public function stats(Server $server, int $days): array
    {

        if (!in_array($days, self::DAYS)) {
            $days = 2;
        }

        $minutes = self::DAYS_MINUTES[$days];

        $values = [];
        $date = now()->subDays($days)->startOfDay();
        while ($date->isPast()) {

            $startAt = $date->clone();
            $endAt = $date->clone()->addMinutes($minutes);

            $currentValues = ServerStats::where('server_id', $server->id)->whereBetween('created_at', [$startAt, $endAt])->avg('online');
            $values[] = [
                $startAt->timestamp * 1000, (int)$currentValues
            ];

            $date = $date->addMinutes($minutes);
        }
        return $values;
    }

}
