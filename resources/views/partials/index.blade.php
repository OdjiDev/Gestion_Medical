@include('include.header')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tableau de bord </h1>

        <!-- <a href="#" class="btn btn-sm bg-gradient-primary-custom text-white shadow-sm">
            <i class="fas fa-download fa-sm"></i> Rapport
        </a> -->
    </div>
@role('admin|pharmacien')
    <!-- KPI ROW 1 -->
    <div class="row g-4">

        <div class="col-xl-3 col-md-6">
            <div class="kpi-card blue">
                <div>
                    <h6>Achats</h6>
                    <h3>{{ $achatCount }}</h3>
                </div>
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="kpi-card green">
                <div>
                    <h6>Ventes</h6>
                    <h3>{{ $venteCount }}</h3>
                </div>
                <i class="fas fa-cash-register"></i>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="kpi-card purple">
                <div>
                    <h6>Produits</h6>
                    <h3>{{ $medicamentCount }}</h3>
                </div>
                <i class="fas fa-capsules"></i>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
    <a href="#" data-bs-toggle="modal" data-bs-target="#alertesModal" style="text-decoration:none;">
        <div class="kpi-card red">
            <div>
                <h6>Alertes</h6>
                <h3>{{ $alertes }}</h3>
            </div>
            <i class="fas fa-triangle-exclamation"></i>
        </div>
    </a>
</div>
  <div class="modal fade" id="alertesModal" tabindex="-1" aria-labelledby="alertesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

      <!-- HEADER DESIGN ONLY -->
      <div class="modal-header bg-danger text-white border-0 px-4 py-3">

        <div class="d-flex align-items-center gap-2">
          <i class="fas fa-exclamation-triangle fs-5"></i>
          <h5 class="modal-title mb-0" id="alertesModalLabel">
            Médicaments en alerte
          </h5>
        </div>

        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- BODY DESIGN ONLY -->
      <div class="modal-body bg-light p-4">

        <div class="card border-0 shadow-sm rounded-4">

          <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

              <!-- TABLE HEADER -->
              <thead class="table-dark">
                <tr>
                  <th class="px-3">#</th>
                  <th>Médicament</th>
                  <th>Stock actuel</th>
                  <th>Quantité d'alerte</th>
                  <th>Statut</th>
                </tr>
              </thead>

              <!-- TABLE BODY (inchangé Blade) -->
              <tbody>

                @forelse($medicaments as $key => $medicament)
                  <tr>

                    <td class="px-3 text-muted fw-semibold">
                      {{ $key + 1 }}
                    </td>

                    <td class="fw-bold text-primary">
                      {{ $medicament->nom }}
                    </td>

                    <td>
                      <span class="badge bg-danger px-3 py-2 rounded-pill">
                        {{ $medicament->quantite }}
                      </span>
                    </td>

                    <td>
                      <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                        {{ $medicament->quantite_alerte }}
                      </span>
                    </td>

                    <td>
                      <span class="badge bg-danger px-3 py-2 rounded-pill">
                        Stock faible
                      </span>
                    </td>

                  </tr>

                @empty

                  <tr>
                    <td colspan="5" class="text-center py-5">
                      <i class="fas fa-check-circle text-success fs-2 mb-2"></i>
                      <div class="fw-bold text-success">
                        Aucun médicament en alerte
                      </div>
                    </td>
                  </tr>

                @endforelse

              </tbody>

            </table>

          </div>

        </div>

      </div>

    </div>
  </div>
</div>
@endrole
@role('admin|user|medecin')
    <!-- KPI ROW 2 -->
    <div class="row mt-4 g-4">

        <div class="col-xl-3 col-md-6">
            <div class="kpi-card user-card">
                <div>
                    <h6>Utilisateurs</h6>
                    <h3>{{ $usersCount }}</h3>
                </div>
                <i class="fas fa-users"></i>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="kpi-card green">
                <div>
                    <h6>Réceptions</h6>
                    <h3>{{ $receptionCount }}</h3>
                </div>
                <i class="fas fa-hospital-user"></i>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="kpi-card blue">
                <div>
                    <h6>Services</h6>
                    <h3>{{ $serviceCount }}</h3>
                </div>
                <i class="fas fa-stethoscope"></i>
            </div>
        </div>

    </div>
    @endrole

    <!-- GRAPH -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card shadow border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0">📈 Statistiques Mensuelles</h5>
                </div>
                <div class="card-body">
                    <canvas id="hospitalChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

const ctx = document.getElementById('hospitalChart');

if (ctx) {
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),

            datasets: [
                {
                    label: 'Réceptions',
                    data: @json($receptions),
                    backgroundColor: '#20c997'
                },
                {
                    label: 'Ventes',
                    data: @json($ventes),
                    backgroundColor: '#1cc88a'
                },
                {
                    label: 'Achats',
                    data: @json($achats),
                    backgroundColor: '#4e73df'
                }
            ]
        },

        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
}

});
</script>
   
@include('include.footer')