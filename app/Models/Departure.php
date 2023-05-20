<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departure extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_ship',
        'schedule',
        'jam',
        'from',
        'destination',
        'status'

    ];
    public function Ship(){
        return $this->belongsTo(Ship::class, 'id_ship');
    }
}
