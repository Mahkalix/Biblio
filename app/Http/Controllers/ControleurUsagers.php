<?php

namespace App\Http\Controllers;

use App\Models\Usagers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ControleurUsagers extends Controller
{
    // List all usagers, ordered by 'nom', paginated
    public function index()
    {
        $usagers = Usagers::orderBy('nom', 'desc')->paginate(5);
        return view('usagers.index', compact('usagers'));
    }

    // Show form to create a new usager
    public function create()
    {
        return view('usagers.create');
    }

    // Store the new usager in the database
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:usagers',
            'identifiant' => 'required|unique:usagers',
            'passe' => 'required|min:8', // Minimum 8 characters for password
            'blocage' => 'required|boolean',
        ]);

        // Create a new usager and hash the password
        Usagers::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'identifiant' => $request->identifiant,
            'passe' => Hash::make($request->passe), // Hash the password
            'blocage' => $request->blocage,
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('usagers.index')->with('success', 'Compte usager créé.');
    }

    // Show a specific usager
    public function show(Usagers $usager)
    {
        return view('usagers.show', compact('usager'));
    }

    // Show the form to edit an existing usager
    public function edit(Usagers $usager)
    {
        return view('usagers.edit', compact('usager'));
    }

    // Update an existing usager




    public function update(Request $request, Usagers $usager)
    {
        // Validation des données
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:usagers,email,' . $usager->id,
            'identifiant' => 'required|unique:usagers,identifiant,' . $usager->id,
            'passe' => 'nullable|min:8', // Le mot de passe est optionnel
            'blocage' => 'required|boolean',
        ]);

        // Mise à jour des champs
        $usager->nom = $validatedData['nom'];
        $usager->prenom = $validatedData['prenom'];
        $usager->email = $validatedData['email'];
        $usager->identifiant = $validatedData['identifiant'];

        // Si un mot de passe est fourni, on le hache et on le met à jour
        if (!empty($validatedData['passe'])) {
            $usager->passe = Hash::make($validatedData['passe']);
        }

        $usager->blocage = $validatedData['blocage'];

        // Sauvegarder les modifications
        $usager->save();

        // Rediriger avec un message de succès
        return redirect()->route('usagers.index')->with('success', 'Usager mis à jour avec succès.');
    }



    // Delete a usager
    public function destroy(Usagers $usager)
    {
        $usager->delete();
        return redirect()->route('usagers.index')->with('success', 'Compte usager supprimé.');
    }
}
