@include('patient.header')

<div class="main-content">
    <div class="container-fluid py-4">

        <div class="row mb-3">
            <div class="col-12">
                <h4 class="fw-bold text-primary">
                      📅 Rendez vous 
                </h4>
            </div>
        </div>

        <div class="row g-3">

            @forelse($demandes as $demande)

                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">

                        <div class="card-body">

                            <p class="mb-2">
                                <strong>📄 Type :</strong>
                                {{ $demande->motif }}
                            </p>

                            <p class="mb-2">
                                <strong>📌 Statut :</strong>

                                <span class="badge bg-primary">
                                    {{ $demande->status }}
                                </span>
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
                        Aucune demande disponible
                    </div>
                </div>

            @endforelse

        </div>

    </div>
</div>