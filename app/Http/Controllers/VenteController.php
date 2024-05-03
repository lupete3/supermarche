<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Client;
use App\Models\Commande;
use App\Models\Creance;
use App\Models\Vente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $viewData = [];

        $viewData['title'] = 'Historique des ventes';

        $viewData['ventes'] = Commande::latest()->with('ventes')->get();

        return view('ventes.index')->with('viewData', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $viewData = [];

        $viewData['title'] = 'Ajouter une vente';

        $viewData['articles'] = Article::orderBy('designation', 'ASC')->get();

        $viewData['categories'] = Category::orderBy('nom', 'ASC')->get();
        

        $viewData['clients'] = Client::orderBy('nom', 'ASC')->get();

        $viewData['clients_commandes'] = Client::with('commandes')->get();

        return view('ventes.create')->with('viewData', $viewData);
    }

    public function addToCart(Request $request)
    {
        // Récupérer l'ID du produit depuis la requête
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'quantite' => 'required|integer|min:1'
        ]);

        $productId = $request->article_id;

        // Rechercher le produit correspondant dans la base de données
        $product = Article::findOrFail($productId);

        // Récupérer le panier de la session ou créer un nouveau panier
        $cart = session()->get('cart', []);

        if ($product->solde < ($request->quantite + $request->bonus)) {

            return redirect()->route('ventes.create')->with('error','Cette quantité est est supérieur que le solde actuel');
        }

        // Vérifier si le produit est déjà dans le panier
        if (isset($cart[$product->id])) {
            // Augmenter la quantité si le produit est déjà dans le panier
            $cart[$product->id]['quantity'] += $request->quantite;

        } else {
            // Ajouter le produit au panier
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->designation,
                'price' => $product->prix,
                'quantity' => $request->quantite,
                'bonus' => $request->bonus
            ];
        }

        // Mettre à jour le panier dans la session
        session()->put('cart', $cart);

        return redirect()->route('ventes.create')->with('success', 'Produit ajouté au panier avec succès.');

    }

    /**
     * Retirer un article dans le panier
     * public function removeFromCart(Request $request)
    **/
    public function removeFromCart(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'article_id' => 'required|exists:articles,id',
        ]);

        // Récupérer le produit à partir de la base de données
        $productId = $request->article_id;

        // Récupérer le panier de la session
        $cart = Session::get('cart', []);

        // Vérifier si le produit est présent dans le panier
        if (isset($cart[$productId])) {
            // Supprimer le produit du panier
            unset($cart[$productId]);

            // Mettre à jour le panier dans la session
            Session::put('cart', $cart);

            return redirect()->back()->with('success', 'Le produit a été retiré du panier avec succès.');
        }

        return redirect()->back()->with('error', 'Le produit n\'est pas dans le panier.');
    }

    /**
     * Vider le pqnier
     */
    public function clearCart()
    {
        // Supprimer le panier de la session
        Session::forget('cart');

        return redirect()->route('ventes.create')->with('success', 'Le panier a été vidé avec succès.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function print(Client $client, Request $request)
    {
        $viewData = [];

        $viewData['title'] = $client->nom;

        $montant = $request->montant;

        $reduction = $request->reduction;

        $client = Client::findOrFail($request->client_id); 

        return view('ventes.facture',compact('client','montant','reduction'))->with('viewData', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function paiement(Client $client, Request $request)
    {
        $viewData = [];

        $commande = Commande::lastest();

        $viewData['ventes'] = Vente::select('id')->where('client_id', $client->id)->get();

        foreach($viewData['ventes'] as $vente){
                                        
           Vente::where('client_id', $client->id)->update(['status' => 1]);
        
        }

        return to_route('ventes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Client $client, Request $request)
    {

        // Récupérer les produits du panier depuis la session
        $cart = Session::get('cart');

        $commande = Commande::create([
            'montant' => $request->montant,
            'reduction' => $request->reduction,
            'client_id' => $client->id
        ]);

        // Calculer le montant total de la commande
        foreach ($cart as $productId => $item) {

            // Mettre à jour la quantité disponible dans la table "produit"
            $produit = Article::findOrFail($productId);
            
            $produit->solde -= ($item['quantity'] + $item['bonus']); // Soustraire la quantité achetée
            $produit->save();

            $vente = new Vente();

            $vente->libelle = $item['name'];

            $vente->quantite = $item['quantity'];

            if(empty($item['bonus'])) { $vente->bonus = 0; }else{ $vente->bonus = $item['bonus']; };

            $vente->prix_vente = $produit->prix;

            $vente->prix_tot = $produit->prix * $item['quantity'];

            $vente->commande_id = $commande->id;

            $vente->article_id = $productId;

            $vente->save();
            
        }

        $dette = $request->total - ($request->montant + $request->reduction);

        if ($dette > 0) {
            Creance::create([
                'montant' => $dette,
                'solde' => $dette,
                'client_id' => $client->id
            ]);
        }

        // Vider le panier après la finalisation de la commande
        Session::forget('cart');

        return to_route('ventes.create')->with('success','Vente effectuée avec succès'); 

    }

    /**
     * Display the specified resource.
     */
    public function show(Vente $vente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vente $vente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vente $vente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vente $vente)
    {
        //
    }
}
