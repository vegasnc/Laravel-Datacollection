<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Asset extends Authenticatable
{
    protected $connection ="mysql";

    protected $table ="asset";

    protected $fillable = [
        'name',
    ];

    
}
