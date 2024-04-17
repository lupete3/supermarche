<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): RedirectResponse | View
    {
        //Show all Solar Year

        $viewData = [];

        $viewData['title'] = 'Liste des articles ';

        $viewData['articles'] = Article::with('category')->get();

        return view('articles.index')->with('viewData', $viewData);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //Show Register Scolar Year Form

        $viewData = [];

        $viewData['title'] = 'Ajouter un article';

        $viewData['categories'] = Category::orderBy('nom', 'ASC')->get();

        return view('articles.create')->with('viewData', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse 
    {

        $request->validate([

            'name' => [
			'required',
			'unique:articles,designation'
			 ],
            'prix' => 'required|numeric',
            'category_id' => 'required',

        ],[

            'name.required' => 'Compléter le champ designation',
			'name.unique' => 'Cet article existe déjà dans la base de données',
            'prix.required' => 'Compléter le champ prix',
            'prix.numeric' => 'Entrer un nombre ',
            'category_id.required' => 'Choisir une catégorie de l\'article'

        ]);

        $article = new Article();

        $article->designation = $request->name;

        $article->prix = $request->prix;

        $article->category_id = $request->category_id;

        $article->save();

        return redirect()->back()->with('success','article ajouté avec succès');

    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article): RedirectResponse | View
    {

        $viewData = [];

        $viewData['title'] = $article->designation;

        $viewData['categories'] = Category::orderBy('nom', 'ASC')->get();

        return view('articles.update', compact('article'))->with('viewData', $viewData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article): RedirectResponse
    {

        $request->validate([

            'name' => [
			'required',
                Rule::unique('articles','designation')->ignore($article->id),
			 ],
            'prix' => 'required|numeric',
            'category_id' => 'required',

        ],[

            'name.required' => 'Compléter le champ designation',
            'prix.required' => 'Compléter le champ prix',
            'prix.numeric' => 'Entrer un nombre ',
            'category_id.required' => 'Choisir une catégorie de boisson'

        ]);

        $article->designation = $request->name;

        $article->prix = $request->prix;

        $article->category_id = $request->category_id;

        $article->save();

        return redirect()->back()->with('success', 'Mise à jour effectuée avec succès !');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->back()->with('success', 'Suppression effectuée avec succès !');
    }
}
