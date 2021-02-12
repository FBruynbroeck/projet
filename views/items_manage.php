<table class="table table-light">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titre</th>
            <th scope="col">Prix</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($items as $item):?>
        <tr>
            <th scope="row"><?=$item->id?></th>
            <td><?=$item->title?></td>
            <td><?=$item->price?> €</td>
            <td>
                <div class="row">
                    <a href="/admin/<?=$item->title?>/edit_item" class="btn btn-outline-success">Editer</a>
                    <?php if($item->valid): ?>
                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modal<?= $item->id?>">
                        Supprimer
                    </button>
                    <?php else:?>
                    <a href="/admin/<?=$item->title?>/enable_item" class="btn btn-outline-success">Reactiver</a>
                    <?php endif?>
                    <div class="modal fade" id="modal<?= $item->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Supprimer l'article</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Voulez-vous vraiment supprimer l'article ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="/admin/<?=$item->title?>/delete_item" class="btn btn-outline-danger">Supprimer</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </td>

        </tr>
        <?php endforeach ?>
    </tbody>
</table>
