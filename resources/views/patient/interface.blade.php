@include('patient.header')

<div class="main-content">

    <div class="container-fluid py-4">

        <div class="dashboard-header shadow-sm bg"  >
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>
                    <span class="text-uppercase small fw-semibold text-white">
                        Tableau de bord
                    </span>

                    @if(auth('patient')->check())
                        <h2 class="fw-bold mb-1">
                            👋 Bonjour, {{ auth('patient')->user()->nom }}
                        </h2>
                    @endif
                </div>

            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('demande.create') }}"
                   class="btn btn-primary btn-lg bg rounded-pill">
                    Nouveau rendez-vous
                </a>
            </div>
        </div>

    </div>

</div>