@include('include.header')

<div class="container my-5">
    <div class="card shadow-sm rounded-4 p-4">
        <!-- Header -->
       
<div class="container-fluid">
     <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Modifier la Réception</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i>Ajouter</a> -->
                    </div>
        <form action="{{ route('reception.update', $reception->id) }}" method="POST">
    @csrf
    @method('PUT')
                     <div class="row g-3 m-auto">
                
                <!-- Nom  -->
                <div class="col-md-6">
                    <label for="name" class="form-label fw-semibold">Nom </label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <input type="text" name="nom" id="nom" value="{{ old('nom',$reception->nom) }}" 
                               class="form-control @error('nom') is-invalid @enderror" 
                               placeholder="Nom">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!--  Prénom -->
                <div class="col-md-6">
                    <label for="prenom" class="form-label fw-semibold">Prénom</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <input type="text" name="prenom" id="prenom" value="{{ old('prenom',$reception->prenom) }}" 
                               class="form-control @error('prenom') is-invalid @enderror" 
                               placeholder="Prenom">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                

                <!-- Téléphone -->
                <div class="col-md-6">
                    <label for="telephone" class="form-label fw-semibold">Téléphone</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                        <input type="number" name="telephone" id="telephone" value="{{ old('telephone',$reception->telephone) }}" 
                               class="form-control @error('telephone') is-invalid @enderror" 
                               placeholder="Numéro">
                        @error('telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
<div class="col-md-6">
                        <label for="telephone" class="form-label fw-semibold">service</label>

   
<select name="service_id" id="service" class="form-select">
    <option value="">Choisir un service</option>

    @foreach($services as $service)
        <option value="{{ $service->id }}"
            {{ old('service_id', $reception->service_id) == $service->id ? 'selected' : '' }}>
            {{ ucfirst($service->type_service) }}
        </option>
    @endforeach
</select>
</div>
<div class="col-md-6">
    <label for="amo" class="form-label fw-semibold">AMO</label>

    <select name="amo"
            id="amo"
            class="form-control @error('amo') is-invalid @enderror"
            data-taux-amo="{{ $parametre->amo }}">

        <option value="">-- Choisir --</option>

        <option value="1" {{ old('amo', $reception->amo) == 1 ? 'selected' : '' }}>
            Oui
        </option>

        <option value="0" {{ old('amo', $reception->amo) == 0 ? 'selected' : '' }}>
            Non
        </option>
    </select>

    @error('amo')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<!--  prix -->
              <div class="col-md-6">
    <label for="tarif" class="form-label fw-semibold">Prix</label>

    <div class="input-group">
        <span class="input-group-text">
            <i class="fas fa-money-bill"></i>
        </span>

        <input type="number"
               name="tarif"
               id="tarif"
               value="{{ old('tarif', $reception->tarif) }}"
               class="form-control @error('tarif') is-invalid @enderror"
               placeholder="prix">

               <input type="hidden" name="montantAmo" id="montantAmo_input"
       value="{{ old('montantAmo', $reception->montantAmo) }}">

<input type="hidden" name="montantPayer" id="montantPayer_input"
       value="{{ old('montantPayer', $reception->montantPayer) }}">

        @error('tarif')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-12 mt-4">
    <div class="">
        <div class="">

            <h6 class="fw-bold mb-3">
                Résumé du paiement
            </h6>

            <div class="d-flex justify-content-between border-bottom py-2">
                <span class="text-muted">Montant AMO</span>
                <span class="fw-semibold text-danger">-
                    <span id="montantAmo">{{ old('montantAmo', $reception->montantAmo) }}</span> F CFA
                </span>
            </div>

            <div class="d-flex justify-content-between py-2">
                <span class="text-muted">Montant à payer</span>
                <span class="fw-bold text-success fs-5">
                    <span id="montantPayer" > {{ old('montantPayer', $reception->montantPayer) }}</span> F CFA
                </span>
            </div>

        </div>
    </div>
</div>


 <div class="mt-5 d-flex justify-content-end">
                <button type="button" class="btn btn-outline-secondary me-2 rounded-3" onclick="history.back()">Annuler</button>
                <button type="submit" class="btn bg-gradient-primary-custom text-white rounded-3">
                    <i class="fas fa-pen me-1"></i> Modifier
                </button>

   
   </div>
</div>
</form>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const amo = document.getElementById('amo');
    const tarif = document.getElementById('tarif');

    const amoText = document.getElementById('montantAmo');
    const payerText = document.getElementById('montantPayer');

    const amoInput = document.getElementById('montantAmo_input');
    const payerInput = document.getElementById('montantPayer_input');

    if (!amo || !tarif) return;

    function recalculer() {

        let prix = parseFloat(tarif.value) || 0;
        let tauxAmo = parseFloat(amo.dataset.tauxAmo || 0);

        let montantAmo = 0;
        let montantPayer = prix;

        // Si AMO activé
        if (amo.value == "1") {
            montantAmo = (prix * tauxAmo) / 100;
            montantPayer = prix - montantAmo;
        }

        // Mise à jour affichage
        if (amoText) {
            amoText.innerText = montantAmo.toFixed(0);
        }

        if (payerText) {
            payerText.innerText = montantPayer.toFixed(0);
        }

        // Mise à jour inputs cachés
        if (amoInput) {
            amoInput.value = montantAmo.toFixed(0);
        }

        if (payerInput) {
            payerInput.value = montantPayer.toFixed(0);
        }

        console.log("Prix:", prix, "AMO:", montantAmo, "Final:", montantPayer);
    }

    amo.addEventListener('change', recalculer);
    tarif.addEventListener('input', recalculer);

    // Calcul au chargement de la page
    recalculer();
});
</script>

@include('include.footer') 