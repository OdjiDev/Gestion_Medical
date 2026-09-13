<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GESTION-MEDICALE</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">


    <!-- select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />



    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">

</head>





<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper" class="flex-grow-1 d-flex">


        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary-custom sidebar sidebar-dark accordion">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/index">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-hospital"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Clinique TERIYA<sup></sup></div>
            </a>

            @role('user|admin|medecin')
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="/index">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tableau de bord</span></a>
            </li>
            <hr class="sidebar-divider my-0">

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Accueil
            </div>
            @endrole
            @role('medecin|admin|user')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('reception.index') }}">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Réception</span>
                </a>
            </li>
            @endrole
            @role('admin')
            <li class="nav-item">
                <a class="nav-link" href="/service_medicale">
                    <i class="fas fa-briefcase-medical"></i>
                    <span>Services Médicaux</span></a>
            </li>
            @endrole
            <!-- <li class="nav-item">
    <a class="nav-link" href="#">
        <i class="fas fa-fw fa-vials"></i>
        <span>Examens Médicaux</span>
    </a>
</li> -->

            <!-- <li class="nav-item">
                <a class="nav-link" href="/rendez_vous">
                    <i class="fas fa-calendar-check"></i>
                    <span>Rendez Vous</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/liste_demande">
                    <i class="fas fa-list"></i>
                    <span>Demande RDV</span></a>
            </li> -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="/paiement">
                    <i class="fas fa-credit-card"></i>
                    <span>Paiement</span></a>
            </li> -->

            <!-- Divider -->

            @role('admin|medecin')
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                RDV
            </div>

            <li class="nav-item">
                <a class="nav-link" href="/patient">
                    <i class="fas fa-fw fa-user-injured"></i>
                    <span>Patient</span></a>
            </li>


            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#rdvMenu">
                    <i class="fas fa-calendar-check"></i>
                    <span>Rendez Vous</span>
                </a>

                <div id="rdvMenu" class="collapse">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('demande.index') }}">Rendez vous</a>
                    </div>
                </div>
            </li>
            @endrole
            <!-- Nav Item - Utilities Collapse Menu -->
            <!-- <li class="nav-item active">

    <a class="nav-link"
       href="#"
       data-bs-toggle="collapse"
       data-bs-target="#collapseUtilities"
       aria-expanded="true"
       aria-controls="collapseUtilities">

        <i class="fas fa-fw fa-wrench"></i>
        <span>Rendez Vous</span>

    </a>

    <div id="collapseUtilities"
         class="collapse show"
         aria-labelledby="headingUtilities">

        <div class="bg-white py-2 collapse-inner rounded">

            <h6 class="collapse-header">Custom Utilities:</h6>

            <a class="collapse-item" href="#">Colors</a>
            <a class="collapse-item" href="#">Borders</a>
            <a class="collapse-item" href="#">Animations</a>
            <a class="collapse-item active" href="#">Other</a>

        </div>

    </div>

</li> -->
            @role('pharmacien|admin')




            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Pharmacie
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pharmacieMenu">
                    <i class="fas fa-pills"></i>
                    <span>Pharmacie</span>
                </a>

                <div id="pharmacieMenu" class="collapse">
                    <div class="bg-white py-2 collapse-inner rounded">


                        <h6 class="collapse-header">Vente</h6>
                        <a class="collapse-item" href="{{ route('vente.index') }}"> ventes </a>
                        <!-- <a class="collapse-item" href="{{ route('vente.create') }}">Ajouter</a> -->


                        <!-- Médicament -->
                        <h6 class="collapse-header">Médicament</h6>
                        <a class="collapse-item" href="{{ route('medicament.index') }}">Liste des medicaments </a>
                        <!-- <a class="collapse-item" href="{{ route('m.create') }}">Ajouter</a>  -->

                        <!-- achat -->
                        <h6 class="collapse-header">Achat</h6>
                        <a class="collapse-item" href="{{route('achat.index')}}">Liste des achats </a>


                        <!-- Stock -->
                        <h6 class="collapse-header">Fournisseur</h6>
                        <a class="collapse-item" href="{{ route('fournisseur.index') }}">Fournisseur</a>


                        <!-- Stock -->
                        <!-- <h6 class="collapse-header">Stock</h6>
            <a class="collapse-item" href="">Voir Stock</a> -->

                        <!-- Vente -->

                    </div>
                </div>
            </li>
            @endrole

            <!-- Nav Item - Charts -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li> -->
            @role('admin')
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Utilisateur
            </div>


            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="/users">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Utilisateurs</span></a>
            </li>

            <div class="sidebar-heading">
                Parametre
            </div>
            <li class="nav-item">
                <a class="nav-link nvl" href="{{route('parametre.index')}}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Paramètre</span>
                </a>
            </li>
            @endrole
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <!-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        @auth
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>

                                <img class="img-profile rounded-circle" src="{{  auth()->user()->avatar
                                        ? asset('storage/avatars/'.auth()->user()->avatar).'?'.time() 
                                        : 'https://bootdey.com/img/Content/avatar/avatar7.png' }}">
                            </a>


                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('users.show', auth()->user()->id) }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Deconnection
                                    </button>
                                </form>
                            </div>
                        </li>
                        @else
                        <script>
                            window.location = "{{ route('login') }}";
                        </script>
                        @endauth
                    </ul>

                </nav>
                <!-- End of Topbar -->