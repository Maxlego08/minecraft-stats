<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Server
 * @package App\Models
 * @property int $id
 * @property int $port
 * @property int $max_players
 * @property int $online_record_players
 * @property string $name
 * @property string $ip
 * @property string $description
 * @property string $icon
 * @property string $version
 * @property boolean $is_online
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $online_record_players_at
 *
 * @method static Server find(int $id)
 */
class Server extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip', 'port', 'icon', 'description', 'version', 'is_online', 'online_record_players', 'max_players', 'name', 'online_record_players_at'
    ];

    protected $dates = [
        'online_record_players_at',
        'created_at',
        'updated_at',
    ];

    /**
     * @return HasMany
     */
    public function stats(): HasMany
    {
        return $this->hasMany(ServerStats::class);
    }

    /**
     * Get server icon
     *
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon == null ? asset("storage/icons/default.png") : asset("storage/icons/$this->icon");
    }

    public function currentOnline()
    {
        if (!$this->is_online) return 0;
        $stats = $this->stats()->orderBy('created_at', 'desc')->first();
        return $stats->online ?? 0;
    }

    /**
     * Get cache key
     *
     * @param int $days
     * @return string
     */
    function getCacheKey(int $days): string
    {
        return "{$this->id}_days_$days";
    }

}
