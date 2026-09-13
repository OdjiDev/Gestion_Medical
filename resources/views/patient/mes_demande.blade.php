@include('patient.header')

<div class="main-content">
    <div class="container-fluid py-4">

        <div class="row mb-4">
            <div class="col-12">
                <h3 class="fw-bold text-primary">
                    📋 Mes Demandes
                </h3>
            </div>
        </div>

        <div class="row g-3">

            @forelse($demandes as $demande)

                <div class="col-12 col-sm-6 col-lg-4">

                    <div class="card border-0 shadow-sm h-100">

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <h6 class="fw-bold mb-0">
                                    Demande #{{ $demande->id }}
                                </h6>

                                <span class="badge bg-primary">
                                    {{ $demande->status }}
                                </span>

                            </div>

                            <hr>

                            <p class="mb-2">
                                <strong>👤 Nom :</strong>
                                {{ $demande->patient->nom }}
                            </p>

                            <p class="mb-2">
                                <strong>📄 Type :</strong>
                                {{ $demande->motif }}
                            </p>

                            <p class="text-muted small mb-0">
                                🕒 {{ $demande->created_at->format('d/m/Y H:i') }}
                            </p>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">
                    <div class="alert alert-info text-center shadow-sm">
                        Aucune demande trouvée.
                    </div>
                </div>

            @endforelse

        </div>

    </div>
</div>