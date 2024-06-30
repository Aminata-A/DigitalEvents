<x-navbar-admin/>
<div class="container mt-5">
    <div class="profile-header">
        <div class="col-12 col-md-6">
            <h1>Bienvenue</h1>
            <h1>{{ auth()->user()->name }}!</h1>
        </div>
        <div class="col-12 col-md-6">
            <img src="{{ asset('admin/img/group.png') }}" alt="Background Image">
        </div>
    </div>
    <div class="boites">
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="stat-card">
                    <h2>{{ $validatedAssociationsCount }}</h2>
                    <p>association(s) validée(s)</p>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="stat-card">
                    <h2>{{ $pendingAssociationsCount }}</h2>
                    <p>associations en attente</p>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="stat-card">
                    <h2>{{ $usersCount }}</h2>
                    <p>utilisateur(s)</p>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="stat-card">
                    <h2>{{ $eventsCount }}</h2>
                    <p>événement(s)</p>
                </div>
            </div>
        </div>
    </div>
</div>