<x-navbar-admin/>
<div class="container mt-5">
    <div class="profile-header" >
        <div class="col-12 col-md-6" >
            <h1>Profile Admin</h1>
        </div>
        <div class="col-12 col-md-6">
            <img src="{{ asset('admin/img/group.png') }}" alt="Background Image">
        </div>
    </div>
    <div class="profile-info mt-5">
        <h3>{{ $user->name }}</h3>
        <div class="contact-info">
            <span><img src="{{ asset('admin/img/phone.svg') }}" alt="icone phone" style="margin-right: 5px;">{{ $user->phone }}</span>
            <span><img src="{{ asset('admin/img/mail.svg') }}" alt="icone mail" style="margin-right: 5px;">{{ $user->email }}</span>
        </div>
        <button class="btn btn-outline btn-custom">Modifier profile</button>
    </div>
</div>