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
        <i class="fa fa-trash me-2"></i>
        <div class="flex-grow-1">
            {{ session('delete') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

    </div>
    <div class="col-md-3 text-end">
        <a class="btn bg-gradient-primary-custom text-white btn-sm" href="{{ url('ajout_patient') }}">
            <i class="fa fa-user-plus  me-1"></i> Patient
        </a>
    </div>
</div>

<div class=" card shadow mb-4">
    <div class=" row card-header ">

     <div class="col-md-6">
        <h1 class="mb-0 text-pr"><i class="fa fa-users me-1"></i>Patients</h1>
</div>

 <div class="col-md-6 d-flex justify-content-end">
                
                <form action="{{ route('patient.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text"
                            name="q"
                            class="form-control bg-white border-0 small"
                            placeholder="Rechercher un patient..."
                            value="{{ request('q') }}">

                        <div class="input-group-append">
                            <button class="btn bg-gradient-primary-custom text-white" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

            </div>
           
<div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="bg-primary text-white">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Telephone</th>
                                       <!-- <th class="w-25 text-truncate">Adresse</th> -->
                                        <th scope="col">Sexe</th>
                                        <th scope="col">dossier</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                 <tbody>
                                    @foreach($patients as $p)
                                    <tr>
                                        <th scope="row">{{ $patients->firstItem() + $loop->index }}</th>
                                        <th>{{$p->nom}}</th>
                                        <th>{{$p->email}}</th>
                                        <th>{{$p->telephone}}</th>
                                        <!-- <th>{{$p->adress}}</th> -->
                                        <th>{{$p->sexe}}</th>
                                        <th>{{$p->n_dossier}}</th>
                                        <th>
                                            <!-- /patient/{{$p->id}}/pdf <a href="/interface_patient/{{$p->id}}/show" type="button" class="btn btn-sm btn-success"><i class="fa fa-eye "></i></a> -->
                                    <a href="#"
   class="btn btn-sm btn-success"
   data-bs-toggle="modal"
   data-bs-target="#sendPdfModal{{$p->id}}">
    <i class="fa fa-paper-plane"></i>
</a>

<div class="modal fade" id="sendPdfModal{{$p->id}}" tabindex="-1">
  <div class="modal-dialog">

    <div class="modal-content">

      <form method="POST"
            action="{{ route('patient.send', $p->id) }}"
            enctype="multipart/form-data">

        @csrf

        <div class="modal-header">
          <h5 class="modal-title">Envoyer un PDF</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          <!-- NOM DOCUMENT -->
          <div class="mb-3">
            <label>Nom du document</label>
            <input type="text" name="nom" class="form-control" required>
          </div>

          <!-- DEMANDE AJOUTÉE ICI -->
         <div class="mb-3">
  <label class="form-label">Choisir la demande</label>

  <select name="demande_id" class="form-select" required>
      <option value="">-- Choisir une demande --</option>

      @foreach($p->demandes as $demande)
          <option value="{{ $demande->id }}">
              Demande #{{ $demande->id }}
              @if(isset($demande->created_at))
                  - {{ $demande->created_at->format('d/m/Y') }}
              @endif
          </option>
      @endforeach
  </select>
</div>
          <!-- FICHIER -->
          <div class="mb-3">
            <label>Fichier PDF</label>
            <input type="file" name="fichier" class="form-control" accept="application/pdf" required>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Annuler
          </button>

          <button type="submit" class="btn btn-success">
            Envoyer
          </button>
        </div>

      </form>

    </div>

  </div>
</div>
                                            <a href="/edit_patient/{{$p->id}}/edit" type="button" class="btn btn-sm btn-warning"><i class="fa fa-edit "></i></a>

                                            <a href="#" type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdropdelete" ><i class="fa fa-trash"></i></a>

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
                                                        <form action="{{route('patient.delete', $p->id)}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                        <div class="modal-body text-center py-4">
                                                            <div class="mb-3">
                                                                <i class="fa fa-exclamation-triangle text-warning"
                                                                 style="font-size: 40px;"></i>
                                                            </div>
                                                            <p class="fs-5 mb-0">
                                                               Êtes-vous sûr de vouloir supprimer le patient ?
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
                                        </th>
                                        

                                     </tr>
                                     @endforeach
                                 </tbody>
                                  </table>
                                 <div class="">
    {{ $patients->links() }}
</div>
                        </div>
                                </div>
                                </div>


@include('include.footer')