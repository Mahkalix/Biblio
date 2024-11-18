<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Ouvrage;
use App\Models\Usagers;


class ControleurRecherche extends Controller
{
    public function index()
    {
        // Récupérer les valeurs de recherche depuis la session
        $rechercheUsagers = Session::get('recherche_usagers', '');
        $rechercheOuvrages = Session::get('recherche_ouvrages', '');

        return view('bibliotheque.recherche', compact('rechercheUsagers', 'rechercheOuvrages'));
    }

    public function rechercherUsager(Request $request)
    {
        // Valider la requête pour s'assurer que le champ query est bien rempli
        $request->validate([
            'query' => 'required|string|min:3'
        ]);

        // Récupérer le terme de recherche depuis la requête
        $query = $request->input('query');

        // Stocker la recherche dans la session
        Session::put('recherche_usagers', $query);

        // Effectuer une recherche dans les champs 'nom', 'prenom' et 'email'
        $usagers = Usagers::where('nom', 'like', '%' . $query . '%')
            ->orWhere('prenom', 'like', '%' . $query . '%')
            ->orWhere('email', 'like', '%' . $query . '%')
            ->get();

        // Retourner les résultats au format JSON
        return response()->json($usagers);
    }

    public function rechercherOuvrage(Request $request)
    {
        // Valider la requête
        $request->validate([
            'query' => 'required|string|min:3'
        ]);

        // Récupérer le terme de recherche depuis la requête
        $query = $request->input('query');

        // Stocker la recherche dans la session
        Session::put('recherche_ouvrages', $query);

        // Effectuer la recherche dans la table 'ouvrages' avec Eloquent
        $ouvrages = Ouvrage::where('titre', 'like', '%' . $query . '%')
            ->orWhere('auteur', 'like', '%' . $query . '%')
            ->get();

        // Retourner les résultats sous forme de JSON
        return response()->json($ouvrages);
    }
}
