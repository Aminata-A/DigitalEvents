<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Gestion des roles</title>
    <style>
        .form-inline .form-control {
            width: auto;
            flex: 1;
        }
        .btn-ajout {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <x-navbar-admin/>
    <div class="container mt-4">
        <h2>Rôles</h2>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        @if (session('error'))
   <div class="alert alert-danger">
       {{ session('error') }}
   </div>
   @endif
        <div class="search-bar">
            <form action="{{ route('roles.store') }}" method="POST" class="form-inline">
                @csrf
                <div class="form-group mb-2">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="ajouter un rôle" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-ajout mb-2">Ajouter</button>
            </form>
        </div>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td class="action">
                        <a href="{{ route('role.permissions', $role->id) }}">
                            <button class="btn btn-autoriser">
                                <span class="btn-text">octroyer des permissions</span>
                                <span class="btn-icon"><img src="{{ asset('admin/img/key.svg') }}" alt="key icone"></span>
                            </button>
                        </a>
                        <button class="btn btn-modifier" data-toggle="modal" data-target="#editroleModal" data-id="{{ $role->id }}" data-name="{{ $role->name }}">
                            <span class="btn-text">Modifier</span>
                            <span class="btn-icon"><img src="{{ asset('admin/img/edit.svg') }}" alt="edit icone"></span>
                        </button>
                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline">
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

    <!-- Modal -->
    <div class="modal fade" id="editroleModal" tabindex="-1" role="dialog" aria-labelledby="editroleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editroleModalLabel">Modifier la role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="editroleForm" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
              <div class="form-group">
                <label for="role-name">Nom du role</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="role-name" name="name" value="">
                @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-warning">Enregistrer les modifications</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#editroleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id'); // Extract info from data-* attributes
            var name = button.data('name');
            
            var modal = $(this);
            modal.find('.modal-title').text('Modifier la role ' + name);
            modal.find('.modal-body #role-name').val(name);
            
            // Set the form action to the correct URL
            modal.find('form').attr('action', '/roles/' + id);
        });
    });

    
    </script>
</body>
</html>
