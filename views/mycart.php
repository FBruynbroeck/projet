<table class="table table-light">
    <thead>
        <tr>
            <th scope="col">Titre</th>
            <th scope="col">Prix</th>
            <th scope="col">Quantité</th>
            <th scope="col">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($items as $item):?>
        <tr>
            <th scope="row"><?=$item->title?></th>
            <td><?=$item->price?> €</td>
            <td><input class="quantity" id="<?=$item->id?>" type="number" min="0" value="<?=$item->quantity?>"></td>
            <td><?=$item->total()?> €</td>
        </tr>
        <?php endforeach ?>
        <tr class="table-dark">
            <th scope="row">Total</td>
            <td></td>
            <td><?=$total_items?></td>
            <td><?=$total_prices?> €</td>
        </tr>
    </tbody>
</table>

<div class="container">
    <div class="row">
        <?php if(isset($_SESSION['login_id'])):?>
        <a href="/order" class="btn btn-info col-6">Commander</a>
        <?php else:?>
        <a href="/login" class="btn btn-info col-6">S'identifier pour commander</a>
        <?php endif?>
        <a href="" id="reload" class="btn btn-info d-none col-6">Reload</a>
    </div>
</div>
