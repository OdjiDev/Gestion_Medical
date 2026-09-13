@include('include.header')

<div class="container my-5">
    <div class="card shadow-sm rounded-4 p-4">
        <!-- Header -->
        <h3 class="text-pr fw-bold mb-4 d-flex align-items-center">
            <i class="fa fa-user me-2"></i> Ajouter un Fournisseur
        </h3>

        <!-- Formulaire -->
        <form action="{{ route('fournisseur.store') }}" method="post">
            @csrf
            <div class="row g-3">
                <!-- Nom et Prénom -->
                <div class="col-md-6">
                    <label for="nom" class="form-label fw-semibold">Nom</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <input type="text" name="nom" id="nom" value="{{ old('nom') }}" 
                               class="form-control @error('nom') is-invalid @enderror" 
                               placeholder="Entrez le nom de la pharmacie">
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" 
                               class="form-control @error('email') is-invalid @enderror" 
                               placeholder="email@example.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Adresse -->
                <div class="col-md-6">
                    <label for="adresse" class="form-label fw-semibold">Adresse</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                        <input type="text" name="adresse" id="adresse" value="{{ old('adresse') }}" 
                               class="form-control @error('adresse') is-invalid @enderror" 
                               placeholder="adresse">
                        @error('adresse')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Téléphone -->
                <div class="col-md-6">
                    <label for="telephone" class="form-label fw-semibold">Téléphone</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                        <input type="number" name="telephone" id="telephone" value="" 
                               class="form-control @error('telephone') is-invalid @enderror" 
                               placeholder="Numéro">
                        @error('telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
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
