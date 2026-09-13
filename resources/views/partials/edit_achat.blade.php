@include('include.header')

<div class="container my-5">
    <div class="card shadow-sm rounded-4 p-4">

        <form action="{{ route('achat_items.update', $achat->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-8">
                    <h3 class="text-pr fw-bold mb-4 d-flex align-items-center">
                        <i class="fa fa-user me-2"></i> Modifier l'achat
                    </h3>
                </div>

                <div class="col-4">
                    <select name="fournisseur_id"
                        id="fournisseur_id"
                        class="form-select @error('fournisseur_id') is-invalid @enderror">

                        <option disabled>Sélectionner un fournisseur</option>

                        @foreach($fournisseurs as $fournisseur)
                        <option value="{{ $fournisseur->id }}"
                            {{ $achat->fournisseur_id == $fournisseur->id ? 'selected' : '' }}>
                            {{ $fournisseur->nom }}
                        </option>
                        @endforeach

                    </select>

                    @error('fournisseur_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
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

            <div class="row g-3" id="medicament-container">

                <table class="table table-bordered" id="medicaments-table">

                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Nom</th>
                            <th>Quantité</th>
                            <th>Prix d'achat</th>
                            <th>Montant</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody id="medicaments-body">

                        @foreach($achat->items as $item)

                        <tr class="medicament-item">

                            <td style="position:relative;">

                                <input type="text"
                                    class="form-control medicament-input"
                                    value="{{ $item->medicament->nom ?? '' }}"
                                    autocomplete="off">

                                <input type="hidden"
                                    name="medicament_id[]"
                                    class="medicament-id"
                                    value="{{ $item->medicament_id }}">

                                <input type="hidden"
                                    name="item_id[]"
                                    value="{{ $item->id }}">

                                <div class="suggestions"
                                    style="position:absolute;
                                            width:100%;
                                            background:white;
                                            z-index:999;
                                            border:1px solid #ddd;">
                                </div>

                            </td>

                            <td>
                                <input type="number"
                                    name="quantite[]"
                                    class="form-control qty"
                                    value="{{ $item->quantite }}"
                                    required>
                            </td>

                            <td>
                                <input type="number"
                                    name="prix[]"
                                    class="form-control price"
                                    value="{{ $item->prix }}"
                                    required>
                            </td>

                            <td>
                                <input type="number"
                                    name="montant[]"
                                    class="form-control amount"
                                    value="{{ $item->montant }}"
                                    readonly>
                            </td>

                            <td>
                                <button type="button"
                                    class="btn btn-danger remove-btn">
                                    X
                                </button>
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">
                                Total :
                            </th>

                            <th>
                                <input type="number"
                                    id="total"
                                    class="form-control"
                                    readonly>
                            </th>

                            <th></th>
                        </tr>
                    </tfoot>

                </table>

                <div class="mt-3">
                    <button type="button"
                        class="btn bg-gradient-primary-custom text-white"
                        id="add-btn">

                        + Ajouter un médicament
                    </button>
                </div>

            </div>

            <div class="mt-5 d-flex justify-content-end">

                <a class="btn btn-outline-secondary me-2 rounded-3"
                    href="/achat">
                    Annuler
                </a>

                <input type="submit"
                    class="btn btn-success rounded-3"
                    value="Valider" />

                    <!-- <i class="fas fa-check me-1"></i> -->
                    <!-- Valider -->
                <!-- </button> -->

            </div>

        </form>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // =========================
        // CALCUL TOTAL
        // =========================
        function updateAmounts() {

            let total = 0;

            document.querySelectorAll('#medicaments-body tr').forEach(row => {

                let qty = parseFloat(row.querySelector('.qty')?.value) || 0;
                let price = parseFloat(row.querySelector('.price')?.value) || 0;

                let amount = qty * price;

                const amountInput = row.querySelector('.amount');
                if (amountInput) {
                    amountInput.value = amount.toFixed(2);
                }

                total += amount;
            });

            const totalInput = document.getElementById('total');
            if (totalInput) {
                totalInput.value = total.toFixed(2);
            }
        }

        let typingTimer;

        // =========================
        // ATTACH EVENTS (SAFE)
        // =========================
        function attachEvents(row) {

            if (!row) return;

            // qty + price change
            row.querySelectorAll('.qty, .price').forEach(input => {
                if (input) {
                    input.addEventListener('input', updateAmounts);
                }
            });

            // REMOVE BUTTON SAFE
            const removeBtn = row.querySelector('.remove-btn');

            if (removeBtn) {
                removeBtn.addEventListener('click', function() {

                    if (document.querySelectorAll('#medicaments-body tr').length > 1) {
                        row.remove();
                        updateAmounts();
                    }
                });
            }

            // AUTOCOMPLETE SAFE
            const input = row.querySelector('.medicament-input');
            const suggestions = row.querySelector('.suggestions');
            const hiddenInput = row.querySelector('.medicament-id');
            const priceInput = row.querySelector('.price');

            if (!input || !suggestions) return;

            input.addEventListener('input', function() {

                clearTimeout(typingTimer);

                let query = this.value;

                if (query.length < 1) {
                    suggestions.innerHTML = '';
                    return;
                }

                typingTimer = setTimeout(() => {

                    fetch(`/medicaments/search?q=${query}`)
                        .then(res => {

                            if (!res.ok) {
                                throw new Error('Erreur API medicaments');
                            }

                            return res.json();
                        })
                        .then(data => {

                            suggestions.innerHTML = '';

                            data.forEach(item => {

                                let div = document.createElement('div');

                                div.className = 'list-group-item';
                                div.style.cursor = 'pointer';
                                div.textContent = item.nom;

                                div.addEventListener('click', function() {

                                    input.value = item.nom;

                                    if (hiddenInput) {
                                        hiddenInput.value = item.id;
                                    }

                                    if (priceInput && item.prix_achat) {
                                        priceInput.value = item.prix_achat;
                                    }

                                    suggestions.innerHTML = '';
                                    updateAmounts();
                                });

                                suggestions.appendChild(div);
                            });

                        })
                        .catch(err => {
                            console.error(err);
                        });

                }, 300);
            });
        }

        // =========================
        // INIT EXISTING ROWS
        // =========================
        document.querySelectorAll('#medicaments-body tr').forEach(row => {
            attachEvents(row);
        });

        // =========================
        // ADD ROW SAFE
        // =========================
        const addBtn = document.getElementById('add-btn');

        if (addBtn) {
            addBtn.addEventListener('click', function() {

                const tbody = document.getElementById('medicaments-body');
                const template = document.querySelector('.medicament-item');

                if (!tbody || !template) return;

                let newRow = template.cloneNode(true);

                newRow.querySelectorAll('input').forEach(input => {
                    input.value = '';
                });

                const amountInput = newRow.querySelector('.amount');
                if (amountInput) amountInput.value = '0';

                const suggestions = newRow.querySelector('.suggestions');
                if (suggestions) suggestions.innerHTML = '';

                tbody.appendChild(newRow);

                attachEvents(newRow);
                updateAmounts();
            });
        }

        // =========================
        // CLOSE SUGGESTIONS
        // =========================
        document.addEventListener('click', function(e) {

            document.querySelectorAll('.suggestions').forEach(box => {
                if (box && !box.contains(e.target)) {
                    box.innerHTML = '';
                }
            });

        });

        // INIT TOTAL
        updateAmounts();
    });
</script>

@include('include.footer')