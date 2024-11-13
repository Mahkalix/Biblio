<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Usagers;

class ControleurRecherche extends Controller
{
    public function index()
    {
        return view('bibliotheque.recherche');
    }

    public function rechercher(Request $request)
    {
        // Récupérer le terme de recherche depuis le formulaire
        $query = trim($request->input('query'));

        // Si le champ de recherche est vide, retourner une liste vide
        if (empty($query)) {
            return response()->json([]);
        }

        // Effectuer la recherche dans la table 'ouvrages'
        $ouvrages = DB::table('ouvrages')
            ->where('titre', 'like', '%' . $query . '%')
            ->orWhere('auteur', 'like', '%' . $query . '%')
            ->get();

        // Retourner les résultats sous forme de JSON
        return response()->json($ouvrages);
    }


    public function rechercherUsager(Request $request)
    {
        // Valider la requête pour s'assurer que le champ query est bien rempli
        $request->validate([
            'query' => 'required|string|min:2'
        ]);

        // Récupérer le terme de recherche depuis la requête
        $query = $request->input('query');

        // Effectuer une recherche dans les champs 'nom', 'prenom' et 'email'
        $usagers = usagers::where('nom', 'like', "%{$query}%")
            ->orWhere('prenom', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->get();

        // Retourner les résultats au format JSON
        return response()->json($usagers);
    }
}
