<x-navbar-admin/>
<div class="container mt-4">
    <h2>Permissions</h2>
    <div class="search-bar">
        <input type="text" class="form-control d-inline-block" placeholder="nom de la permission">
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
                <td>add role</td>
                <td class="action">
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