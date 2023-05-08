<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'target_user_id',
    ];

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'tickets',
            'target_user_id',
            'user_id'
        );
    }
}
