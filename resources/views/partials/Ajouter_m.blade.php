@include('include.header')

<div class="container my-5">
    <div class="card shadow-sm rounded-4 p-4">
        <!-- Header -->
        <h3 class="text-pr fw-bold mb-4 d-flex align-items-center">
            <i class="fas fa-pills me-2"></i> Ajouter un medicament
        </h3>

        <!-- Formulaire -->
        <form action="{{ route('medicaments.store') }}" method="post">
            @csrf
            <div class="row g-3">
                <!-- Nom -->
                <div class="col-md-6">
                    <label for="nom" class="form-label fw-semibold">Nom</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <input type="text" name="nom" id="nom" value="{{ old('nom') }}" 
                               class="form-control @error('nom') is-invalid @enderror" 
                               placeholder="Entrez le nom du medicament">
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- description -->
                <div class="col-md-6">
                    <label for="description" class="form-label fw-semibold">Description</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-align-left me-2"></i></span>
                        <input type="text" name="description" id="description" value="{{ old('description') }}" 
                               class="form-control @error('description') is-invalid @enderror" 
                               placeholder="description">
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- quantite -->
                 {{--
                 <div class="col-md-6">
                    <label for="quantite" class="form-label fw-semibold">Quantite</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                        <input type="text" name="quantite" id="quantite" value="{{ old('quantite') }}" 
                               class="form-control @error('quantite') is-invalid @enderror" 
                               placeholder="quantite">
                        @error('quantite')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                --}}

                 
                
                <!-- prix d'achat-->
                <div class="col-md-6">
                    <label for="prix_achat" class="form-label fw-semibold">Prix d'achat</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-money-bill"></i></span>
                        <input type="number" name="prix_achat" id="prix_achat" value="{{old('prix_achat') }}" 
                               class="form-control @error('prix_achat') is-invalid @enderror" 
                               placeholder="prix">
                        @error('prix_achat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                
                <!-- prix vente -->
                <div class="col-md-6">
                    <label for="prix_vente" class="form-label fw-semibold">Prix de vente</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-money-bill"></i></span>
                        <input type="number" name="prix_vente" id="prix_vente" value="{{old('prix_vente') }}" 
                               class="form-control @error('prix_vente') is-invalid @enderror" 
                               placeholder="prix de vente">
                        @error('prix_vente')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                                <!-- quantite d'alerte-->
                <div class="col-md-6">
                    <label for="quantite_alerte" class="form-label fw-semibold">Quantite d'alerte</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-exclamation-triangle "></i></span>
                        <input type="text" name="quantite_alerte" id="quantite_alerte" value="{{ old('quantite_alerte') }}" 
                               class="form-control @error('quantite_alerte') is-invalid @enderror" 
                               placeholder="quantite d'alerte">
                        @error('quantite_alerte')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <!-- date -->
                <div class="col-md-6">
                    <label for="date_expiration" class="form-label fw-semibold">Date d'expiration</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-date"></i></span>
                        <input type="date" name="date_expiration" id="date_expiration" value="{{old('date_expiration') }}" 
                               class="form-control @error('date_expiration') is-invalid @enderror" 
                               placeholder="date d'espiration">
                        @error('date_expiration')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                
<!-- AMO -->
<div class="col-md-6">
    <label for="amo" class="form-label fw-semibold">AMO</label>

    <select name="amo"
        id="amo"
        class="form-control @error('amo') is-invalid @enderror">
        <option value="">-- Choisir --</option>
<option value="1">Oui</option>
<option value="0">Non</option>
    </select>

    @error('amo')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                

               

            <!-- Boutons -->
            <div class="mt-5 d-flex justify-content-end">
                <button type="button" class="btn btn-outline-secondary me-2 rounded-3" onclick="history.back()">Annuler</button>
                <button type="submit" class="btn bg-gradient-primary-custom text-white rounded-3">
                    <i class="fa fa-save me-1"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

@include('include.footer')
