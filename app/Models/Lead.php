<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Lead extends Model
{
    use Notifiable;
    protected $fillable = ['email'];

    public function maillogs(): HasMany
    {
        return $this->hasMany(MailLog::class, 'lead_id', 'id');
    }
}
