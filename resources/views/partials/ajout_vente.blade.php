@include('include.header')

<div class="container my-5">
    <div class="card shadow-sm rounded-4 p-4">
        <!-- Header -->
        <h3 class="text-pr fw-bold mb-4 d-flex align-items-center">
             <i class="fas fa-shopping-cart"></i> Vente
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

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

</div>
        <!-- Formulaire -->
        <form action="{{route('vente.store') }}" method="post">
            @csrf
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
                        <tr class="medicament-item">
                        <td style="position: relative;">
    <!-- Champ visible -->
    
        <input type="text" placeholder="nom du medicament" class="form-control medicament-input">
        <input type="hidden" name="medicament_id[]" class="medicament-id">
        <input type="hidden" class="medicament-amo" value="0">
        <div id="amo-message" class="text-danger mt-2"></div>
        <div class="amo-warning text-danger small mt-1"></div>
        <div class="suggestions"></div>
    </td>

    
        


                            <td><input type="number" name="quantite[]" placeholder="quantite" class="form-control qty" required></td>
                            <td><input type="number" name="prix[]" class="form-control price" placeholder="prix unitaire" readonly></td>
                            <td><input type="number"  name="montant[]" class="form-control amount" placeholder="montant"  readonly required></td>
                            <td><button type="button" class="btn btn-danger remove-btn" >X</button></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Total :</th>
                            <th><input type="number" id="total" class="form-control" placeholder="Prix totale " readonly></th>
                            <th></th>
                        </tr>
                        <tr>
        <th colspan="3" class="text-end text-primary">
            Montant AMO :
        </th>
        <th>
            <input type="number" id="montant_amo" name="montant_amo" class="form-control" readonly>
        </th>
        <th></th>
    </tr>

    <tr>
        <th colspan="3" class="text-end text-success">
            Montant à payer :
        </th>
        <th>
            <input type="number" id="montant_payer" name="montant_payer" class="form-control fw-bold" readonly>
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

    <button type="button" class="btn btn-outline-success" id="btn-amo">
        <i class="fas fa-file-medical me-1"></i>
         AMO
    </button>
    <input type="hidden" name="amo" id="amo" value="0">
<input type="hidden" id="taux_amo" value="{{ $parametre->amo }}">
</div>
               

            </div>



            <!-- Boutons -->
            <div class="mt-5 d-flex justify-content-end">
                <button type="button" class="btn btn-outline-secondary me-2 rounded-3" onclick="history.back()">Annuler</button>
                <button type="submit" class="btn btn-success rounded-3">
                    <i class="fas fa-save me-1"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const updateAmounts = () => {
        let total = 0;

        document.querySelectorAll('#medicaments-body tr').forEach(row => {

            let qty = parseFloat(row.querySelector('.qty')?.value) || 0;
            let price = parseFloat(row.querySelector('.price')?.value) || 0;

            let amount = qty * price;

            let amountInput = row.querySelector('.amount');
            if (amountInput) amountInput.value = amount.toFixed(2);

            total += amount;
        });

        document.getElementById('total').value = total.toFixed(2);
    };

    window.updateAmounts = updateAmounts;

    // 🔥 debounce simple (évite spam serveur)
    let typingTimer;

    function attachEvents(row) {

        let removeBtn = row.querySelector('.remove-btn');

        if (removeBtn) {
            removeBtn.addEventListener('click', function () {
                if (document.querySelectorAll('#medicaments-body tr').length > 1) {
                    row.remove();
                    updateAmounts();
                }
            });
        }

        row.querySelectorAll('.qty, .price').forEach(input => {
            input.addEventListener('input', updateAmounts);
        });

        let input = row.querySelector('.medicament-input');
        let suggestions = row.querySelector('.suggestions');
        let hiddenInput = row.querySelector('.medicament-id');
        let priceInput = row.querySelector('.price');

        if (!input) return;

        input.addEventListener('input', function () {

            clearTimeout(typingTimer);

            let query = this.value;
            
            if (query.length < 1) {
                suggestions.innerHTML = "";
                return;
            }

            typingTimer = setTimeout(() => {

                fetch(`/medicaments/search?q=${query}`)
                    .then(res => res.json())
                    .then(data => {

                        suggestions.innerHTML = "";

                        data.forEach(item => {
                            let div = document.createElement("div");

                            // 🔥 DESIGN PRO
                            div.innerHTML = `
                                <div style="display:flex;justify-content:space-between;">
                                    <span> ${item.nom}</span>
                                    
                                </div>
                            `;

                           div.addEventListener("click", function () {

    input.value = item.nom;
    hiddenInput.value = item.id;
    priceInput.value = item.prix_vente;

    // 🔥 IMPORTANT : AMO
    let amoInput = row.querySelector('.medicament-amo');
    if (amoInput) {
        amoInput.value = item.amo ?? 0;
    }

    suggestions.innerHTML = "";

    updateAmounts();
});

                            suggestions.appendChild(div);
                        });
                    });

            }, 250); //  anti-spam
        });
    }

    // init rows existants
    document.querySelectorAll('#medicaments-body tr').forEach(row => {
        attachEvents(row);
    });

    // ajouter ligne
    document.getElementById('add-btn')?.addEventListener('click', function () {

        let tbody = document.getElementById('medicaments-body');
        let newRow = document.querySelector('.medicament-item').cloneNode(true);

        newRow.querySelectorAll('input').forEach(input => {
            if (input.classList.contains('amount')) {
                input.value = 0;
            } else {
                input.value = '';
            }
        });

        let box = newRow.querySelector('.suggestions');
        if (box) box.innerHTML = "";

        tbody.appendChild(newRow);

        attachEvents(newRow);
    });

    // fermer suggestions si clic dehors
    document.addEventListener("click", function (e) {
        document.querySelectorAll(".suggestions").forEach(box => {
            if (!box.contains(e.target)) {
                box.innerHTML = "";
            }
        });
    });

});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const btn = document.getElementById('btn-amo');
    const msg = document.getElementById('amo-message');

    if (!btn) return;

    let amoActive = false;

    

   btn.addEventListener('click', function () {

    amoActive = !amoActive;

    document.getElementById('amo').value = amoActive ? 1 : 0;

        // Désactivation AMO
        if (!amoActive) {

            document.getElementById('montant_amo').value = '0.00';

            let total = parseFloat(document.getElementById('total').value) || 0;
            document.getElementById('montant_payer').value = total.toFixed(2);

            if (msg) msg.innerHTML = '';

            return;
        }

        let total = 0;
        let totalAmoEligible = 0;
        let produitsNonAmo = [];

        let taux = parseFloat(document.getElementById('taux_amo')?.value) || 0;

        document.querySelectorAll('#medicaments-body tr').forEach(function(row) {

            let nom = row.querySelector('.medicament-input')?.value?.trim() || '';

            // Ignorer les lignes vides
            if (nom === '') {
                return;
            }

            let montant = parseFloat(row.querySelector('.amount')?.value) || 0;
            let amo = parseInt(row.querySelector('.medicament-amo')?.value);

            total += montant;

            if (amo === 1) {
                totalAmoEligible += montant;
            } else {
                produitsNonAmo.push(nom);
            }

        });

        let montantAmo = (totalAmoEligible * taux) / 100;
        let montantPaye = total - montantAmo;

        document.getElementById('total').value = total.toFixed(2);
        document.getElementById('montant_amo').value = montantAmo.toFixed(2);
        document.getElementById('montant_payer').value = montantPaye.toFixed(2);

        // Message produits NON AMO
       document.querySelectorAll('#medicaments-body tr').forEach(function(row) {

    let nom = row.querySelector('.medicament-input')?.value?.trim() || '';
    let amo = parseInt(row.querySelector('.medicament-amo')?.value);
    let warning = row.querySelector('.amo-warning');

    if (!warning) return;

    if (amoActive && nom !== '' && amo !== 1) {

        warning.innerHTML =
            `⚠ ${nom} n'est pas pris en charge par l'AMO`;

    } else {

        warning.innerHTML = '';

    }

});

    });

});
</script>

@include('include.footer')

