@include('include.header')

<div class="container my-5">
    <div class="card shadow-sm rounded-4 p-4">
        <!-- Header -->
       
<div class="container-fluid">
     <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Service</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i>Ajouter</a> -->
                    </div>
        <form action="{{ route ('service.store') }}" method="post">
            @csrf
                     <div class="row g-3 m-auto">
                
                <!-- Nom  -->
                <div class="col-md-6">
                    <label for="name" class="form-label fw-semibold">Nom </label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <input type="text" name="type_service" id="type_service" value="{{ old('type_service') }}" 
                               class="form-control @error('type_service') is-invalid @enderror" 
                               placeholder="Nom du service">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!--  Prénom -->
                <div class="col-md-6">
                    <label for="tarif" class="form-label fw-semibold">Prix</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <input type="text" name="tarif" id="tarif" value="{{ old('tarif') }}" 
                               class="form-control @error('tarif') is-invalid @enderror" 
                               placeholder="tarif">
                        @error('tarif')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                

               

 <div class="mt-5 d-flex justify-content-end">
                <button type="button" class="btn btn-outline-secondary me-2 rounded-3" onclick="history.back()">Annuler</button>
                <button type="submit" class="btn btn-success rounded-3">
                <i class="fas fa-save me-1"></i> Enregistrer
                </button>

   
   </div>
</div>
</form>
</div>
</div>


<!-- include('include.footer') -->