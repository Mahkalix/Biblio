<?php

namespace App\Http\Controllers;

use App\Models\Exemplaire;
use App\Models\Ouvrage;
use Illuminate\Http\Request;

class ExemplaireController extends Controller
{
    public function index($ouvrageId)
    {
        $ouvrage = Ouvrage::findOrFail($ouvrageId);
        $exemplaires = Exemplaire::where('ouvrage_id', $ouvrageId)->get();

        return view('exemplaires.index', compact('ouvrage', 'exemplaires'));
    }

    public function create($ouvrageId)
    {
        $ouvrage = Ouvrage::findOrFail($ouvrageId);
        $etats = config('constantes.ouvrages_etats');
        return view('exemplaires.create', compact('ouvrage', 'etats'));
    }

    public function store(Request $request, $ouvrageId)
    {
        // Validate the form input
        $validatedData = $request->validate([
            'etat' => 'required',
            'date' => 'required|date',
            'ouvrage_id' => '|exists:ouvrages,id',
        ]);

        $exemplaire = new Exemplaire();
        $exemplaire->ouvrage_id = $ouvrageId;
        $exemplaire->etat = $validatedData['etat'];
        $exemplaire->date = $validatedData['date'];
        $exemplaire->save();

        return redirect()->route('ouvrages.exemplaires.index', ['ouvrage' => $ouvrageId])
            ->with('status', 'Exemplaire ajouté avec succès!');
    }


    public function show($ouvrageId, Exemplaire $exemplaire)
    {
        return view('exemplaires.show', compact('exemplaire', 'ouvrageId'));
    }

    public function edit($ouvrageId, Exemplaire $exemplaire)
    {
        $ouvrage = Ouvrage::findOrFail($ouvrageId);
        $etats = config('constantes.ouvrages_etats');

        return view('exemplaires.edit', compact('exemplaire', 'ouvrage', 'etats'));
    }

    public function update(Request $request, $ouvrageId, Exemplaire $exemplaire)
    {
        $request->validate([
            'etat' => 'required',
            'disponible' => 'boolean',
            'date_retour_souhaitee' => 'nullable|date',
        ]);

        $exemplaire->update($request->all());

        return redirect()->route('ouvrages.exemplaires.index', $ouvrageId)
            ->with('success', 'Exemplaire mis à jour avec succès.');
    }

    public function destroy($ouvrageId, Exemplaire $exemplaire)
    {
        $exemplaire->delete();

        return redirect()->route('ouvrages.exemplaires.index', $ouvrageId)
            ->with('success', 'Exemplaire supprimé avec succès.');
    }


    public function toggleVisibility(Ouvrage $ouvrage, Exemplaire $exemplaire)
    {
        // Basculer la visibilité
        $exemplaire->visible = !$exemplaire->visible;
        $exemplaire->save();

        // Rediriger vers la liste des exemplaires
        return redirect()->route('ouvrages.exemplaires.index', $ouvrage->id);
    }
}
