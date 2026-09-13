<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //patient
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('email');
            $table->string('password');
            $table->string('sexe');
            $table->string('adress');
            $table->string('telephone');
            $table->string('n_dossier')->unique();
            $table->timestamps();
        });
        //rendez vous
        Schema::create('rendez_vous', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('objectif');
            $table->string('contenu');
            $table->timestamps();
        });
        //liste demande
        // Schema::create('demande', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
        //     $table->string('motifs');
        //     $table->string('contenu');
        // });


        //service medicale
        Schema::create('service_medicales', function (Blueprint $table) {
            $table->id();
            $table->string('type_service');
            $table->integer('tarif');
            $table->timestamps();
        });


        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->enum('motif', ['consultation', 'Vaccination', 'hospitalisation', 'autre']);
            $table->date('date');
            $table->foreignId('service_id')->constrained('service_medicales')->onDelete('cascade');
            $table->text('contenu')->nullable();
            $table->string('status')->default('en_attente');
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });


        //accueil
        Schema::create('receptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('service_medicales')->onDelete('cascade');
            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone')->nullable();
            $table->boolean('amo');
            $table->string('status')->default('en_attente');
            $table->integer('tarif');
            $table->string('montantPayer');
            $table->string('montantAmo');
            $table->timestamps();
        });


        //examen_medicale
        Schema::create('examens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('service_medicales')->onDelete('cascade');
            $table->string('resultat');
            $table->date('date');
            $table->timestamps();
        });


        //paiement
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('accueil_id')->constrained('accueils')->onDelete('cascade');
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->integer('montant');
            $table->string('type_paiement');
            $table->date('date');
            $table->timestamps();

            //fournisseur
            Schema::create('fournisseurs', function (Blueprint $table) {
                $table->id();
                $table->string('nom');
                $table->string('adresse');
                $table->integer('telephone');
                $table->string('email')->nullable();
                $table->timestamps();
            });
            //pharmacie
            Schema::create('medicaments', function (Blueprint $table) {
                $table->id();
                $table->string('nom');
                $table->string('description');
                $table->integer('quantite');
                $table->integer('quantite_alerte');
                $table->integer('prix_vente');
                $table->integer('prix_achat');
                $table->decimal('amo');
                $table->date('date_expiration');
                $table->timestamps();
            });




            Schema::create('ventes', function (Blueprint $table) {
                $table->id();
                $table->integer('total');
                $table->integer('montant_payer');
                $table->string('montant_amo');
                $table->string('amo');
                $table->string('reference');
                $table->date('date');
                $table->timestamps();
            });

            Schema::create('vente_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('vente_id')->constrained('ventes')->onDelete('cascade');
                $table->foreignId('medicament_id')->constrained('medicaments')->onDelete('cascade');
                $table->integer('quantite');
                $table->integer('prix');
                $table->integer('montant');
             
                $table->timestamps();
            });

            Schema::create('achats', function (Blueprint $table) {
                $table->id();
                $table->foreignId('fournisseur_id')->constrained('fournisseurs')->onDelete('cascade');
                $table->integer('total');
          
                $table->string('reference');
                $table->date('date');
                $table->timestamps();
            });
            Schema::create('achat_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('achat_id')->constrained('achats')->onDelete('cascade');
                $table->foreignId('medicament_id')->constrained('medicaments')->onDelete('cascade');
                $table->integer('quantite');
                $table->integer('prix');
                $table->integer('montant');
                $table->timestamps();
            });

            Schema::create('parametres', function (Blueprint $table) {
                $table->id();
                $table->decimal('amo', 5, 2)->default(0.00);
                $table->timestamps();
            });

             Schema::create('documents_patients', function (Blueprint $table) {
    $table->id();

    $table->unsignedBigInteger('patient_id');
    $table->unsignedBigInteger('demande_id')->nullable(); // 🔥 AJOUT IMPORTANT

    $table->string('nom');
    $table->string('fichier');
    $table->dateTime('date_envoi')->nullable();

    $table->timestamps();

    $table->foreign('patient_id')
          ->references('id')
          ->on('patients')
          ->onDelete('cascade');

    $table->foreign('demande_id')
          ->references('id')
          ->on('demandes')
          ->onDelete('cascade');
});
    
        });
        //typs
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('stock');

        Schema::dropIfExists('documents_patients');
        Schema::dropIfExists('parametres');
        Schema::dropIfExists('achat_items');
        Schema::dropIfExists('achats');
        Schema::dropIfExists('vente_items');
        Schema::dropIfExists('vente');
        Schema::dropIfExists('fournisseur_medicament');
        Schema::dropIfExists('medicaments');
        Schema::dropIfExists('fournisseurs');
        Schema::dropIfExists('paiements');
        Schema::dropIfExists('examens');
        Schema::dropIfExists('reception');
        Schema::dropIfExists('service_medicales');
        Schema::dropIfExists('demandes');
        Schema::dropIfExists('rendez_vous');
        Schema::dropIfExists('patients');
    }
};
