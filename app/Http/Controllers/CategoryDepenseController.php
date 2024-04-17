<?php

namespace App\Http\Controllers;

use App\Models\CategoryDepense;
use App\Models\CategoryDepenseDepense;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseIsRedirected;

class CategoryDepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResponseIsRedirected | View
    {
        //Show all Solar Year

        $viewData = [];

        $viewData['title'] = 'Liste des catégories dépense ';

        $viewData['categories'] = CategoryDepense::orderBy('id', 'DESC')->get();

        return view('categories-depenses.index')->with('viewData', $viewData);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {

        $viewData = [];

        $viewData['title'] = 'Ajouter une catégorie dépense';

        return view('categories-depenses.create')->with('viewData', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse 
    {

        $request->validate([

            'name' =>[
			'required',
			'unique:category_depenses,nom',
        ],
		
        ],[

            'name.required' => 'Compléter le champ nom de la catégorie',
            'name.unique' => 'Cette catégorie de dépense existe déjà',

        ]);

        $categoryDepense = new CategoryDepense();

        $categoryDepense->nom = $request->name;

        $categoryDepense->save();

        return redirect()->back()->with('success','Catégorie ajoutée avec succès');

    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryDepense $categoryDepense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryDepense $categoryDepense): RedirectResponse | View
    {
        //Show Edit Scolar Year With Row Data

        $viewData = [];

        $viewData['title'] = $categoryDepense->personne;

        return view('categories-depenses.update', compact('categoryDepense'))->with('viewData', $viewData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoryDepense $categoryDepense): RedirectResponse
    {

        $request->validate([

            'name' =>[
			'required',
			'unique:category_depenses,nom',
			
			],
        ],[

            'name.required' => 'Compléter le champ nom de la catégorie',
			'name.required' => 'Cette catégorie de dépense existe déjà',

        ]);

        $categoryDepense->nom = $request->name;

        $categoryDepense->save();

        return redirect()->back()->with('success', 'Mise à jour effectuée avec succès !');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryDepense $categoryDepense)
    {
        $categoryDepense->delete();

        return redirect()->back()->with('success', 'Suppression effectuée avec succès !');
    }
}