<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $uuid
 * @property string $payload
 * @property User $user
 * @property Carbon $created_at
 * @property Channel $channel
 * @property Carbon $updated_at
 */
class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'payload'
    ];

    public function channel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
