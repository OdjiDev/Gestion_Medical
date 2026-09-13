<?php


use App\Http\Controllers\DemandeController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\Rendez_vousController;
use App\Http\Controllers\MedicamentController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\ReceptionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\vente_mController;
use App\Http\Controllers\vente_itemsController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\AchatController;
use App\Http\Controllers\Achat_itemsController;
use App\Http\Controllers\interface_pController;
use App\Http\Controllers\parametreController;
use App\Http\Controllers\PatientAuthController;
use App\Http\Controllers\resultatController;
use App\Http\Controllers\DocumentController;
use App\Models\Achat;
use Termwind\Components\Raw;

Route::get('/', function () {
    return redirect('login');
});

Route::middleware('auth')->group(function () {
    //users
    Route::get('/index', [IndexController::class, 'index']);
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/Ajout_user', [UserController::class, 'create'])->name('user.create');
    Route::get('/edit_user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::POST('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::put('/update/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/delete/{user}', [UserController::class, 'destroy'])->name('users.delete');
    Route::get('/profile/{user}', [UserController::class, 'show'])->name('users.show');
    Route::put('/users/{id}/avatar', [UserController::class, 'photo'])->name('users.avatar');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    //  

    //patient
    Route::get('/patient', [PatientController::class, 'index'])->name('patient.index');
    route::get('/ajout_patient', [PatientController::class, 'create'])->name('patient.create');
    Route::post('/patient/store', [PatientController::class, 'store'])->name('patient.store');
    Route::get('/edit_patient/{patient}/edit', [PatientController::class, 'edit'])->name('patient.edit');
    // Route::get('/interface_patient/{patient}/show',[PatientController::class,'show'])->name('patient.show');
    Route::put('/update_patient/{patient}', [PatientController::class, 'update'])->name('patient.update');
    Route::delete('/delete_patient/{patient}', [PatientController::class, 'destroy'])->name('patient.delete');


    //rendez_vous
    Route::get('/rendez_vous', [Rendez_vousController::class, 'index']);



    //demande
    Route::get('/liste_demande', [DemandeController::class, 'index'])->name('demande.index');
    Route::get('/demande', [DemandeController::class, 'create']);
    Route::post('/demande/store', [DemandeController::class, 'store'])->name('demande.store');
    Route::get('/demande/{demande}', [DemandeController::class, 'show'])->name('demande.show');
    Route::get('/demande/valide/{id}', [DemandeController::class, 'valide'])
        ->name('demande.valide');
    Route::get('/demande/rejete/{id}', [DemandeController::class, 'rejete'])
        ->name('demande.rejete');

    //paiement
    Route::get('/paiement', [PaiementController::class, 'index']);

    //medicament
    Route::get('/medicament', [MedicamentController::class, 'index'])->name('medicament.index');
    Route::get('/ajouter_m', [MedicamentController::class, 'create'])->name('m.create');
    Route::post('/medicament/store', [MedicamentController::class, 'store'])->name('medicaments.store');
    Route::get('/edit_m/{medicament}/edit', [MedicamentController::class, 'edit'])->name('medicaments.edit');
    Route::put('/update_m/{medicament}', [MedicamentController::class, 'update'])->name('medicament.update');
    Route::delete('/delete_m/{medicament}', [MedicamentController::class, 'destroy'])->name('medicament.delete');
    //Route::get('/stock_m',[MedicamentController::class,'show'])->name('medicament.shows');
    Route::get('/medicaments/search', [MedicamentController::class, 'search'])
        ->name('medicament.search');
    Route::post('/medicament/{medicament}/add-stock', [MedicamentController::class, 'addStock'])->name('medicament.addStock');




    //fournisseur
    Route::get('/fournisseur', [FournisseurController::class, 'index'])->name('fournisseur.index');
    Route::get('/ajout_fors', [FournisseurController::class, 'create'])->name('fournisseur.create');
    Route::post('/fournisseur/store', [FournisseurController::class, 'store'])->name('fournisseur.store');
    Route::get('/edit_fours/{fournisseur}/edit', [FournisseurController::class, 'edit'])->name('fournisseur.edit');
    Route::put('/update_fours/{fournisseur}', [FournisseurController::class, 'update'])->name('fournisseur.update');
    Route::delete('/delete_fours{fournisseur}', [FournisseurController::class, 'destroy'])->name('fournisseur.delete');


    //vente
    Route::get('/vente_m', [vente_mController::class, 'index'])->name('vente.index');
    Route::get('/ajout_vente', [vente_mController::class, 'create'])->name('vente.create');
    Route::post('/vente_items/store', [vente_itemsController::class, 'store'])->name('vente.store');
    Route::get('/show_v_item/{vente_items}', [vente_itemsController::class, 'show'])->name('vente.show');
    Route::get('/edit_items/{vente_items}/edit', [vente_itemsController::class, 'edit'])->name('vente.edit');
    Route::put('/update_items/{vente_items}', [vente_itemsController::class, 'update'])->name('vente.update');
    Route::delete('/delete_items/{vente_m}', [vente_mController::class, 'destroy'])->name('vente.delete');
    Route::get('/ticket_vent/{id}/show', [vente_mController::class, 'show'])->name('ticket.show');

    //achat
    // Route::get('/achat',[AchatController::class,'index'])->name('achat.index');
    // Route::get('/achat_items',[AchatController::class,'create'])->name('achat.create');
    // Route::get('/achat_items/store',[Achat_itemsController::class,'store'])->name('achat.store');
    Route::resource('achat', AchatController::class);
    Route::resource('achat_items', Achat_itemsController::class);


    //service medicale
    Route::get('/service_medicale', [ServiceController::class, 'index'])->name('service.index');
    Route::get('/ajout_service', [ServiceController::class, 'create'])->name('service.create');
    Route::post('/ajout_service/store', [ServiceController::class, 'store'])->name('service.store');
    Route::get('/edit_service/{service}/edit', [ServiceController::class, 'edit'])->name('service.edit');
    Route::put('/update_service/{service}', [ServiceController::class, 'update'])->name('service.update');
    Route::delete('/delete_service/{service}', [ServiceController::class, 'destroy'])->name('service.delete');
    Route::get('/medicaments/alertes', [MedicamentController::class, 'alertes'])->name('medicaments.alertes');

    //reception
    Route::get('/reception', [ReceptionController::class, 'index'])->name('reception.index');
    Route::get('/ajout_reception', [ReceptionController::class, 'create'])->name('reception.create');
    Route::post('/reception/store', [ReceptionController::class, 'store'])->name('reception.store');
    Route::get('/edit_reception/{reception}/edit', [ReceptionController::class, 'edit'])->name('reception.edit');
    Route::put('/update_reception/{reception}', [ReceptionController::class, 'update'])->name('reception.update');
    Route::delete('/delete_reception/{reception}', [ReceptionController::class, 'destroy'])->name('reception.delete');
    Route::get('/reception/valide/{id}', [ReceptionController::class, 'valide'])->name('reception.valide');


    //print
    Route::get('/ticket/{id}/print', [TicketController::class, 'show'])
        ->name('ticket.print');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    Route::post('/patient/{id}/send-pdf-space', [DocumentController::class, 'send'])->name('patient.send');

    Route::get('/parametre', [parametreController::class, 'index'])->name('parametre.index');
    Route::post('/parametre', [ParametreController::class, 'store'])
        ->name('parametre.store');
});




Route::prefix('patient')->group(function () {

    // Formulaire de connexion
    Route::get('/login', [PatientAuthController::class, 'showLogin'])
        ->name('patient.login');

    // Traitement connexion
    Route::post('/login', [PatientAuthController::class, 'login'])
        ->name('patient.login.submit');

    // Dashboard patient
    Route::middleware('auth:patient')->group(function () {

        Route::get('/interface', function () {
            return view('patient.interface');
        })->name('patient.interface');

        Route::post('/logout', [PatientAuthController::class, 'logout'])
            ->name('patient.logout');

        // interface patient
        Route::get('/interface', [interface_pController::class, 'index'])->name('interface.index');
        Route::get('/ajouter_demande', [interface_pController::class, 'create'])->name('demande.create');
        Route::post('/ajouter_demande/store', [interface_pController::class, 'store'])->name('demande_patient.store');
        Route::post('/ajouter_demande/store', [interface_pController::class, 'store'])->name('demande_patient.store');
        Route::get('/mes_demande/show', [interface_pController::class, 'show'])
            ->name('mes_demande.show');

        Route::get('/rdv/show', [Rendez_vousController::class, 'show'])->name('rdv.show');

        Route::get('/resultat', [resultatController::class, 'index'])->name('resultat.index');
    });
});








require __DIR__ . '/auth.php';
