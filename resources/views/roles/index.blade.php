<x-navbar-admin/>
<div class="container mt-4">
    <h2>Rôles</h2>
    <div class="search-bar">
        <input type="text" class="form-control d-inline-block" placeholder="nom du role">
        <button class="btn btn-ajout d-inline-block">Ajouter</button>
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
            <tr>
                <td>1</td>
                <td>Admin</td>
                <td class="action">
                    <button class="btn btn-autoriser">
                        <span class="btn-text">octroyer des permissions</span>
                        <span class="btn-icon"><img src="{{ asset('admin/img/key.svg') }}" alt="key icone"></span>
                    </button>
                    <button class="btn btn-modifier">
                        <span class="btn-text">Modifier</span>
                        <span class="btn-icon"><img src="{{ asset('admin/img/edit.svg') }}" alt="edit icone"></span>
                    </button>
                    <button class="btn btn-supprimer">
                        <span class="btn-text">Supprimer</span>
                        <span class="btn-icon"><img src="{{ asset('admin/img/delete.svg') }}" alt="delete icone"></span>
                    </button>
                    
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Association</td>
                <td class="action">
                    <button class="btn btn-autoriser">
                        <span class="btn-text">octroyer des permissions</span>
                        <span class="btn-icon"><img src="{{ asset('admin/img/key.svg') }}" alt="key icone"></span>
                    </button>
                    <button class="btn btn-modifier">
                        <span class="btn-text">Modifier</span>
                        <span class="btn-icon"><img src="{{ asset('admin/img/edit.svg') }}" alt="edit icone"></span>
                    </button>
                    <button class="btn btn-supprimer">
                        <span class="btn-text">Supprimer</span>
                        <span class="btn-icon"><img src="{{ asset('admin/img/delete.svg') }}" alt="delete icone"></span>
                    </button>
                    
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>User</td>
                <td class="action">
                    <button class="btn btn-autoriser">
                        <span class="btn-text">octroyer des permissions</span>
                        <span class="btn-icon"><img src="{{ asset('admin/img/key.svg') }}" alt="key icone"></span>
                    </button>
                    <button class="btn btn-modifier">
                        <span class="btn-text">Modifier</span>
                        <span class="btn-icon"><img src="{{ asset('admin/img/edit.svg') }}" alt="edit icone"></span>
                    </button>
                    <button class="btn btn-supprimer">
                        <span class="btn-text">Supprimer</span>
                        <span class="btn-icon"><img src="{{ asset('admin/img/delete.svg') }}" alt="delete icone"></span>
                    </button>
                    
                </td>
            </tr>
        </tbody>
    </table>
</div>