<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ticket de la vente</title>

    <style>
    @media print {
        @page {
            size: 55mm 85mm;
            margin: 2mm;
        }

        body {
            margin: 0;
        }

        button {
            display: none;
        }
    }

    body {
        font-family: monospace;
        width: 55mm;
        height: 85mm;
        font-size: 9px;
        margin: 0 auto;
        line-height: 1.2;
    }

    h3 {
        margin: 2px 0;
        font-size: 10px;
    }

    p {
        margin: 2px 0;
    }

    /* TABLEAU */
    .table-bordered {
        border-collapse: collapse;
        width: 100%;
    }

    .table-bordered th,
    .table-bordered td {
        border: 0.5px solid #666;
        padding: 2px;
        font-size: 8px;
    }

    .table-bordered th {
        background: #f2f2f2;
    }

    .center {
        text-align: center;
    }

    .line {
        border-top: 1px dashed #999;
        margin: 3px 0;
    }

    .bold {
        font-weight: bold;
    }
</style>
</head>
<body onload="window.print()">

    <!-- EN-TÊTE -->
    <div class="center">
        <h3>CLINIQUE / HÔPITAL</h3>
        <p>REÇU DE PAIEMENT</p>
    </div>
    <div class="line"></div>
    <!-- DATE -->
   <p>Date: {{ $vte->created_at }}</p>
    
    <!-- info de la vente -->
    <p><span class="bold">Facture N°: {{ $vte->id }}</span> </p>
 <table class="table table-bordered">
                <thead class=" table-bordered">
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
        

        <!-- Total -->
        <div class="text-end">
           
<div class="line"></div>



@if($vte->amo == 1)
<p><strong>Total général :</strong> {{ $vte->total }} f</p>
    <p><strong>Prise en charge AMO :</strong> {{ $vte->montant_amo ?? 0 }} f</p>
    <p><strong>Montant à payer :</strong> {{ $vte->montant_payer ?? $vte->total }} f</p>
@else
    <p><strong>Montant à payer :</strong> {{ $vte->total }} f</p>
@endif
        </div>
         <div class="line"></div>

   


      <div class="center">
        <p>Merci !!!</p>
    </div>

</body>
</html>