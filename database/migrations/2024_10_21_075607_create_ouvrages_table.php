<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOuvragesTable extends Migration
{
    public function up()
    {
        Schema::create('ouvrages', function (Blueprint $table) {
            $table->id(); // Identifiant unique pour chaque ouvrage
            $table->string('titre'); // Titre de l'ouvrage
            $table->string('auteur'); // Auteur de l'ouvrage
            $table->string('editeur'); // Éditeur de l'ouvrage
            $table->smallInteger('pages')->nullable(); // Nombre de pages, optionnel
            $table->date('date_publication')->nullable(); // Date de publication, optionnel
            $table->string('isbn')->nullable(); // ISBN, optionnel
            $table->string('image')->nullable(); // Chemin de l'image de couverture, optionnel
            $table->timestamps(); // Champs created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('ouvrages');
    }
}

