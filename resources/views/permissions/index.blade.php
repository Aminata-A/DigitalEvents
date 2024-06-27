<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Gestion des Permissions</title>
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
        <h2>Permissions</h2>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <div class="search-bar">
            <form action="{{ route('permissions.store') }}" method="POST" class="form-inline">
                @csrf
                <div class="form-group mb-2">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="ajouter une permission" value="{{ old('name') }}">
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
                @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td class="action">
                        <button class="btn btn-modifier" data-toggle="modal" data-target="#editPermissionModal" data-id="{{ $permission->id }}" data-name="{{ $permission->name }}">
                            <span class="btn-text">Modifier</span>
                            <span class="btn-icon"><img src="{{ asset('admin/img/edit.svg') }}" alt="edit icone"></span>
                        </button>
                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="d-inline" id="deleteForm">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-supprimer" onclick="if (confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) { document.getElementById('deleteForm').submit(); }">
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
    <div class="modal fade" id="editPermissionModal" tabindex="-1" role="dialog" aria-labelledby="editPermissionModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editPermissionModalLabel">Modifier la permission</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="editPermissionForm" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
              <div class="form-group">
                <label for="permission-name">Nom de la permission</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="permission-name" name="name" value="">
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
        $('#editPermissionModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id'); // Extract info from data-* attributes
            var name = button.data('name');
            
            var modal = $(this);
            modal.find('.modal-title').text('Modifier la permission ' + name);
            modal.find('.modal-body #permission-name').val(name);
            
            // Set the form action to the correct URL
            modal.find('form').attr('action', '/permissions/' + id);
        });
    });

    
    </script>
</body>
</html>
