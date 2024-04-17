<?php

namespace App\Http\Controllers;

use App\Models\CategoryDepense;
use App\Models\Depense;
use Illuminate\Http\Request;

class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $viewData = [];

        $viewData['title'] = 'Liste des dépenses';

        $viewData['depenses'] = Depense::with('category')->get();

        return view('depenses.index')->with('viewData', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $viewData = [];

        $viewData['title'] = 'Ajouter des dépenses';

        $viewData['categoriesDepenses'] = CategoryDepense::orderBy('nom', 'ASC')->get();

        return view('depenses.create')->with('viewData', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $date = str_replace("T", " ", $request->date);

        $request->validate([

            'category_id' => 'required',
            'name' =>'required',
            'montant' => 'required',
            'date' => 'required',

        ],[

            'category_id.required' => 'Choissez une catégorie de dépense',
            'name.required' => 'Spécifiez la destination',
            'montant.required' => 'Complétez le montant de dépense',
            'date.required' => 'Compléter la date de dépense',

        ]);

        $depense = new Depense();

        $depense->montant = $request->montant;
        $depense->personne = $request->name;
        $depense->date_depense = $date;
        $depense->category_id = $request->category_id;

        $depense->save();

        return redirect()->back()->with('success','Dépense ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Depense $depense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Depense $depense)
    {
        $viewData = [];

        $viewData['title'] = 'Modifier une dépense';

        $viewData['categoriesDepenses'] = CategoryDepense::orderBy('nom', 'ASC')->get();

        return view('depenses.update', compact('depense'))->with('viewData', $viewData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Depense $depense)
    {
        $date = str_replace("T", " ", $request->date);

        $request->validate([

            'category_id' => 'required',
            'name' => 'required',
            'montant' => 'required',
            'date' => 'required',

        ],[

            'category_id.required' => 'Choissez une catégorie de dépense',
            'name.required' => 'Spécifiez la destination',
            'montant.required' => 'Complétez le montant de dépense',
            'date.required' => 'Compléter la date de dépense',

        ]);

        $depense->montant = $request->montant;
        $depense->personne = $request->name;
        $depense->date_depense = $date;
        $depense->category_id = $request->category_id;

        $depense->save();

        return redirect()->back()->with('success','Mise à jour effectuée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Depense $depense)
    {
        $depense->delete();

        return redirect()->back()->with('success', 'Suppression effectuée avec succès !');
    }
}
