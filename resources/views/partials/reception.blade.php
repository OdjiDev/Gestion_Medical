@include('include.header')


<!-- Header -->

<div class="container-fluid">

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
@role('admin|user')
    <div class="col-md-3 text-end">
        <a class="btn bg-gradient-primary-custom btn-sm text-white" href="{{ route('reception.create') }}">
            <i class="fa fa-plus me-1"></i> Ajouter
        </a>
    </div>
    @endrole

</div>






<div class=" card shadow mb-4">
    <div class=" row card-header ">

     <div class="col-md-6">
        <h1 class="mb-0 text-pr "><i class="fas fa-clipboard-list"></i>Réceptions</h1>
</div>

<div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col">Service</th>
                    <th scope="col">AMO</th>
                    @role('admin|user')
                    <th scope="col">Montant</th>
                    @endrole
                    <th scope="col">Date - Heure </th>
                    @role('admin|medecin|user')
                    <th scope="col">Status </th>
                    @endrole
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($receptions as $recep)
                <tr>
                <th>{{$recep->id}}</th>
                    <th>{{$recep->nom}}</th>
                    <th>{{$recep->prenom}}</th>
                    <th>{{$recep->telephone ?? 'Aucun numero' }}</th>
                   
                   <th>{{ $recep->service->type_service ?? 'Aucun service' }}</th>
                  
                    <th>
                        @if($recep->amo)
                        <span class="badge bg-success">Oui</span>
                        @else
                        <span class="badge bg-danger">Non</span>
                        @endif
                    </th>
                     @role('admin|user')
                    <th>{{$recep->montantPayer}} Fcfa</th>
                     @endrole
                    <th>{{$recep->created_at}}</th>
                   
                    <th>
                        
                    @if($recep->status == 'en_attente')
    <span class="badge bg-warning">En attente</span>

@elseif($recep->status == 'termine')
    <span class="badge bg-success">Terminé</span>

@else
    <span class="badge bg-success">
        {{$recep->status}}
    </span>
@endif
                    

                    </th>
            
                    <th>
                         @role('admin|medecin')
                                    <a type="button" class="btn btn-sm btn-success" href="{{route('reception.valide',$recep->id)}}" ><i class="fa fa-check-circle "></i></a>
                                
                                @endrole
                              
  @role('admin|user')
                        <a class="btn btn-sm btn-secondary" href="{{ route('ticket.print', $recep->id) }}">
    <i class="fa fa-print"></i>
</a>
                  
                        <a type="button" class="btn btn-sm btn-warning" href="/edit_reception/{{$recep->id}}/edit" >
                            <i class="fa fa-edit"></i>
                        </a>
                      

                     
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
                                                        <form action="{{route('reception.delete', $recep->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                        <div class="modal-body text-center py-4">
                                                            <div class="mb-3">
                                                                <i class="fa fa-exclamation-triangle text-warning"
                                                                    style="font-size: 40px;"></i>
                                                            </div>
                                                            <p class="fs-5 mb-0">
                                                               Êtes-vous sûr de vouloir supprimer ?
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
                                            
                                            @endrole
                    </th>
                </tr>
                @endforeach
            </tbody>

        </table>
        <!-- <div class="mt-3">
    
</div> -->

    </div>
    </div>
    </div>




    @include('include.footer')