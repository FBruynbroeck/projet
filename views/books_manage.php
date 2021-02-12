<div id="accordion">
    <?php foreach($books as $book):?>
    <div class="card bg-light">
        <div class="card-header" id="heading<?=$book->id?>">
            <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?=$book->id?>" aria-expanded="true" aria-controls="collapse<?=$book->id?>">
                    Commande n° <?=$book->id?> <span class="badge badge-secondary"><?=$book->status->name?></span>
                </button>
            </h5>
        </div>

        <div id="collapse<?=$book->id?>" class="collapse" aria-labelledby="heading<?=$book->id?>" data-parent="#accordion">
            <div class="card-body">
                Client: <?= $book->user->login?>
                <br>
                Statut de la commande: <?= $book->status->name?>
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th scope="col">Article</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($book->items as $item):?>
                        <tr>
                            <th scope="row"><?=$item->title?></th>
                            <td><?=$item->price?> €</td>
                            <td>
                                <a href="/article/<?= $item->title?>" class="col btn btn-primary">Détail</a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                        <tr class="table-dark">
                            <th scope="row">Total</th>
                            <td><?=$book->total()?> €</td>
                            <?php if($book->status->id == ATTENTE): ?>
                            <td class="row">
                                <a href="/admin/<?= $book->id?>/validate_book" class="col btn btn-success">Valider la commande</a>
                                <a href="/admin/<?= $book->id?>/cancel_book" class="col btn btn-danger">Annuler la commande</a>
                            </td>
                            <?php else: ?>
                            <td>
                            </td>
                            <?php endif ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endforeach?>
</div>
