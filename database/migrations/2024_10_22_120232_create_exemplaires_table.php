<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExemplairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exemplaires', function (Blueprint $table) {
            $table->id();

            // Liens vers les ouvrages et les usagers (relation de clé étrangère)
            $table->bigInteger('ouvrage')->unsigned();
            $table->foreign('ouvrage')->references('id')->on('ouvrages')->onDelete('cascade');

            $table->bigInteger('usager')->unsigned()->nullable(); // Null si pas encore emprunté
            $table->foreign('usager')->references('id')->on('usagers')->onDelete('set null');

            // État de l'exemplaire : numérique et avec correspondance textuelle
            $table->enum('etat', ['neuf', 'bon', 'à réparer', 'à remplacer', 'retiré'])->default('neuf');

            // Information de disponibilité (emprunt ou non)
            $table->boolean('disponible')->default(true);

            // Date de retour si l'ouvrage est emprunté
            $table->date('date_retour_souhaitee')->nullable();

            // Marqueur indiquant si l'ouvrage est réservé
            $table->boolean('reserve')->default(false);

            // Marqueur indiquant si l'ouvrage a été renouvelé
            $table->boolean('renouvele')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exemplaires');
    }
}
