<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TelegramSession extends Model
{
    public $fillable = ['name', 'created_at', 'updated_at'];
    protected $table = 'telegram_sessions';
}
