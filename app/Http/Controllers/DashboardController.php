<?php

namespace App\Http\Controllers;

use App\Models\Approvisionnement;
use App\Models\Client;
use App\Models\Article;
use App\Models\Commande;
use App\Models\Creance;
use App\Models\Depense;
use App\Models\Paiement;
use App\Models\User;
use App\Models\Vente;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    //Main DashboardController

    public function dashboard(): View
    {

        $viewData = [];

        $viewData['title'] = 'Tableau de bord';

        $viewData['clients'] = Client::all();

        $viewData['articles'] = Article::all();

        $viewData['approvisionnements'] = Approvisionnement::whereDate('created_at', Carbon::today())->sum('prix_total');
        
        $viewData['ventes'] = Vente::whereDate('created_at', Carbon::today())->sum('prix_tot');
        
        $viewData['depenses'] = Depense::whereDate('created_at', Carbon::today())->sum('montant');
        
        $viewData['dettes'] = Creance::whereDate('created_at', Carbon::today())->sum('montant');
        
        $viewData['paiements'] = Paiement::whereDate('created_at', Carbon::today())->sum('montant');

        return view('dashboard')->with('viewData',$viewData);
        
    }

    
    //Gestion des utilisateurs
    public function usersIndex(): View
    {

        $viewData['title'] = 'Liste des utilisateurs';

        $viewData['users'] = User::all();
        
        return view('users.index')->with('viewData',$viewData);
    }

    //Gestion des utilisateurs
    public function usersCreate(): View
    {

        $viewData['title'] = 'Ajouter un utilisateur';
        
        return view('users.create')->with('viewData',$viewData);
    }

    public function usersStore(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'role' => ['required'],
            'password' => ['required'],
        ],[

            'name.required' => 'Complétez le nom',
            'email.required' => 'Complétez email',
            'email.email' => "L'adresse mail n'est pas valide",
            'email.unique' => "Cette adresse mail est déjà utilisée",
            'role.required' => 'Choisir un rôle',
            'password.required' => 'Compléter le champ mot de passe',

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            
        ]);

        // Vérifier si c'est le premier utilisateur inscrit
        if (User::count() === 1) {
            $user->role = 'admin';
            $user->save();
        }

        return redirect()->back()->with('success','Utilisateur ajouté avec succès');
    }

    //Gestion des utilisateurs
    public function usersEdit(User $user): View
    {

        $viewData['title'] = $user->name;
        
        return view('users.edit', compact('user'))->with('viewData',$viewData);
    }

    public function usersUpdate(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'role' => ['required'],
        ],[

            'name.required' => 'Complétez le nom',
            'email.required' => 'Complétez email',
            'email.email' => "L'adresse mail n'est pas valide",
            'email.unique' => "Cette adresse mail est déjà utilisée",
            'role.required' => 'Choisir un rôle',

        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return redirect()->back()->with('success','Mise à jour effectuée avec succès');
    }


    public function usersDelete(User $user)
    {

        $user->delete();
        
        return redirect()->back()->with('success', 'Compte utilisateur supprimé');
    }

    //Rapport clients
    public function rapportClients()
    {
        $viewData = [];

        $viewData['title'] = 'Liste des clients';

        $viewData['clients'] = Client::orderBy('nom', 'ASC')->get();

        return view('rapports.fiche-clients')->with('viewData', $viewData);
    }

    //Synthese produits
    public function rapportProduitsStat()
    {
        $viewData = [];

        $viewData['title'] = 'Synthèse Produits';

        $articles = Article::orderBy('designation', 'ASC')->with('ventes')->get();

        $statistiques = [];

        foreach ($articles as $article) {
            $totVentes = $article->ventes->sum('quantite');

            $statistiques[] = [
                'designation' => $article->designation,
                'totVentes' => $totVentes,
                'solde' => $article->solde
            ];
        }

        return view('rapports.fiche-produits-stat', compact('statistiques'))->with('viewData', $viewData);
    }

    //Rapport stock
    public function rapportProduits()
    {
        $viewData = [];

        $viewData['title'] = 'Rapport de stock';

        $viewData['articles'] = Article::orderBy('designation', 'ASC')->with('category')->get();

        return view('rapports.fiche-produits')->with('viewData', $viewData);
    }

    //Rapport achats
    public function rapportAchats()
    {
        $viewData = [];

        $viewData['title'] = 'Rapport des achats';

        $viewData['approvisionnements'] = Approvisionnement::orderBy('created_at', 'ASC')->with('article')->get();

        return view('rapports.fiche-achats')->with('viewData', $viewData);
    }

    //Rapport ventes
    public function rapportVentes()
    {
        $viewData = [];

        $viewData['title'] = 'Rapport des ventes';

        $viewData['ventes'] = Commande::latest()->with('ventes')->get();

        return view('rapports.fiche-ventes')->with('viewData', $viewData);
    }

    //Rapport dépenses
    public function rapportDepenses()
    {
        $viewData = [];

        $viewData['title'] = 'Rapport des dépenses';

        $viewData['depenses'] = Depense::orderBy('created_at', 'ASC')->with('category')->get();

        return view('rapports.fiche-depenses')->with('viewData', $viewData);
    }
}

