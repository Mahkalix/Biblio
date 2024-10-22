<?php

namespace App\Http\Controllers;

use App\Models\Ouvrage;
use Illuminate\Http\Request;

class OuvrageController extends Controller
{
    public function index()
    {
        // Retrieve all 'Ouvrage' records
        $ouvrages = Ouvrage::all();
        return view('ouvrages.index', compact('ouvrages'));
    }

    public function create()
    {
        // Show the form to create a new 'Ouvrage'
        return view('ouvrages.create');
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'editeur' => 'required|string|max:255',
            'pages' => 'nullable|integer',
            'date_publication' => 'nullable|date',
            'isbn' => 'nullable|string|max:13',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        // Create a new 'Ouvrage' record
        $ouvrage = Ouvrage::create($validated);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $this->handleImageUpload($request, $ouvrage);
        }

        // Redirect to index with success message
        return redirect()->route('ouvrages.index')->with('success', 'Ouvrage créé avec succès.');
    }

    public function edit(Ouvrage $ouvrage)
    {
        // Show the form to edit an existing 'Ouvrage'
        return view('ouvrages.edit', compact('ouvrage'));
    }

    public function update(Request $request, Ouvrage $ouvrage)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'editeur' => 'required|string|max:255',
            'pages' => 'nullable|integer',
            'date_publication' => 'nullable|date',
            'isbn' => 'nullable|string|max:13',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        // Update the 'Ouvrage' record
        $ouvrage->update($validated);

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            $this->handleImageUpload($request, $ouvrage);
        }

        // Redirect to index with success message
        return redirect()->route('ouvrages.index')->with('success', 'Ouvrage mis à jour avec succès.');
    }

    public function destroy(Ouvrage $ouvrage)
    {
        // Delete the 'Ouvrage' record
        $ouvrage->delete();
        return redirect()->route('ouvrages.index')->with('success', 'Ouvrage supprimé avec succès.');
    }

    // Handle image upload for both store and update
    private function handleImageUpload(Request $request, Ouvrage $ouvrage)
    {
        $extension = $request->image->extension();
        $nomDeFichier = $ouvrage->id . '.' . $extension; // Use the Ouvrage ID for the filename
        $request->image->move(public_path('images'), $nomDeFichier); // Move the image to the public/images directory

        // Update the 'Ouvrage' record with the image name
        $ouvrage->update(['image' => $nomDeFichier]);
    }
}
