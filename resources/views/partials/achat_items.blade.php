@include('include.header')

<div class="container my-5">
    <div class="card shadow-sm rounded-4 p-4">
        <form action="{{ route ('achat_items.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-8">
                    <!-- Header -->
                    <h3 class="text-pr fw-bold mb-4 d-flex align-items-center">
                        <i class="fa fa-user me-2"></i> Achat
                    </h3>
                </div>
                <!-- Header -->
                <div class="col-4">


                    <select name="fournisseur_id" id="fournisseur_id" class="form-select @error('fournisseur_id') is-invalid @enderror">
                        <option disabled selected>Selectionner un fournisseur</option>

                        @foreach($fournisseurs as $fournisseur)
                        <option value="{{ $fournisseur->id }}">
                            {{ $fournisseur->nom }}
                        </option>
                        @endforeach

                        </option>



                    </select>
                    @error('fournisseur_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>
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
                        <tr class="medicament-item">
                            <td style="position:relative;">
                                <!-- Champ visible -->

                                <input type="text" placeholder="nom du medicament" class="form-control medicament-input">
                                <input type="hidden" name="medicament_id[]" class="medicament-id">
                                <div class="suggestions"></div>
                            </td>





                            <td><input type="number" name="quantite[]" placeholder="quantite" class="form-control qty" required></td>
                            <td><input type="number" name="prix[]" class="form-control price" placeholder="prix unitaire " required></td>
                            <td><input type="number" name="montant[]" class="form-control amount" placeholder="montant" readonly required></td>
                            <td><button type="button" class="btn btn-danger remove-btn">X</button></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Total :</th>
                            <th><input type="number" id="total" class="form-control" placeholder="Prix totale " readonly></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
                <div class="mt-3">
                    <button type="button" class="btn bg-gradient-primary-custom text-white" id="add-btn">
                        + Ajouter un médicament
                    </button>
                </div>


            </div>



            <!-- Boutons -->
            <div class="mt-5 d-flex justify-content-end">
                <a type="button" class="btn btn-outline-secondary me-2 rounded-3" href="/achat">Annuler</a>

                <button type="submit" class="btn btn-success rounded-3">
                    <i class="fas fa-save me-1"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {

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
                removeBtn.addEventListener('click', function() {
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

            input.addEventListener('input', function() {

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

                                div.addEventListener("click", function() {

                                    input.value = item.nom;
                                    hiddenInput.value = item.id;
                                    priceInput.value = item.prix_achat;

                                    suggestions.innerHTML = "";

                                    updateAmounts();
                                });

                                suggestions.appendChild(div);
                            });
                        });

                }, 250); // 🔥 anti-spam
            });
        }

        // init rows existants
        document.querySelectorAll('#medicaments-body tr').forEach(row => {
            attachEvents(row);
        });

        // ajouter ligne
        document.getElementById('add-btn')?.addEventListener('click', function() {

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
        document.addEventListener("click", function(e) {
            document.querySelectorAll(".suggestions").forEach(box => {
                if (!box.contains(e.target)) {
                    box.innerHTML = "";
                }
            });
        });

    });
</script>
@include('include.footer')