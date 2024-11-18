<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ouvrage extends Model
{


    protected $fillable = ['titre', 'auteur', 'editeur', 'pages', 'date_publication', 'isbn', 'image'];
    use HasFactory;
}
