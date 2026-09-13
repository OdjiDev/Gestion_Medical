@include('include.header')

<div class="container my-5">
    <div class="card shadow-sm rounded-4 p-4">
        <!-- Header -->
       <h3 class="text-pr fw-bold mb-4 d-flex align-items-center">
    <i class="fa fa-user-edit me-2"></i> Modifier le compte patient
</h3>

        <!-- Formulaire -->
        <form action="{{ route('patient.update', $patient->id) }}" method="post">
             @csrf
            @method('PUT')
            <div class="row g-3">
                <!-- Nom et Prénom -->
                <div class="col-md-6"> 
                    <label for="nom" class="form-label fw-semibold">Nom et Prénom</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <input type="text" name="nom" id="nom" value="{{ old('nom',$patient->nom)}}" 
                               class="form-control @error('nom') is-invalid @enderror" 
                               placeholder="Entrez votre nom complet">
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
                        <input type="email" name="email" id="email" value="{{ old('email',$patient->email) }}" 
                               class="form-control @error('email') is-invalid @enderror" 
                               placeholder="email@example.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Password -->
                <div class="col-md-6">
                    <label for="password" class="form-label fw-semibold">Mots de passe </label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        <input type="password" name="password" id="password" value="{{ old('password') }}" 
                               class="form-control @error('password') is-invalid @enderror" 
                               placeholder="password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Téléphone -->
                <div class="col-md-6">
                    <label for="telephone" class="form-label fw-semibold">Téléphone</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                        <input type="tel" name="telephone" id="telephone" value="{{ old('telephone',$patient->telephone) }}" 
                               class="form-control @error('telephone') is-invalid @enderror" 
                               placeholder="Numéro">
                        @error('telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- adresse -->
                <div class="col-md-6">
                    <label for="adresse" class="form-label fw-semibold">Adresse</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                        <input type="text" name="adress" id="adress" value="{{ old('adress',$patient->adress) }}" 
                               class="form-control @error('adress') is-invalid @enderror" 
                               placeholder="Adresse">
                        @error('adress')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 p-4">
    <label>Sexe :</label><br>

    <input type="radio" name="sexe" id="sexe_m" value="M"
        {{ old('sexe', $patient->sexe) == 'M' ? 'checked' : '' }}>
    <label for="sexe_m">Masculin</label>

    <input type="radio" name="sexe" id="sexe_f" value="F"
        {{ old('sexe', $patient->sexe) == 'F' ? 'checked' : '' }}>
    <label for="sexe_f">Féminin</label>

    @error('sexe')
        <div class="text-danger">{{ $message }}</div>
    @enderror
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

@include('include.footer')