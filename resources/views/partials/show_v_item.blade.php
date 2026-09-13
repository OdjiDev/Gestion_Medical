@include('include.header')


<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail de la vente</title>


<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-gradient-primary-custom text-white">
            <h4 class="mb-0">Détail de la vente</h4>
        </div>


    <div class="card-body">

    @if($vte->amo == 1)
        <div class="alert alert-success">
            ✔ Cette vente est effectuée avec AMO
        </div>
    @else
        <div class="alert alert-secondary">
            Cette vente n'est pas effectuée avec AMO
        </div>
    @endif

    <!-- Tableau -->
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-secondary">
                <tr>
                    <th>Nom</th>
                    <th>Quantité</th>
                    <th>Prix Unitaire</th>
                    <th>Montant</th>
                     @if($vte->amo == 1)
    <th>AMO</th>
@endif
                </tr>
            </thead>
            <tbody>
                @foreach($vte->items as $item)
                    <tr>
                        <td>{{ $item->medicament->nom}}</td>
                        <td>{{ $item->quantite }}</td>
                        <td>{{ $item->prix }}</td>
                        <td>{{ $item->montant }}</td>
                         @if($vte->amo == 1)
    <td>
        {{ $item->medicament->amo == 1 ? 'OUI' : 'NON' }}
    </td>
@endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Total -->
    <div class="text-end">
        <h5 class="fw-bold">
            Total général : {{ $vte->montant_payer}} f
        </h5>
    </div>

    <a href="/vente_m" class="btn btn-secondary">Retour</a>

</div>
</div>


</div>

</body>
</html>

@include('include.footer')