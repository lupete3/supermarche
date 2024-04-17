<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): RedirectResponse | View
    {
        //Show all Solar Year

        $viewData = [];

        $viewData['title'] = 'Liste des clients ';

        $viewData['clients'] = Client::orderBy('id', 'DESC')->get();

        return view('clients.index')->with('viewData', $viewData);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //Show Register Scolar Year Form

        $viewData = [];

        $viewData['title'] = 'Ajouter un client';

        return view('clients.create')->with('viewData', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse 
    {

        $request->validate([

            'nom' => 'required',

        ],[

            'nom.required' => 'Compléter le champ nom du client'

        ]);

        $client = new Client();

        $client->nom = $request->nom;
        $client->telephone = $request->telephone;
        $client->adresse = $request->adresse;

        $client->save();

        if(!empty($request->from)){
            return redirect()->route('ventes.create');
        }else{
            return redirect()->back()->with('success','Client ajouté avec succès');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client): RedirectResponse | View
    {
        //Show Edit Scolar Year With Row Data

        $viewData = [];

        $viewData['title'] = $client->nom;

        return view('clients.update', compact('client'))->with('viewData', $viewData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client): RedirectResponse
    {

        $request->validate([

            'nom' => 'required'

        ],[

            'nom.required' => 'Compléter le champ nom du client'

        ]);

        $client->nom = $request->nom;
        $client->telephone = $request->telephone;
        $client->adresse = $request->adresse;

        $client->save();

        return redirect()->back()->with('success', 'Mise à jour effectuée avec succès !');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->back()->with('success', 'Suppression effectuée avec succès !');
    }
}
