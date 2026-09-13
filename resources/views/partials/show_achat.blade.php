@include('include.header')


<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail Achat</title>


<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
        
            
                <div class=" card-header bg-gradient-primary-custom text-white">
            <h4 class="mb-0">Détail d'Achat</h4>
        
              
           
        
        
</div>

    <div class="card-body">

        <!-- Infos vente -->
        <!-- <div class="row mb-4">
            <div class="col-md-4">
                <strong>ID Vente : </strong> 00123
            </div>
            <div class="col-md-4">
                <strong>Date :</strong> 17 Avril 2026
            </div>
            <div class="col-md-4">
                <strong>Client :</strong> Moussa Traoré
            </div>
        </div> -->

        <!-- Tableau -->
        <div class="table-responsive">
            <table class="table  table-hover">
                <thead class="table-secondary">
                    <tr>
                        <th>Nom</th>
                        <th>Quantité</th>
                        <th>Prix Unitaire</th>
                        <th>Montant</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($acht->items as $item)
    <tr>
        <td>{{ $item->medicament->nom}}</td>
        <td>{{ $item->quantite }}</td>
        <td>{{ $item->prix }}</td>
        <td>{{ $item->montant }}</td>
    </tr>
@endforeach
                    
                </tbody>
            </table>
        </div>

        <!-- Total -->
        <div class="text-end">
            <h5 class="fw-bold">Total général : {{ $acht->total }} f </h5>
        </div>
<a href="/achat" class="btn btn-secondary">Retour</a>
    </div>
</div>


</div>

</body>
</html>

@include('include.footer')