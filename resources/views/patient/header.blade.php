<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/patient.css">
    <title>Document</title>
</head>
<body>



<!-- Navbar Mobile -->
<nav class="navbar navbar-dark bg d-md-none">
    <div class="container-fluid">
        <a class="navbar-brand" href="/patient/interface">
            🏥 Espace Patient
        </a>

        <button class="navbar-toggler" type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#patientMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<!-- Menu Mobile -->
<div class="offcanvas offcanvas-start bg " tabindex="-1" id="patientMenu">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-white">🏥 Espace Patient</h5>

        <button type="button" class="btn-close"
            data-bs-dismiss="offcanvas">
        </button>
    </div>

    <div class="offcanvas-body ">
        <ul class="nav flex-column ">

            <li class="nav-item mb-2 ">
                <a href="{{route('rdv.show')}}" class="nav-link text-white">
                    📅 Mes Rendez-vous
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{route('resultat.index')}}" class="nav-link text-white">
                    🧪 Mes Résultats
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{route('mes_demande.show')}}" class="nav-link text-white">
                    📋 Mes Demandes
                </a>
            </li>

            <li class="nav-item mt-4">
                <form method="POST" action="{{ route('patient.logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">
                         Déconnexion
                    </button>
                </form>
            </li>

        </ul>
    </div>
</div>

<div class="d-flex">

    <!-- Sidebar Desktop -->
    <div class="sidebar d-none bg d-md-block">
        <div class="p-3">

            <h4 class="text-white text-center mb-4">
                <a href="{{route('interface.index')}}"
                    class="text-white text-decoration-none">
                    🏥 Espace Patient
                </a>
            </h4>

            <ul class="nav flex-column">

                <li class="nav-item mb-2">
                    <a href="{{route('rdv.show')}}"
                        class="nav-link nvl text-white">
                        📅 Mes Rendez-vous
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{route('resultat.index')}}"
                        class="nav-link nvl text-white">
                        🧪 Mes Résultats
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{route('mes_demande.show')}}"
                        class="nav-link nvl text-white">
                        📋 Mes Demandes
                    </a>
                </li>

                <li class="nav-item mt-4">
                    <form method="POST"
                        action="{{ route('patient.logout') }}">
                        @csrf
                        <button type="submit"
                            class="btn btn-danger w-100">
                            🚪 Déconnexion
                        </button>
                    </form>
                </li>

            </ul>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="main-content flex-grow-1">
        <!-- Votre contenu -->
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>