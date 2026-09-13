<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Patient</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background: linear-gradient(135deg,#0d6efd,#0b5ed7);
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            font-family:'Segoe UI',sans-serif;
        }

        .login-card{
            width:100%;
            max-width:450px;
            background:white;
            border-radius:20px;
            padding:35px;
            box-shadow:0 15px 40px rgba(0,0,0,.15);
        }

        .logo{
            font-size:60px;
            text-align:center;
            margin-bottom:10px;
        }

        .title{
            text-align:center;
            font-weight:700;
            margin-bottom:30px;
            color:#0d6efd;
        }

        .form-control{
            border-radius:12px;
            padding:12px;
        }

        .btn-login{
            border-radius:12px;
            padding:12px;
            font-weight:600;
        }
    </style>
</head>
<body>

<div class="login-card">

    <div class="logo">
        🏥
    </div>

    <h3 class="title">Espace Patient</h3>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('patient.login.submit') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email"
                   name="email"
                   class="form-control"
                   required>
        </div>

        <div class="mb-4">
            <label class="form-label">Mot de passe</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   required>
        </div>

        <button type="submit"
                class="btn btn-primary btn-login w-100">
            Se connecter
        </button>

    </form>

</div>

</body>
</html>