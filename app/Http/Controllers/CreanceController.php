<?php

namespace App\Http\Controllers;

use App\Models\Creance;
use App\Models\Paiement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $viewData = [];

        $viewData['title'] = 'Liste des dettes ';

        $viewData['creances'] = Creance::with('client')->get();

        return view('creances.index')->with('viewData', $viewData);
    }

    /**
     * Display a listing of the resource.
     */
    public function indexPaiement()
    {
        //
        $viewData = [];

        $viewData['title'] = 'Liste des paiements ';

        $viewData['paiements'] = Paiement::with('creance','client')->get();

        return view('creances.indexPaiement')->with('viewData', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Creance $creance)
    {
        //
        $request->validate([

            'montant' => 'required|numeric'

        ],[

            'montant.required' => 'Complétez le montant payé',
            'montant.numeric' => 'Le montanr doit être un nombre',

        ]);

        Paiement::create([
            'montant' => $request->montant,
            'reste' => $creance->solde - $request->montant,
            'creance_id' => $creance->id,
            'client_id' => $creance->client_id
        ]);

        $creance->update([
            'solde' => $creance->solde - $request->montant,
        ]);

        return redirect()->back()->with('success','Paiement ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Creance $creance)
    {
        // 
        $viewData = [];

        $viewData['title'] = 'Paiement dette ';

        return view('creances.create', compact('creance'))->with('viewData', $viewData);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Creance $creance, Paiement $paiement)
    {
        // 
        $viewData = [];

        $viewData['title'] = 'Modification paiement ';

        return view('creances.update', compact('paiement'))->with('viewData', $viewData);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paiement $paiement)
    {
        //
        $request->validate([

            'montant' => 'required|numeric'

        ],[

            'montant.required' => 'Complétez le montant payé',
            'montant.numeric' => 'Le montanr doit être un nombre',

        ]);

        $creance = Creance::find($paiement->creance_id)->first();

        $montantAvant = $paiement->montant;

        $creance->update([
            'solde' => $creance->solde + $montantAvant
        ]);

        $paiement->update([
            'montant' => $request->montant,
            'reste' => $creance->solde - $request->montant
        ]);

        $creance->update([
            'solde' => $creance->solde - $request->montant
        ]);

        return redirect()->back()->with('success','Mise à jour effectuée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paiement $paiement)
    {
        //
        if (Auth::user()->role == 'admin') {

            $creance = Creance::find($paiement->creance_id)->first();

            $montantAvant = $paiement->montant;

            $creance->update([
                'solde' => $creance->solde + $montantAvant
            ]);

            $paiement->delete();

            return redirect()->back()->with('success','Suppression effectuée avec succès');
       
        }
    }
}
