@include('include.header')

<div class="container my-5">
    <div class="card shadow-sm rounded-4 p-4">
      
        <h3 class="text-pr fw-bold mb-4 d-flex align-items-center">
            <i class="fa fa-calendar-alt me-2"></i> Ajouter une demande
        </h3>

        <!-- Formulaire -->
        <form action="{{ route('demande.store') }}" method="post">
            @csrf
            <div class="row g-3">
                <!-- Nom et Prénom -->
                <div class="col-md-6">
                    <label for="telephone" class="form-label fw-semibold">N° telephone</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <input type="text" name="telephone" id="telephone" value="{{ old('telephone') }}"
       class="form-control @error('telephone') is-invalid @enderror">

@error('telephone')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                    </div>
                </div>

                
                <!-- objet -->
                <div class="col-md-6">
                     <label for="service" class="form-label fw-semibold">Services</label>

    <select name="service_id" id="service" class="form-select @error('service_id') is-invalid @enderror">
    <option selected disabled>Choisir un service</option>
    @foreach($services as $service)
        <option value="{{ $service->id }}">
            {{ ucfirst($service->type_service) }}
        </option>
    @endforeach
    
</select>
                </div>
                
                <div class="col-md-6">
                    <label for="date" class="form-label fw-semibold">Date du rendez vous</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                        <input type="date" name="date" id="date" value="{{ old('date') }}"
       class="form-control @error('date') is-invalid @enderror">

@error('date')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                    </div>
                </div>
                <!-- Les Services: Pédiatrie, maternité, Echographie, etc... -->
                     <!-- Les Motifs: Vaccination, consultation, hospitalisation etc... -->
                <div class="col-md-6">
                    <label for="date" class="form-label fw-semibold">Motif</label>
                    <div class="input-group">
                        <select name="motif" id="motif" class="form-select @error('motif') is-invalid @enderror">
    <option selected disabled>Choisir</option>
    
           @foreach($motifs as $motif)

        <option value="{{ $motif }}"
            {{ old('motif') == $motif ? 'selected' : '' }}>

            {{ ucfirst($motif) }}

        </option>

    @endforeach
   
    
</select>
                    </div>
                </div>
                <!-- <div class="col-md-6">
                     <label for="service" class="form-label fw-semibold">Service</label>

    <select name="service_id" id="service" class="form-select @error('service_id') is-invalid @enderror">
    <option selected disabled>Choisir un service</option>

    
</select>
                </div> -->


                <div class="mb-3">

    <label for="contenu" class="form-label fw-semibold">Symptôme</label>
    <textarea name="contenu" id="contenu"  value="{{ old('contenu') }}"
    class="form-control @error('contenu') is-invalid @enderror"></textarea>
    @error('contenu')
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
