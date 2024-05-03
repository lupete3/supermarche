<?php

namespace App\Http\Controllers;

use App\Imports\ArticlessImport;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Stmt\TryCatch;

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
             'prix_achat' => 'required|numeric',
             'prix' => 'required|numeric',
             'category_id' => 'required',

        ],[

            'name.required' => 'Compléter le champ designation',
			'name.unique' => 'Cet article existe déjà dans la base de données',
            'prix_achat.required' => 'Compléter le champ prix d\'achat',
            'prix_achat.numeric' => 'Entrer un nombre pour le prid d\'achat ',
            'prix.required' => 'Compléter le champ prix',
            'prix.numeric' => 'Entrer un nombre pour le prix de vente',
            'category_id.required' => 'Choisir une catégorie de l\'article'

        ]);

        $article = new Article();

        $article->designation = $request->name;

        $article->prix_achat = $request->prix_achat;

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

    public function importArticles(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:xlsx,xlsm,xltx',
        ],[
            'file.required' => 'Choisir un fichier excel avant de continuer',
            'file.mimes' => 'Le fichier doit être un fichier excel',
        ]);
 
        // Get the uploaded file
        $file = $request->file('file');
 
        // Process the Excel file
        $erray = Excel::toArray(new ArticlessImport, $file->store('files'));

        Storage::delete('files');

        try {
            foreach ($erray[0] as $key => $value) {
                $prix_achat = $value[2] / 116 * 100;
                Article::create([
                    'designation' => $value[0],
                    'prix_achat' => $prix_achat,
                    'prix' => $value[2],
                    'solde' => $value[3],
                    'category_id' => $value[4],
                ]);
            }
    
        } catch (\Throwable $th) {
            return Redirect::back()->with(['success' => 'Données importéés avec succès' ]);
        }

        
        

        // if ($request->hasFile('file')) {

        //     $file = $request->file('file');
        
        //     // Stocker temporairement le fichier
        //     $filePath = $file->storeAs('imports', $file->getClientOriginalName());

        //     // Importer les données depuis le fichier stocké
        //     Excel::import(new ArticlessImport, $filePath);
            
        //     // Supprimer le fichier temporaire après importation
        //     Storage::delete($filePath);

        //     return redirect()->back()->with('success', 'Articles importés avec succès.');
        // } else {
        //     return redirect()->back()->with('error', 'Veuillez sélectionner un fichier.');
        // }
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
			'unique:articles,designation'
			 ],
             'prix_achat' => 'required|numeric',
             'prix' => 'required|numeric',
             'category_id' => 'required',

        ],[

            'name.required' => 'Compléter le champ designation',
			'name.unique' => 'Cet article existe déjà dans la base de données',
            'prix_achat.required' => 'Compléter le champ prix d\'achat',
            'prix_achat.numeric' => 'Entrer un nombre pour le prid d\'achat ',
            'prix.required' => 'Compléter le champ prix',
            'prix.numeric' => 'Entrer un nombre pour le prix de vente',
            'category_id.required' => 'Choisir une catégorie de l\'article'

        ]);

        $article->designation = $request->name;

        $article->prix_achat = $request->prix_achat;

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
