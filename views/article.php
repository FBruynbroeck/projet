<div class="container">
    <img class="rounded-circle img-thumbnail" src="/downloads/<?= $item->image ? $item->image : 'missing.png' ?>" alt="Card image cap" style="max-width:200px">
    <h2>Prix</h2>
    <div><?=$item->price ?> €</div>
    <h2>Description</h2>
    <div><?=$item->description ?></div>
</div>
<?php if($item->valid): ?>
<button class="btn btn-info add_cart" id="<?= $item->id?>">Ajouter au panier</button>
<?php else:?>
<div>l'article n'est plus disponible...</div>
<?php endif?>
