<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exemplaire extends Model
{
    use HasFactory;

    protected $fillable = ['etat', 'date', 'ouvrage_id'];

    public function ouvrage()
    {
        return $this->belongsTo(Ouvrage::class, 'ouvrage_id');
    }
}
