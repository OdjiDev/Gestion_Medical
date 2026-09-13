@role('admin')
@include('include.header')
                <!-- End of Topbar -->
                 

                <!-- Begin Page Content -->
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
        <a class="btn bg-gradient-primary-custom text-white btn-sm" href="{{ url('Ajout_user') }}">
            <i class="fa fa-user-plus me-1"></i> Utilisateur
        </a>
    </div>

</div>

<div class=" card shadow mb-4">
    <div class=" row card-header ">

     <div class="col-md-6">
        <h1 class="mb-0 text-pr"><i class="fa fa-users me-1"></i>Utilisateurs</h1>
</div>
<div class="col-md-6 d-flex justify-content-end">
                
                <form action="{{ route('user.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text"
                            name="q"
                            class="form-control bg-white border-0 small"
                            placeholder="Rechercher..."
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
                                        <th scope="col">Role</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item)
                                    <tr>
                                        <th scope="row">{{ $users->firstItem() + $loop->index }}</th>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->telephone}}</td>
                                        <td>{{ $item->getRoleNames()->first() }}</td>
                                        <td>
                                            <a type="button" class="btn btn-sm btn-info" href="{{ route('users.show', $item->id) }}" ><i class="fa fa-eye "></i></a>
                                            <a type="button" class="btn btn-sm btn-warning " href="/edit_user/{{$item->id}}/edit" ><i class="fa fa-edit"></i></a>
                            
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
                                                        <form action="{{route('users.delete', $item->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
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
                           <div class="mt-3">
    {{ $users->links() }}
</div>
                        </div>


                        <!-- Page Heading -->

                    </div>
                    
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
          
                       <footer class="sticky-footer bg-white ">
                    <div class="container my-auto ">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Clinique 2026</span>
                        </div>
                    </div>
                    
                </footer>
                 
             
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
        </script>
        <script>
    setTimeout(function() {
        let alert = document.querySelector('.alert');
        if(alert){
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    }, 4000);
</script>

        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
@endrole