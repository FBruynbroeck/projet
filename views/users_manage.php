<table class="table table-light">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Login</th>
            <th scope="col">Role</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user):?>
        <tr>
            <th scope="row"><?=$user->id?></th>
            <td><?=$user->login?></td>
            <td><?=$user->role->name?></td>
            <td>
                <div class="row">
                    <a href="/admin/<?=$user->login?>/edit_user" class="btn btn-outline-success">Editer</a>
                    <?php if($_SESSION['login_id'] != $user->id):?>
                    <?php if($user->valid): ?>
                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modal<?= $user->id?>">
                        Supprimer
                    </button>
                    <?php else:?>
                    <a href="/admin/<?=$user->login?>/enable_user" class="btn btn-outline-success">Reactiver</a>
                    <?php endif?>
                    <div class="modal fade" id="modal<?= $user->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Supprimer l'utilisateur</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Voulez-vous vraiment supprimer l'utilisateur ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="/admin/<?=$user->login?>/delete_user" class="btn btn-outline-danger">Supprimer</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php endif ?>
                </div>
            </td>

        </tr>
        <?php endforeach ?>
    </tbody>
</table>
