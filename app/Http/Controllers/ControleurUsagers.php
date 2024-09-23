<?php

namespace App\Http\Controllers;
use App\Models\usagers;
use Illuminate\Http\Request;


class ControleurUsagers extends Controller
{
    public function index()
    {	$usagers = usagers::orderBy('nom','desc')->paginate(5);
        return view('usagers.index', compact('usagers'));
    }
    
    public function create()
    {	return view('usagers.create');
    }
    
    public function store(Request $request)
    {	$request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            'identifiant' => 'required',
            'passe' => 'required',
            'blocage' => 'required',
        ]);
        
        usagers::create($request->post());

        return redirect()->route('usagers.index')->with('success','Compte usager crÃ©e.');
    }
    
    public function show(usagers $usager)
    {	return view('usagers.show',compact('usager'));
    }

    public function edit(usagers $usager)
    {	return view('usagers.edit',compact('usager'));
    }
    
    public function update(Request $request, usagers $usager)
    {	$request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            'identifiant' => 'required',
            'passe' => 'required',
            'blocage' => 'required',
        ]);
        
        $usager->fill($request->post())->save();

        return redirect()->route('usagers.index')->with('success','Compte usager sauvegardÃ©');
    }
    
    public function destroy(usagers $usager)
    {	$usager->delete();
        return redirect()->route('usagers.index')->with('success','Compte usager supprimÃ©.');
    }

    
}