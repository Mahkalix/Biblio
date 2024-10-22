<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exemplaire extends Model
{
    use HasFactory;

    protected $fillable = ['ouvrage_id', 'etat', 'disponible', 'date_retour_souhaitee'];


    public function ouvrage()
    {
        return $this->belongsTo(Ouvrage::class, 'ouvrage_id');
    }
}
