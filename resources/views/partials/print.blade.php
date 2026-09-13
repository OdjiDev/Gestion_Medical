<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ticket Réception</title>

    <style>
        @media print {
            @page {
                size: 55mm 85mm;
                margin: 2mm;
            }

            body {
                margin: 0;
            }

            button { display: none; }
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

        .center { text-align: center; }
        .line { border-top: 1px dashed #000; margin: 3px 0; }
        .bold { font-weight: bold; }
    </style>
</head>

<body onload="window.print()">

    <!-- EN-TÊTE -->
    <div class="center">
        <h3>CLINIQUE / HÔPITAL</h3>
        <p>REÇU</p>
    </div>

    <div class="line"></div>

    <!-- INFOS PATIENT -->
    <p><span class="bold">N°:</span>00{{ $recep->id }}</p>
    <p><span class="bold">Nom:</span> {{ $recep->nom }}</p>
    <p><span class="bold">Prénom:</span> {{ $recep->prenom }}</p>
    <p><span class="bold">Tél:</span> {{ $recep->telephone }}</p>

    <div class="line"></div>

    <!-- SERVICE -->
    <p><span class="bold">Service:</span> {{ $recep->service->type_service }}</p>

    <p>
        <span class="bold">AMO:</span>
        {{ $recep->amo ? 'Oui' : 'Non' }}
    </p>

    <div class="line"></div>

    <!-- PRIX -->
    <p class="bold">
        Prix: {{ number_format($recep->montantPayer, 0, ',', ' ') }} Fcfa
    </p>

    <div class="line"></div>

    <!-- DATE -->
    <p>Date: {{ $recep->created_at }}</p>

    <div class="center">
        <p>Merci !!!</p>
    </div>

</body>
</html>