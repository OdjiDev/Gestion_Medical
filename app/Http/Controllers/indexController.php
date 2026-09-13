<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;
use App\Models\Fournisseur;
use App\Models\Medicament;
use App\Models\Achat;
use App\Models\Reception;
use App\Models\service_medicale;
use App\Models\vente_m;
use Carbon\Carbon;

class indexController extends Controller
{
    //
    public function index()
    {
        $medicaments = Medicament::all();
        $alertes = Medicament::whereColumn('quantite', '<=', 'quantite_alerte')->count();
        $labels = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];

        /* INIT 12 MOIS À 0 */
        $receptions = array_fill(0, 12, 0);
        $ventes = array_fill(0, 12, 0);
        $achats = array_fill(0, 12, 0);

        /* RÉCEPTIONS */
        $dataReceptions = Reception::selectRaw('MONTH(created_at) as mois, COUNT(*) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('mois')
            ->get();

        foreach ($dataReceptions as $row) {
            $receptions[$row->mois - 1] = $row->total;
        }

        /* VENTES */
        $dataVentes = vente_m::selectRaw('MONTH(created_at) as mois, COUNT(*) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('mois')
            ->get();

        foreach ($dataVentes as $row) {
            $ventes[$row->mois - 1] = $row->total;
        }

        /* ACHATS */
        $dataAchats = Achat::selectRaw('MONTH(created_at) as mois, COUNT(*) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('mois')
            ->get();

        foreach ($dataAchats as $row) {
            $achats[$row->mois - 1] = $row->total;
        }

        return view('partials.index', compact(
            'labels',
            'receptions',
            'ventes',
            'achats',
            'alertes',
            'medicaments',

        ), [

            'usersCount' => User::count(),
            'medicamentCount' => Medicament::count(),
            'achatCount' => Achat::count(),
            'venteCount' => vente_m::count(),
            'receptionCount' => Reception::count(),
            'serviceCount' => service_medicale::count(),

        ]);
    }
}
