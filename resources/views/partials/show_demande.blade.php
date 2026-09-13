@include('include.header')

<div class="container-fluid">

    <!-- Titre -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-calendar-check text-pr"></i>
            Rendez-vous
        </h1>
    </div>

    <!-- Card -->
    <div class="card shadow-lg border-0 rounded-4">

        <!-- Header -->
        <div class="card-header bg-gradient-primary-custom text-white text-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-info-circle"></i>
                Informations du patient
            </h5>
        </div>

        <!-- Body -->
        <div class="card-body">

            <div class="row g-4">

                <!-- Patient -->
                <div class="col-md-6">
                    <div class="border rounded-3 p-3 bg-light">

                        <small class="text-muted d-block">
                            Nom du patient
                        </small>

                        <h5 class="mb-0 text-dark">
                            <i class="fas fa-user "></i>
                            {{ $demande->patient->nom ?? 'Non défini' }}
                        </h5>

                    </div>
                </div>

                <!-- Téléphone -->
                <div class="col-md-6">
                    <div class="border rounded-3 p-3 bg-light">

                        <small class="text-muted d-block">
                            Téléphone
                        </small>

                        <h5 class="mb-0 text-dark">
                            <i class="fas fa-phone "></i>
                            {{ $demande->patient->telephone ?? 'Non défini' }}
                        </h5>

                    </div>
                </div>

                <!-- Service -->
                <div class="col-md-6">
                    <div class="border rounded-3 p-3 bg-light">

                        <small class="text-muted d-block">
                            Service demandé
                        </small>

                        <h5 class="mb-0 text-dark">
                            <i class="fas fa-hospital "></i>
                            {{ $demande->service->type_service ?? 'Aucun service' }}
                        </h5>

                    </div>
                </div>

                <!-- Date -->
                <div class="col-md-6">
                    <div class="border rounded-3 p-3 bg-light">

                        <small class="text-muted d-block">
                            Date du rendez-vous
                        </small>

                        <h5 class="mb-0 text-dark">
                            <i class="fas fa-calendar-alt "></i>
                            {{($demande->date) }}
                        </h5>

                    </div>
                </div>

                <!-- Symptôme -->
                <div class="col-12">

                    <div class="border rounded-3 p-4 bg-light">

                        <small class="text-muted d-block mb-2">
                            Symptôme / Description
                        </small>

                        <p class="mb-0 fs-5 text-dark">
                            {{ $demande->contenu ?? 'Aucune description' }}
                        </p>

                    </div>

                </div>
                <div class="col-4">

                    <div class="border rounded-1 p-2 bg-light">

                        <small class="text-muted d-block mb-2">
                            Status
                        </small>

                        <p class="mb-1 fs-5 text-dark ">
                            {{ $demande->status }}
                        </p>

                    </div>
                    <!-- Les Services: Pédiatrie, maternité, Echographie, etc... -->
                     <!-- Les Motifs: Vaccination, consultation, hospitalisation etc... -->

                </div>
                <div class="col-4">

                    <div class="border rounded-1 p-2 bg-light">

                        <small class="text-muted d-block mb-2">
                            Motif
                        </small>

                        <p class="mb-1 fs-5 text-dark ">
                            {{ $demande->motif }}
                        </p>

                    </div>
                    <!-- Les Services: Pédiatrie, maternité, Echographie, etc... -->
                     <!-- Les Motifs: Vaccination, consultation, hospitalisation etc... -->

                </div>

            </div>

        </div>

        <!-- Footer -->
        <div class="card-footer bg-white text-end">

           
            <a href="{{ route('demande.valide', $demande->id) }}"
               class="btn btn-success rounded-3">

                <i class="fas fa-check-circle"></i>
               Valider

            </a>
            <a href="{{ route('demande.rejete', $demande->id) }}"
               class="btn btn-outline-danger rounded-3">

                <i class="fas fa-ban"></i>
               Rejeter

            </a>

             <a href="/liste_demande"
               class="btn btn-outline-secondary rounded-3">

                <i class="fas fa-times"></i>
                Fermer

            </a>

        </div>

    </div>

</div>

@include('include.footer')