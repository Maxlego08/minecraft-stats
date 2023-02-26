<?php

namespace App\Http\Controllers;

use App\Charts\Charts;
use App\Models\Server;
use App\Models\ServerStats;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
     * Compare page
     *
     * @return Factory|View|Application
     */
    public function compare(): Factory|View|Application
    {
        $servers = Server::all();
        $online = 0;
        foreach ($servers as $server) {
            $online += $server->currentOnline();
        }
        return view('compare', [
            'online' => $online,
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
        return self::calcCharts($server, $days, false);
    }

    /**
     * Get global stats
     *
     * @param Server $server
     * @return array
     */
    public function globalStats(Server $server): array
    {
        $servers = Server::all();
        $stats = [];
        foreach ($servers as $server) {
            $stats[] = [
                'name' => $server->name,
                'data' => $this->stats($server, 7),
            ];
        }
        return $stats;
    }

    /**
     * Allows you to calculate tanks, or to use the cache
     *
     * @param Server $server
     * @param int $days
     * @param bool $forceCalc
     * @return array
     */
    public static function calcCharts(Server $server, int $days, bool $forceCalc): array
    {

        if (!in_array($days, self::DAYS)) {
            $days = 2;
        }

        $minutes = self::DAYS_MINUTES[$days];

        $key = $server->getCacheKey($days);
        if (!$forceCalc && Cache::has($key)) {
            return Cache::get($key);
        }

        $values = [];
        $date = now()->subDays($days)->startOfHour();

        // $data = ServerStats::where('server_id', $server->id)->whereBetween('created_at', [$date, now()])->get();

        while ($date->isPast()) {

            $startAt = $date->clone();
            $endAt = $date->clone()->addMinutes($minutes);

            // $currentValues = $data->whereBetween('created_at', [$startAt, $endAt])->avg('online');
            $currentValues = ServerStats::where('server_id', $server->id)->whereBetween('created_at', [$startAt, $endAt])->avg('online');
            $values[] = [
                $startAt->timestamp * 1000, (int)$currentValues
            ];

            $date = $date->addMinutes($minutes);
        }
        Cache::put($key, $values, now()->addMinutes(10));
        return $values;

    }

}
