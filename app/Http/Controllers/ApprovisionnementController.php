<?php

namespace App\Http\Controllers;

use App\Models\Approvisionnement;
use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ApprovisionnementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): RedirectResponse | View
    {
        //Show all Solar Year

        $viewData = [];

        $viewData['title'] = 'Liste des approvisionnements ';

        $viewData['approvisionnements'] = Approvisionnement::with('article')->get();

        return view('approvisionnements.index')->with('viewData', $viewData);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //Show Register Scolar Year Form

        $viewData = [];

        $viewData['title'] = 'Ajouter un approvisionnement';

        $viewData['articles'] = Article::orderBy('designation', 'ASC')->get();

        return view('approvisionnements.create')->with('viewData', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse 
    {

        $request->validate([

            'quantite' => 'required|numeric',
            'prix_achat' => 'required|numeric',
            'article_id' => 'required',

        ],[

            'quantite.required' => 'Compléter le champ quantité',
            'quantite.numeric' => 'Entrer un nombre ',
            'prix_achat.required' => 'Compléter le champ prix',
            'prix_achat.numeric' => 'Entrer un nombre ',
            'article_id.required' => 'Choisir un médicament à approvisionner'

        ]);

        //Mise a jour de la quantite produit
        $article = Article::find($request->article_id);

        $solde = $article->solde;

        $article->solde = $solde + $request->quantite;

        $article->save();


        //Sauvegarder les donnees liees a l'approvisionnement
        $approvisionnement = new Approvisionnement();

        $approvisionnement->quantite = $request->quantite;

        $approvisionnement->prix = $request->prix_achat;

        $approvisionnement->prix_total = $request->prix_achat * $request->quantite;

        $approvisionnement->article_id = $request->article_id;

        $approvisionnement->save();

        return redirect()->back()->with('success','Approvisionnement ajouté avec succès');

    }

    /**
     * Display the specified resource.
     */
    public function show(Approvisionnement $approvisionnement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Approvisionnement $approvisionnement): RedirectResponse | View
    {
        //Show Edit Scolar Year With Row Data

        $viewData = [];

        $viewData['title'] = 'Détail Approvisionnement';

        $viewData['articles'] = Article::orderBy('designation', 'ASC')->get();

        return view('approvisionnements.update', compact('approvisionnement'))->with('viewData', $viewData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Approvisionnement $approvisionnement): RedirectResponse
    {

        $request->validate([

            'quantite' => 'required|numeric',
            'prix_achat' => 'required|numeric',
            'article_id' => 'required',

        ],[

            'quantite.required' => 'Compléter le champ quantité',
            'quantite.numeric' => 'Entrer un nombre ',
            'prix_achat.required' => 'Compléter le champ prix',
            'prix_achat.numeric' => 'Entrer un nombre ',
            'article_id.required' => 'Choisir un médicament à approvisionner'

        ]);


        //Mise a jour de la quantite produit
        $article = Article::find($approvisionnement->article_id);

        $solde = $article->solde;

        $article->solde = $solde - $approvisionnement->quantite;

        $article->save();

        $article = Article::find($request->article_id);

        $solde = $article->solde;

        $article->solde = $solde + $request->quantite;

        $article->save();


        //Mise a jour du mouvement approvisionnement
        $approvisionnement->quantite = $request->quantite;

        $approvisionnement->prix = $request->prix_achat;

        $approvisionnement->prix_total = $request->prix_achat * $request->quantite;

        $approvisionnement->article_id = $request->article_id;

        $approvisionnement->save();

        return redirect()->back()->with('success', 'Mise à jour effectuée avec succès !');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Approvisionnement $approvisionnement)
    {
        //Mise a jour de la quantite produit
        $article = Article::find($approvisionnement->article_id);

        $solde = $article->solde;

        $article->solde = $solde - $approvisionnement->quantite;

        $article->save();

        $approvisionnement->delete();

        return redirect()->back()->with('success', 'Suppression effectuée avec succès !');
    }
}