<x-navbar-admin/>
<div class="container mt-5">
    <h1 class="mb-4">Role : {{ $role->name }}</h1>
    <a href="{{ route('roles.index') }}" class="btn btn-secondary mb-3">Retour</a>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card p-4">
        <form action="{{ route('role.permissions.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Permissions</label>
                @foreach ($permissions as $permission)
                    <div class="col-md-5">
                        @error('permission')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <label for="">
                            <input 
                            type="checkbox"
                            name="permission[]" 
                            value="{{ $permission->name }}" 
                            {{ in_array($permission->id, $rolePermission) ? 'checked':''}}
                            />
                            {{ $permission->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <div>
                <button type="submit" class="btn " style="border-color: #FF8200; background:#FF8200; color:white;">Modifier</button>
            </div>
        </form>
    </div>
</div>