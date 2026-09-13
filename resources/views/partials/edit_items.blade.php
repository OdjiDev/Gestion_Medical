@include('include.header')

<div class="container my-5">
    <div class="card shadow-sm rounded-4 p-4">
        <!-- Header -->
        <h3 class="text-pr fw-bold mb-4 d-flex align-items-center">
            <i class="fa fa-user me-2"></i>Modifier la vente
        </h3>
<div>
    @if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>
        <!-- Formulaire -->
        <form action="{{route('vente.update',$vente->id) }}" method="post">
            @csrf
            @method('put')
            <div class="row g-3" id="medicament-container">
                <table class="table table-bordered" id="medicaments-table">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Nom</th>
                            <th>Quantité</th>
                            <th>Prix Unitaire</th>
                            <th>Montant</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="medicaments-body">

@foreach($vente->items as $item)
<tr class="medicament-item">

    <td style="position: relative;">

        <input type="text"
               value="{{ $item->medicament->nom ?? '' }}"
               class="form-control medicament-input">

        <input type="hidden"
               name="medicament_id[]"
               class="medicament-id"
               value="{{ $item->medicament_id }}">

        <input type="hidden"
               name="item_id[]"
               value="{{ $item->id }}">

        <input type="hidden"
               class="medicament-amo"
               value="{{ $item->medicament->amo ?? 0 }}">

        <div class="suggestions"></div>
    </td>

    <td>
        <input type="number"
               name="quantite[]"
               value="{{ $item->quantite }}"
               class="form-control qty" required>
    </td>

    <td>
        <input type="number"
               name="prix[]"
               value="{{ $item->prix }}"
               class="form-control price" readonly>
    </td>

    <td>
        <input type="number"
               name="montant[]"
               value="{{ $item->montant }}"
               class="form-control amount" readonly>
    </td>

    <td>
        <button type="button" class="btn btn-danger remove-btn">X</button>
    </td>

</tr>
@endforeach

</tbody>
                    <tfoot>

<tr>
    <th colspan="3" class="text-end">Total :</th>
    <th><input type="number" id="total" class="form-control" value="{{ $vente->total }}" readonly></th>
    <th></th>
</tr>

<tr>
    <th colspan="3" class="text-end text-primary">Montant AMO :</th>
    <th>
        <input type="number" id="montant_amo" class="form-control"   value="{{ $vente->montant_amo }}" readonly>
    </th>
    <th></th>
</tr>

<tr>
    <th colspan="3" class="text-end text-success">Montant à payer :</th>
    <th>
        <input type="number" id="montant_payer" class="form-control fw-bold"   value="{{ $vente->montant_payer }}" readonly>
    </th>
    <th></th>
</tr>

</tfoot>
                </table>
                <div class="mt-3 d-flex gap-2">

    <button type="button" class="btn bg-gradient-primary-custom text-white" id="add-btn">
        <i class="fas fa-plus me-1"></i>
        Ajouter un médicament
    </button>

   <button type="button"
        class="btn btn-outline-success"
        id="btn-amo"
        data-active="{{ $vente->amo }}">
    <i class="fas fa-file-medical me-1"></i>
    AMO
</button>
<input type="hidden" name="amo" id="amo" value="{{ $vente->amo ?? 0 }}">
<input type="hidden" id="taux_amo" value="{{ $parametre->amo }}">
</div>

            </div>



            <!-- Boutons -->
            <div class="mt-5 d-flex justify-content-end">
                <button type="button" class="btn btn-outline-secondary me-2 rounded-3" onclick="history.back()">Annuler</button>
                <button type="submit" class="btn bg-gradient-primary-custom text-white rounded-3">
                    <i class="fas fa-pen me-1"></i> Modifier
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {

    const btnAmo = document.getElementById('btn-amo');
    const amoField = document.getElementById('amo');
    const tauxAmo = document.getElementById('taux_amo');

    // =========================
    // AMO STATE
    // =========================
    const isAmoActive = () => parseInt(amoField.value || 0) === 1;

    const setAmoUI = (active) => {

        amoField.value = active ? 1 : 0;

        btnAmo.classList.toggle('btn-success', active);
        btnAmo.classList.toggle('btn-outline-success', !active);
    };

    // =========================
    // CALCUL GLOBAL
    // =========================
    const calculate = () => {

        let total = 0;
        let amoEligible = 0;
        let taux = parseFloat(tauxAmo?.value || 0);

        document.querySelectorAll('#medicaments-body tr').forEach(row => {

            let qty = parseFloat(row.querySelector('.qty')?.value) || 0;
            let price = parseFloat(row.querySelector('.price')?.value) || 0;
            let amo = parseInt(row.querySelector('.medicament-amo')?.value || 0);

            let montant = qty * price;

            total += montant;

            if (amo === 1) {
                amoEligible += montant;
            }
        });

        let montantAmo = 0;
        let montantPayer = total;

        if (isAmoActive()) {
            montantAmo = (amoEligible * taux) / 100;
            montantPayer = total - montantAmo;
        }

        document.getElementById('total').value = total.toFixed(2);
        document.getElementById('montant_amo').value = montantAmo.toFixed(2);
        document.getElementById('montant_payer').value = montantPayer.toFixed(2);
    };

    // =========================
    // ROW EVENTS
    // =========================
    function attachEvents(row) {

        row.querySelector('.qty')?.addEventListener('input', calculate);

        let input = row.querySelector('.medicament-input');
        let suggestions = row.querySelector('.suggestions');
        let hidden = row.querySelector('.medicament-id');
        let price = row.querySelector('.price');

        if (!input) return;

        input.addEventListener('input', function () {

            clearTimeout(window.timer);

            let q = this.value;

            if (q.length < 1) {
                suggestions.innerHTML = "";
                return;
            }

            window.timer = setTimeout(() => {

                fetch(`/medicaments/search?q=${q}`)
                    .then(r => r.json())
                    .then(data => {

                        suggestions.innerHTML = "";

                        data.forEach(item => {

                            let div = document.createElement("div");
                            div.innerHTML = item.nom;

                            div.addEventListener('click', function () {

                                input.value = item.nom;
                                hidden.value = item.id;
                                price.value = item.prix_vente;

                                row.querySelector('.medicament-amo').value = item.amo ?? 0;

                                suggestions.innerHTML = "";

                                calculate();
                            });

                            suggestions.appendChild(div);
                        });
                    });

            }, 200);
        });
    }

    // =========================
    // INIT ROWS
    // =========================
    document.querySelectorAll('#medicaments-body tr').forEach(row => {
        attachEvents(row);
    });

    // =========================
    // INIT AMO (FIX IMPORTANT)
    // =========================
    const init = () => {

        // 🔥 FORCER recalcul propre (NE PAS utiliser DB values)
        setAmoUI(isAmoActive());

        calculate();

        setTimeout(() => {
            calculate();
        }, 50);
    };

    init();

    // =========================
    // TOGGLE AMO
    // =========================
    btnAmo?.addEventListener('click', function () {

        setAmoUI(!isAmoActive());

        calculate();
    });

});
</script>

@include('include.footer')