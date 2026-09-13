@include('include.header')

<div class="container my-5">
    <div class="card shadow-sm rounded-4 p-4">
        <!-- Header -->
        <h3 class="text-pr fw-bold mb-4 d-flex align-items-center">
            <i class="fa fa-user me-2"></i> Ajouter un Utilisateur
        </h3>

        <!-- Formulaire -->
        <form action="{{ route('users.store') }}" method="post">
            @csrf
            <div class="row g-3">
                <!-- Nom et Prénom -->
                <div class="col-md-6">
                    <label for="name" class="form-label fw-semibold">Nom et Prénom</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" 
                               class="form-control @error('name') is-invalid @enderror" 
                               placeholder="Entrez votre nom complet">
                        @error('name')
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
                        <input type="number" name="telephone" id="telephone" value="{{ old('telephone') }}" 
                               class="form-control @error('telephone') is-invalid @enderror" 
                               placeholder="Numéro">
                        @error('telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Rôle -->
              <div class="col-md-6">
    <label for="role" class="form-label fw-semibold">Rôle</label>

    <select name="role" id="role" class="form-select @error('role') is-invalid @enderror">

        <option disabled selected>Choisir un rôle</option>

       @foreach($roles as $role)
    <option value="{{ $role }}">
        {{ ucfirst($role) }}
    </option>
@endforeach

    </select>

    @error('role')
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
