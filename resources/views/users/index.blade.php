<x-navbar-admin/>
<div class="container mt-4">
    <h2>Utilisateurs</h2>
    <div class="search-bar ">
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
            <tr>
                <td class="responsive-mobile">1</td>
                <td class="responsive-mobile">Mouhammad Ndour</td>
                <td>ndourmouhammad15@gmail.com</td>
                <td ><span style="border: 1px solid #FF8200; background:#FF8200; color :white; font-weight:500; padding:2px 5px">Admin</span></td>
                <td class="action">
                    
                    <button class="btn btn-modifier">
                        <span class="btn-text">Voir détails</span>
                        <span class="btn-icon"><img src="{{ asset('admin/img/eye1.svg') }}" alt="edit icone"></span>
                    </button>
                    <button class="btn btn-supprimer">
                        <span class="btn-text">Supprimer</span>
                        <span class="btn-icon"><img src="{{ asset('admin/img/delete1.svg') }}" alt="delete icone"></span>
                    </button>
                    
                </td>
            </tr>
            
        </tbody>
    </table>
</div>