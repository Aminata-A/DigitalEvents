<x-navbar-admin/>
<div class="container mt-4">
    <h2>Utilisateurs</h2>
    <div class="search-bar ">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <input type="text" class="form-control d-inline-block" placeholder="role">
        <button class="btn btn-ajout d-inline-block">Filtrer</button>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="responsive-mobile">Id</th>
                <th class="responsive-mobile">Nom complet</th>
                <th>Adresse email</th>
                <th>Rôles</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td class="responsive-mobile">{{ $user->id }}</td>
                <td class="responsive-mobile">{{ $user->name}} </td>
                <td><a href="{{ route('users.show', $user->id) }}">{{ $user->email }}</a></td>
                <td ><span >
                    @if (!@empty($user->getRoleNames()))
                        @foreach ($user->getRoleNames() as $rolename)
                            <label for="" class="badge mx-1 text-white" style="border: 1px solid #FF8200; background:#FF8200; color :white; font-weight:500; padding:2px 5px">{{ $rolename }}</label>
                        @endforeach 
                    @endif    
                </span></td>
                <td class="action">
                    <a href="{{ route('users.edit', $user->id) }}">
                        <button class="btn btn-modifier">
                            <span class="btn-text">Modifier</span>
                            <span class="btn-icon"><img src="{{ asset('admin/img/edit.svg') }}" alt="edit icone"></span>
                        </button>
                    </a>
                    
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-supprimer">
                            <span class="btn-text">Supprimer</span>
                            <span class="btn-icon"><img src="{{ asset('admin/img/delete.svg') }}" alt="delete icone"></span>
                        </button>
                    </form>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>