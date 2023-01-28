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
 * @property string $ip
 * @property string $description
 * @property string $version
 * @property boolean $is_online
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @method static Server find(int $id)
 */
class Server extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip', 'port', 'icon', 'description', 'version', 'is_online', 'online_record_players', 'max_players'
    ];

    /**
     * @return HasMany
     */
    public function stats(): HasMany
    {
        return $this->hasMany(ServerStats::class);
    }

}
