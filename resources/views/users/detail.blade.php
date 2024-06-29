<x-navbar-admin/>
<div class="container detail-container">
    <div class="profile-header">
        <div class="col-12 col-md-6 mt-5">
            <h1>Profile Admin</h1>
            <img src="{{ Storage::url('public/logos/' . $user->logo) }}" alt="Background Image" class="responsive-img" style="margin-left: -13rem">
        </div>
        <div class="col-12 col-md-6">
            <img src="{{ asset('admin/img/group.png') }}" alt="Background Image">
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6 col-sm-12">
            <h4>{{ $user->name }}</h4>
            <p><img src="{{ asset('admin/img/location.svg') }}" alt="icone location"> {{ $user->adress }}</p>
            <p><img src="{{ asset('admin/img/phone.svg') }}" alt="icone phone"> {{ $user->phone }}</p>
            <p><img src="{{ asset('admin/img/mail.svg') }}" alt="icone mail"> {{ $user->email }}</p>
        </div>
        <div class="col-md-6 col-sm-12">
            <h4>Etat de la validation du compte : {{ $user->validation_status }}</h4>
            <div class="boutons">
                <form action="{{ route('user.validate', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn status-button success">Valider</button>
                </form>
                <form action="{{ route('user.invalidate', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn status-button failed">Invalider</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <h4>A propos</h4>
            <p>{{ $user->description }}</p>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6 col-sm-12">
            <h4>Statut du compte: {{ $user->account_status }}</h4>
            <div class="boutons">
                <form action="{{ route('user.activate', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn status-button success">Activer</button>
                </form>
                <form action="{{ route('user.deactivate', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn status-button failed">Désactiver</button>
                </form>
            </div>
        </div>
    </div>
</div>
