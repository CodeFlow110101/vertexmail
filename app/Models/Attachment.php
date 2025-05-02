<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attachment extends Model
{
    protected $fillable = ['name', 'path'];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class, 'attachment_id', 'id');
    }
}
