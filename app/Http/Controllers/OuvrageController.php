<?php

namespace App\Http\Controllers;

use App\Models\Ouvrage;
use Illuminate\Http\Request;

class OuvrageController extends Controller
{
    public function index()
    {
        $ouvrages = Ouvrage::all();
        return view('ouvrages.index', compact('ouvrages'));
    }

    public function create()
    {
        return view('ouvrages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'editeur' => 'required|string|max:255',
            'pages' => 'nullable|integer',
            'date_publication' => 'nullable|date',
            'isbn' => 'nullable|string|max:13',
           'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        Ouvrage::create($validated);

        return redirect()->route('ouvrages.index')->with('success', 'Ouvrage créé avec succès.');
    }

    public function edit(Ouvrage $ouvrage)
    {
        return view('ouvrages.edit', compact('ouvrage'));
    }

    public function update(Request $request, Ouvrage $ouvrage)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'editeur' => 'required|string|max:255',
            'pages' => 'nullable|integer',
            'date_publication' => 'nullable|date',
            'isbn' => 'nullable|string|max:13',
           'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        $ouvrage->update($validated);

        return redirect()->route('ouvrages.index')->with('success', 'Ouvrage mis à jour avec succès.');
    }

    public function destroy(Ouvrage $ouvrage)
    {
        $ouvrage->delete();
        return redirect()->route('ouvrages.index')->with('success', 'Ouvrage supprimé avec succès.');
    }
}
