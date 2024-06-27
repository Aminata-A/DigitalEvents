<x-navbar-admin/>
<div class="container mt-4">
    <h2>Permissions</h2>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="search-bar">
        <form action="{{ route('permissions.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control d-inline-block @error('name') is-invalid @enderror" name="name" placeholder="ajouter une permission" value="{{ old('name') }}"> 
        
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    
                @enderror
                <button type="submit" class="btn btn-ajout d-inline-block">Ajouter</button>
            </div>
            
        </form>
        
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
            <tr>
                <td>{{ $permission->id }}</td>
                <td>{{ $permission->name }}</td>
                <td class="action">
                    <a href="{{ route('permissions.edit', $permission->id) }}">
                        <button class="btn btn-modifier">
                            <span class="btn-text">Modifier</span>
                            <span class="btn-icon"><img src="{{ asset('admin/img/edit.svg') }}" alt="edit icone"></span>
                        </button>
                    </a>
                    <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-supprimer">
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