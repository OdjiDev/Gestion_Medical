@include('include.header')

<div class="container-fluid">

    {{-- ALERTES --}}
    <div class="mb-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3 d-flex align-items-center">
                <i class="fa fa-check-circle me-2"></i>
                <div class="flex-grow-1">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('delete'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded-3 d-flex align-items-center">
                <i class="fa fa-trash me-2"></i>
                <div class="flex-grow-1">
                    {{ session('delete') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    {{-- HEADER --}}
    <div class="row align-items-center mb-3">
   

        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <a href="{{ url('ajouter_m') }}" class="d-none d-sm-inline-block btn btn-sm bg-gradient-primary-custom text-white shadow-sm"><i
                    class="fa fa-plus fa-sm text-white-50"></i> Ajouter</a>
        </div>
</div>
        <!-- <div class="col-md text-end">
        <a class="btn btn-success btn-sm" href="{{ url('ajouter_m') }}">
            <i class="fa fa-plus me-1"></i> Ajouter
        </a>
    </div> -->

    </div>
    <div class=" card shadow mb-4">
        <div class=" row card-header ">

            <div class="col-md-6">
                <h1 class="mb-0 text-pr">
                    <i class="fas fa-pills"></i> Stock des médicaments
                </h1>
            </div>

            <div class="col-md-6 d-flex justify-content-end">
                <!-- <form action="{{ route('medicament.search') }}" method="GET">
    <input type="text" name="q" class="form-control" placeholder="Rechercher un médicament...">
</form> -->
                <form action="{{ route('medicament.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text"
                            name="q"
                            class="form-control bg-white border-0 small"
                            placeholder="Rechercher un médicament..."
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
                            <th scope="col">Description</th>
                            <th scope="col">Quantite</th>
                            <th scope="col">Alerte</th>
                            <th scope="col">Prix d'achat</th>
                            <th scope="col">Prix de vente</th>
                            <th scope="col">Amo</th>
                            <th scope="col">Expiration</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($medicaments as $m)
                        <tr>
                            <th scope="row">{{ $medicaments->firstItem() + $loop->index }}</th>

                            <td>{{$m->nom}}</td>
                            <td>{{$m->description}}</td>
                            <td>{{$m->quantite}}</td>
                            <td>{{$m->quantite_alerte}}</td>
                            <td>{{$m->prix_achat}} FCFA</td>
                            <td>{{$m->prix_vente}} FCFA</td>
                            <th>
                        @if($m->amo == 1)
                        <span class="badge bg-success">Oui</span>
                        @else
                        <span class="badge bg-danger">Non</span>
                        @endif
                    </th>
                            <td>{{$m->date_expiration}}</td>
                            <td>
                                @if($m->quantite > $m->quantite_alerte)

                                <span class="badge bg-success">Disponible</span>

                                @elseif($m->quantite > 0 && $m->quantite <= $m->quantite_alerte)

                                    <span class="badge bg-warning text-dark">Stock faible</span>

                                    @else

                                    <span class="badge bg-danger">Rupture</span>

                                    @endif
                            </td>
                            <td>
                                <!-- <a type="button" class="btn btn-sm btn-info" href="" ><i class="fa fa-eye "></i></a> -->
                                <a class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addStock{{ $m->id }}"><i class="fa fa-exchange-alt"></i></a>

                                <div class="modal fade"
                                    id="addStock{{ $m->id }}"
                                    data-bs-keyboard="false"
                                    data-bs-backdrop="static"
                                    tabindex="-1">

                                    <div class="modal-dialog modal-dialog-centered">

                                        <form action="{{ route('medicament.addStock', $m->id) }}" method="POST">
                                            @csrf

                                            <div class="modal-content">

                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title">
                                                        Ajustement de stock
                                                    </h5>
                                                </div>

                                                <div class="modal-body">

                                                    <!-- TYPE -->
                                                    <div class="mb-3">
                                                        <label>Type d'opération</label>

                                                        <select name="type" class="form-select" required>
                                                            <option value="add">Ajouter</option>
                                                            <option value="remove">Réduire</option>
                                                        </select>
                                                    </div>

                                                    <!-- QUANTITE -->
                                                    <div class="mb-3">
                                                        <label>Quantité</label>

                                                        <input type="number"
                                                            name="quantite"
                                                            class="form-control"
                                                            required>
                                                    </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        Annuler
                                                    </button>

                                                    <button type="submit" class="btn btn-primary">
                                                        Valider
                                                    </button>
                                                </div>

                                            </div>

                                        </form>

                                    </div>
                                </div>


                                <a type="button" class="btn btn-sm btn-warning" href="/edit_m/{{$m->id}}/edit"><i class="fa fa-edit"></i></a>

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
                                            <form action="{{route('medicament.delete', $m->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <div class="modal-body text-center py-4">
                                                    <div class="mb-3">
                                                        <i class="fa fa-exclamation-triangle text-warning"
                                                            style="font-size: 40px;"></i>
                                                    </div>
                                                    <p class="fs-5 mb-0">
                                                        Êtes-vous sûr de vouloir supprimer l'utilisateur ?
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
                <div class="">
                    {{ $medicaments->links() }}
                </div>
            </div>


            <!-- Page Heading -->

        </div>

        <!-- /.container-fluid -->

    </div>

    



    @include('include.footer')