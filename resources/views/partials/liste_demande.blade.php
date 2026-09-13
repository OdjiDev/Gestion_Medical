@include('include.header')
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
        <i class="fa fa-ban me-2"></i>
        <div class="flex-grow-1">
            {{ session('delete') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

    </div>

    <div class="col-md-3 text-end">
        <a class="btn bg-gradient-primary-custom btn-sm text-white" href="/demande">
             <i class="fa fa-plus mb-1"></i> Demande
        </a>
    </div>

</div>

<div class=" card shadow mb-4">
    <div class=" row card-header ">

     <div class="col-md-6">
        <h1 class="mb-0 text-pr"><i class=""></i>Demande de rendez vous</h1>
</div>

<!-- <div class="col-md-2">
    <a class="btn btn-primary btn-sm " href="/demande">
            <i class="fa fa-plus mb-1"></i> Demande
        </a>

    </div> -->
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="bg-primary text-white">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom  </th>
                                        <th scope="col">Service</th>
                                        <th scope="col">Motif</th>
                                        <th scope="col">Date du RDV</th>
                                        <th scope="col">Sythome</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                   
                                </thead>
                                <tbody>
@foreach ($demandes as $demande)
    <tr>
        <th scope="row">
            {{ $demandes->firstItem() + $loop->index }}
        </th>

        <td>
            {{ $demande->patient->nom ?? 'Inconnu' }}
        </td>

        <td>
            {{ $demande->service->type_service ?? 'Aucun service' }}
        </td>
        <td>
            {{ $demande->motif?? 'Aucun motif' }}
        </td>

        <td>
            {{ $demande->date }}
        </td>
        <td title="{{ $demande->contenu }}">
    {{ Str::limit($demande->contenu, 10) }}
</td>

        <td>
    @if($demande->status == 'valide')
        <span class="badge bg-success">Validé</span>

    @elseif($demande->status == 'rejete')
        <span class="badge bg-danger">Rejeté</span>

    @else
        <span class="badge bg-warning text-dark">En attente</span>
    @endif
</td>
        <td>
            <a type="button" class="btn btn-sm btn-info" href="{{route('demande.show',$demande->id)}}" ><i class="fa fa-eye "></i></a>
            <a type="button" class="btn btn-sm btn-success" href="{{route('demande.valide',$demande->id)}}" ><i class="fa fa-check-circle "></i></a>
            <a type="button" class="btn btn-sm btn-danger" href="{{route('demande.rejete',$demande->id)}}" ><i class="fa fa-ban "></i></a>
           
        </td>
    </tr>
@endforeach
</tbody>
    </table>
    </div>
    </div>
  
@include('include.footer')