@include('patient.header')
<div class="main-content">
    <div class="container-fluid py-4">
<h3 class="mb-3">Mes résultats</h3>

<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">

        <thead class="table-dark">
            <tr>
                <th>Nom du document</th>
                <th>Date d’envoi</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($documents as $doc)
                <tr>
                    <td>{{ $doc->nom }}</td>

                    <td>
                        {{ \Carbon\Carbon::parse($doc->date_envoi)->format('d/m/Y H:i') }}
                    </td>

                    <td class="text-center">
                        <a href="{{ asset('storage/'.$doc->fichier) }}"
                           target="_blank"
                           class="btn btn-sm btn-primary">
                            📄 Voir / Télécharger
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">
                        Aucun résultat disponible
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>
</div>
</div>    
</div>