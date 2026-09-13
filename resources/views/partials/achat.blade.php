@include('include.header')
<div class="container-fluid ">
    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"></h1>
                        <a href="{{ route('vente.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-shopping-cart fa-sm text-white-50"></i> Vente </a>
                    </div> -->

                                  <div class="row align-items-center mb-3">

   

     <div class="col-md-9">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3 d-flex align-items-center mb-0" role="alert">
                <i class="fa fa-check-circle me-2"></i>
                <div class="flex-grow-1">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
@if(session('delete'))
    <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded-3 d-flex align-items-center mb-0" role="alert">
        <i class="fa fa-trash me-2"></i>
        <div class="flex-grow-1">
            {{ session('delete') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

    </div>

    <div class="col-md-3 text-end">
        <a class="btn bg-gradient-primary-custom text-white btn-sm" href="{{ route('achat.create')}}">
           <i class="fa fa-plus me-1"></i> Achat 
        </a>
    </div>

</div>

                    <div class=" card shadow mb-4">
    <div class=" row card-header ">

     <div class="col-md-6">
    <h1 class="mb-0 text-pr">
        <i class="fas fa-shopping-cart"></i> Achat
    </h1>
</div>
  <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="bg-primary text-white">
            <tr>
                <!-- <th>#</th> -->
                <th>Référence</th>
                <th>Fournisseur</th>
                <th>Total (FCFA)</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($achats as $acht)
           
           
                <tr>

                    
                    <td>{{$acht->reference}}</td>
                    <td>{{$acht->fournisseur->nom}}</td>
                    <td>{{$acht->total}}</td>

                    <td>{{$acht->created_at}}</td>
                    <td>
                        <a type="button" class="btn btn-sm btn-info" href=" {{ route('achat.show', $acht->id) }}" ><i class="fa fa-eye "></i></a>
                        <!-- <a type="button" class="btn btn-sm btn-secondary" href="" ><i class="fa fa-print "></i></a> -->
                        <a type="button" class="btn btn-sm btn-warning " href="{{ route('achat_items.edit', $acht->id) }}" ><i class="fa fa-edit"></i></a>
                        <a href="#" class="btn btn-sm btn-danger btn-delete-user" data-bs-toggle="modal" data-bs-target="#staticBackdropdelete"
                                                class="color-danger"> <i class="fa fa-trash "></i></a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="staticBackdropdelete" data-bs-backdrop="static"
                                                data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="staticBackdropLabeldelete" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered ">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0 pb-0">
                                                            <h5 class="modal-title fw-bold text-danger"
                                                                id="staticBackdropLabel">
                                                                <i class="fa fa-trash me-2"></i> Confirmer la
                                                                suppression
                                                            </h5>

                                                        </div>
                                                        <form action="" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                        <div class="modal-body text-center py-4">
                                                            <div class="mb-3">
                                                                <i class="fa fa-exclamation-triangle text-warning"
                                                                    style="font-size: 40px;"></i>
                                                            </div>
                                                            <p class="fs-5 mb-0">
                                                               Êtes-vous sûr de vouloir supprimer l'achat ?
                                                            </p>
                                                            <!-- <small class="text-muted">
                                                                Cette action
                                                            </small> -->
                                                        </div>

                                                        <div class="modal-footer border-0 justify-content-center">
                                                            <button type="button" class="btn btn-light px-4"
                                                                data-bs-dismiss="modal">
                                                                Annuler
                                                            </button>
                                                            <button type="submit" class="btn btn-danger px-4">
                                                                <i class="fa fa-trash me-1"></i> Supprimer
                                                            </button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                </td>
                </tr>
                
         @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        
    </div>
</div>
</div>
</div>

@include('include.footer')