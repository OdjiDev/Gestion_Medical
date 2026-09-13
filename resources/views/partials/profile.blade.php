@include('include.header')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header bg-gradient-primary-custom text-white">
                    <h4>Profil de {{ $user->name }}</h4>
                </div>
                
                <div class="card-body">

                    {{-- FORM AVATAR --}}
                  
                        <form id="avatarForm"
    action="{{ route('users.avatar', $user->id) }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="row">
    <div class="col-5">

        </div>

    <div class="col-6">
                        <div class="avatar-wrapper text-center">

                            {{-- IMAGE --}}
                            <img id="avatarPreview"
                                src="{{ $user->avatar 
                                        ? asset('storage/avatars/'.$user->avatar).'?'.time() 
                                        : asset('images/undraw_profile.svg') }}"
                                class="avatar-img">

                            {{-- INPUT FILE --}}
                            <div class="avatar-overlay mt-2">
                                <label for="avatarInput" class="btn btn-sm bg-gradient-primary-custom text-white">
                                    Modifier
                                </label>

                                <input type="file"
                                    id="avatarInput"
                                    name="avatar"
                                    accept="image/*"
                                    hidden
                                    onchange="autoSubmit(event)">
                            </div>

                        </div>
                        </div>
                        </div>
                    </form>

                    <hr>

                    {{-- INFOS USER --}}
                    <h5 class="mb-2 mt-5">Informations personnelles</h5>

                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item"><strong>Nom :</strong> {{ $user->name }}</li>
                        <li class="list-group-item"><strong>Email :</strong> {{ $user->email }}</li>
                        <li class="list-group-item"><strong>Téléphone :</strong> {{ $user->telephone ?? 'Non renseigné' }}</li>
                        <li class="list-group-item"><strong>Rôle :</strong> {{ $user->getRoleNames()->first()  ?? 'Role' }}</li>
                        <li class="list-group-item"><strong>Date :</strong> {{ $user->created_at->format('d/m/Y') }}</li>
                    </ul>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
function autoSubmit(event) {
    const input = event.target;

    if (input.files && input.files[0]) {

        const file = input.files[0];

        // ✔ Vérification type
        if (!file.type.startsWith('image/')) {
            alert("Veuillez choisir une image valide");
            return;
        }

        // ✔ Preview immédiat
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatarPreview').src = e.target.result;
        };
        reader.readAsDataURL(file);

        // ✔ Envoi auto
        document.getElementById('avatarForm').submit();
    }
}
</script>

@include('include.footer')