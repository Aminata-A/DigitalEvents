<x-navbar-admin/>
    <div class="container mt-5">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <h1 class="mb-4 titre-edit">Mettre à jour le rôle du user {{ $user->name}}</h1>
        <a href="{{ route('users.index') }}" class="btn btn-secondary mb-3">Retour</a>
        <div class="card p-4">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Roles</label>
                    <select name="roles[]" class="form-control" multiple>
                        <option value="">Choisir un rôle</option>
                        @foreach ($roles as $role)
                            <option 
                                value="{{ $role }}"
                                {{ in_array($role, $userRole) ? 'selected':'' }}
                            >
                                {{ $role }}
                        </option>
                        @endforeach
                    </select>
                    @error('roles')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="btn" style="border-color: #FF8200; background:#FF8200; color:white;" >Modifier</button>
                </div>
            </form>
        </div>
    </div>