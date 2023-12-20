<?php

use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\TypeLogementController;
use App\Http\Controllers\ProprietaireController;
use App\Http\Controllers\AuthManagerController;
use App\Http\Controllers\CreateAccountController;
use App\Http\Controllers\CreateAnnonceController;
use App\Http\Controllers\RechercheController;
use App\Http\Controllers\AffichageCompteController;
use App\Http\Controllers\ModificationCompteController;
use App\Http\Controllers\LoginParticulierController;
use App\Http\Controllers\LoginEntrepriseController;
use App\Http\Controllers\DeconnexionCompteController;
use App\Http\Controllers\LogoutCompteController;
use App\Http\Controllers\RegistrationEntrepriseController;
use App\Http\Controllers\RegistrationParticulierController;
use App\Http\Controllers\ModifierPhotoProfilController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//PAGE ACCUEILLE
Route::get('/', [VilleController::class, "getVilles"])->name("home");
Route::post('/sedeconnecter', [LogoutCompteController::class, "logout"])->name("home.logout");

//AFFICHAGE COMPTE
Route::post('/monCompte', [AffichageCompteController::class, "showCount"])->name("monCompte");

//MODIFICATION COMPTE PARTICULIER ET ENTREPRISE
Route::get('/monCompte/modifierCompte', [ModificationCompteController::class, "modifierCompte"])->name("modifierCompte");
Route::post('/monCompte/supprimerCompte', [ModificationCompteController::class, "supprimerCompte"])->name("supprimerCompte");
Route::post('/modificationCompte', [ModificationCompteController::class, "modifierComptePost"])->name("modifierCompte.post");
Route::post('/modificationAdresseCompte', [ModificationCompteController::class, "modifierAdresseComptePost"])->name("modifierAdresseCompte.post");

//CONEXION COMPTE PARTICULIER
Route::get('/loginParticulier', [LoginParticulierController::class, "loginParticulier"])->name("loginParticulier");
Route::post('/loginParticulierPost', [LoginParticulierController::class, "loginParticulierPost"])->name("loginParticulier.post");

//CONNEXION COMPTE ENTREPRISE
Route::get('/loginEntreprise', [LoginEntrepriseController::class, "loginEntreprise"])->name("loginEntreprise");
Route::post('/loginEntreprisePost', [LoginEntrepriseController::class, "loginEntreprisePost"])->name("loginEntreprise.post");

//CHOIX TYPE DE COMPTE A CREER
Route::get('/create-account', [CreateAccountController::class, "showCreateAccount"]);

//CREATION COMPTE PARTICULIER
Route::get('/create-account/registrationParticulier', [RegistrationParticulierController::class, "registrationParticulier"])->name("registrationParticulier");
Route::post('/create-account/registrationParticulierPost', [RegistrationParticulierController::class, "registrationParticulierPost"])->name("registrationParticulier.post");

//CREATION COMPTE ENTREPRISE
Route::get('/create-account/registrationEntreprise', [RegistrationEntrepriseController::class, "registrationEntreprise"])->name("registrationEntreprise");
Route::post('/create-account/registrationEntreprisePost', [RegistrationEntrepriseController::class, "registrationEntreprisePost"])->name("registrationEntreprise.post");

//CREATION TYPE LOGEMENT
Route::get('/create-typelogement', [TypeLogementController::class, "showCreateTypeLogement"])->name("typelogement");
Route::post('/create-typelogement/registration', [TypeLogementController::class, "registrationPost"])->name("typelogement.post");
Route::post('/update-typelogement/{id}', [TypeLogementController::class, "updateTypelogement"]);

//CREATION RECHERCHE
Route::post('/create-recherche/registration', [RechercheController::class, "registrationPost"])->name("recheche.post");

//AFFICHAGE RECHERCHE 
Route::post('/annonces', [AnnonceController::class, "showAnnonces"])->name("annonces");

//AFFICHAGE ANNONCE SELECTIONNEE
Route::get('/annonce/{id}', [AnnonceController::class, "showAnnonce"]);

//AFFICHAGE INFORMATIONS PROPRIETAIRE
Route::get('/proprietaire/{id}', [ProprietaireController::class, "showProprietaire"]);

//CREATION ANNONCE
Route::get('/create-annonce', [CreateAnnonceController::class, "create"])->name('create-annonce');
Route::post('/create-annonce/save', [CreateAnnonceController::class, "save"])->name('create-annonce.save');

Route::post('/modifierPhoto', [ModifierPhotoProfilController::class, "modifierPhoto"]);
