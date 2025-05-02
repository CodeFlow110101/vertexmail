<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Campaign extends Model
{
    protected $fillable = ['name', 'template', 'subject', 'attachment_id'];

    public function attachment(): BelongsTo
    {
        return $this->belongsTo(Attachment::class, 'attachment_id', 'id');
    }
}
