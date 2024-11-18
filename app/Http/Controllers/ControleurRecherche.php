<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ouvrage;
use App\Models\Usagers;


class ControleurRecherche extends Controller
{
    public function index()
    {
        return view('bibliotheque.recherche');
    }

    public function rechercher(Request $request)
    {
        // Valider la requête
        $request->validate([
            'query' => 'required|string|min:3'
        ]);

        // Récupérer le terme de recherche depuis la requête
        $query = $request->input('query');

        // Effectuer la recherche dans la table 'ouvrages' avec Eloquent
        $ouvrages = Ouvrage::where('titre', 'like', '%' . $query . '%')
            ->orWhere('auteur', 'like', '%' . $query . '%')
            ->get();

        // Retourner les résultats sous forme de JSON
        return response()->json($ouvrages);
    }

    public function rechercherUsager(Request $request)
    {
        // Valider la requête pour s'assurer que le champ query est bien rempli
        $request->validate([
            'query' => 'required|string|min:3'
        ]);

        // Récupérer le terme de recherche depuis la requête
        $query = $request->input('query');

        // Effectuer une recherche dans les champs 'nom', 'prenom' et 'email'
        $usagers = Usagers::where('nom', 'like', '%' . $query . '%')
            ->orWhere('prenom', 'like', '%' . $query . '%')
            ->orWhere('email', 'like', '%' . $query . '%')
            ->get();

        // Retourner les résultats au format JSON
        return response()->json($usagers);
    }
}
