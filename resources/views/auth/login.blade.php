<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Connexion</title>
    <link rel="stylesheet" href="/css/style.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        /* Reset basique */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Tahoma, sans-serif;
        }

        /* Responsive */
        @media (max-width: 400px) {
            .container {
                width: 90%;
                padding: 25px;
            }
        }

        /* Fond général */
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;

            background-image: url("img/login.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

            /* Effet sombre léger pour lisibilité */
            position: relative;
        }


        /* Container login */
        .container {
            background: #ffffff;
            padding: 30px 35px;
            width: 400px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 128, 128, 0.2);
            animation: fadeIn 0.8s ease-in-out;
        }

        /* Titre */
        .container h5 {
            text-align: center;
            font-size: 22px;
            margin-bottom: 25px;
            color: #00796b;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Champs */
        .email,
        .pass {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        label {
            font-size: 14px;
            color: #004d40;
            margin-bottom: 6px;
        }

        /* Inputs */
        input {
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #b2dfdb;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        /* Effet dynamique */
        input:focus {
            outline: none;
            border-color: #26a69a;
            box-shadow: 0 0 8px rgba(38, 166, 154, 0.4);
        }

        /* Animation d’apparition */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border-radius: 10px;
            border: none;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;

            background: linear-gradient(135deg, #26a69a, #00796b);
            color: #ffffff;

            transition: all 0.3s ease;
        }

        /* Hover */
        button:hover {
            background: linear-gradient(135deg, #2bbbad, #00695c);
            box-shadow: 0 8px 20px rgba(0, 121, 107, 0.4);
            transform: translateY(-2px);
        }

        /* Click */
        button:active {
            transform: scale(0.97);
        }

        /* Focus (accessibilité) */
        button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(38, 166, 154, 0.5);
        }

        h6 {
            padding: 10px;
            text-align: center;
        }

        a {
            text-decoration: none;
            color: #004d40;
        }

        a:hover {
            color: #55c2b5;
        }
    </style>
</head>

<body>

    <!-- @guest -->

    <div class="container">

        <h5>Connection</h5>

        <!-- Message session -->
        @if(session('status'))

        <div class="alert alert-success">
            {{ session('status') }}
        </div>

        @endif

        <!-- Formulaire -->
        <form method="POST" action="{{ route('login') }}">

            @csrf

            <!-- Email -->
            <div class="email">

                <label>
                    Email
                </label>

                <div class="input-group">



                    <input
                        type="text"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror"
                        required
                        autofocus>

                </div>

                @error('email')
                <div class="text-danger mt-1">
                    {{ $message }}
                </div>
                @enderror

            </div>

            <!-- Password -->
            <div class="pass">

                <label>
                    Mot de passe
                </label>

                <div class="input-group">


                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        required>

                </div>

                @error('password')
                <div class="text-danger mt-1">
                    {{ $message }}
                </div>
                @enderror

            </div>

            <!-- Remember me -->
            <!-- <div class="form-check mb-3">

            <input class="form-check-input"
                   type="checkbox"
                   name="remember"
                   id="remember_me">

            <label class="form-check-label" for="remember_me">
                Se souvenir de moi
            </label>

        </div> -->



            <!-- Bouton -->
            <button type="submit"
                class=" button btn btn-primary btn-login">

                <i class="fa fa-sign-in-alt me-1"></i>
                Connexion

            </button>

            <!-- Mot de passe oublié -->
            <h6>

                @if (Route::has('password.request'))
                <!-- 
                <a href="{{ route('password.request') }}"
                   class="text-decoration-none">

                    Mot de passe oublié ?

                </a> -->

                @endif

            </h6>

        </form>

    </div>
   
    <!-- @endguest -->
</body>

</html>