<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kapal',
        'logo_kapal'
    ];

    public function Departure(){
        return $this->hasMany(Departure::class);
    }
    public function Arrival(){
        return $this->hasMany(Arrival::class);
    }
}
