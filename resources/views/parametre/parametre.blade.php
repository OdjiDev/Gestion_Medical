@include('include.header')

<div class="container-fluid py-4">

    <div class="card shadow-sm">
        <div class="card-header bg-gradient-primary-custom text-white">
            <h5 class="mb-0">
                <i class="fas fa-cog me-2"></i>
                Paramètres 
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('parametre.store') }}" method="POST">
                @csrf
                <div class="row">
                <div class="col-9 mb-4">
                    <label for="amo" class="form-label fw-bold">
                        Pourcentage AMO
                    </label>

                    <div class="input-group">
                        <input type="number"
                               class="form-control"
                               id="amo"
                               name="amo"
                               min="0"
                               max="100"
                               step="0.01"
                               value="{{ $parametre->amo ?? 00 }}"
                               placeholder="Exemple : 70">
                        <span class="input-group-text">%</span>
                    </div>

                    <small class="text-muted">
                        Saisissez le taux de prise en charge AMO.
                    </small>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i>
                        Enregistrer
                    </button>
                </div>
</div>
            </form>
        </div>
    </div>

</div>