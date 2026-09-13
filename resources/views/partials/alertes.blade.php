<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
      <!-- Custom fonts for this template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    
    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<div class="container mt-4">


    <div class="card shadow border-0">

        <div class="card-header bg-gradient-primary-custom text-white d-flex justify-content-between align-items-center">
            <h2 class="mb-0">
                <i class="fas fa-exclamation-triangle"></i>
                Médicaments en alerte
            </h2>

            <span class="badge bg-danger fs-6">
                {{ $medicaments->count() }} alertes
            </span>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover table-bordered align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nom du médicament</th>
                            <th>Stock actuel</th>
                            <th>Quantité d'alerte</th>
                            <th>Statut</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($medicaments as $key => $medicament)

                            <tr>

                                <td>{{ $key + 1 }}</td>

                                <td class="fw-bold text-primary">
                                    {{ $medicament->nom }}
                                </td>

                                <td>
                                    <span class="badge bg-danger">
                                        {{ $medicament->quantite }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-warning text-dark">
                                        {{ $medicament->quantite_alerte }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-danger">
                                        Stock faible
                                    </span>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center text-success fw-bold py-4">
                                    <i class="fas fa-check-circle"></i>
                                    Aucun médicament en alerte
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>
</body>
</html>