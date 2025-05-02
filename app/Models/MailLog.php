<?php

namespace App\Models;

use App\Events\MailCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MailLog extends Model
{
    protected $table = "maillogs";
    protected $fillable = ['campaign_id', 'lead_id', 'is_seen'];

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class, 'lead_id', 'id');
    }

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class, 'campaign_id', 'id');
    }

    protected $dispatchesEvents = [
        'created' => MailCreated::class,
    ];
}
