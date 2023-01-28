<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $server_id
 * @property int $online
 * @property int $max
 * @property bool $is_online
 * @property Server $server
 *
 * @method static ServerStats create(array $values)
 */
class ServerStats extends Model
{
    use HasFactory;

    protected $fillable = [
        'server_id',
        'online',
    ];

    /**
     *
     * @return BelongsTo
     */
    public function server(): BelongsTo
    {
        return $this->belongsTo(Server::class);
    }
}
