<?php

namespace App\Http\Controllers;

use App\Models\Approvisionnement;
use App\Models\Client;
use App\Models\Article;
use App\Models\Depense;
use App\Models\Vente;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;

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

        return view('dashboard')->with('viewData',$viewData);
        
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

        $viewData['ventes'] = Vente::orderBy('created_at', 'ASC')->with('article')->get();

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

