<div class="container">
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="idid">Identifiant</label>
            <input type="text" class="form-control" id="idid" name="id" value="<?= $item->id?>" readonly>
        </div>
        <div class="form-group">
            <label for="title">Titre de l'article</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $item->title?>">
        </div>
        <div class="form-group">
            <label for="price">Prix</label>
            <input type="number" min="0" step="any" class="form-control" id="price" name="price" value="<?= $item->price?>">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="<?= $item->description?>">
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <br>
            <img class="rounded-circle img-thumbnail" src="/downloads/<?= $item->image ? $item->image : 'missing.png' ?>" alt="Card image cap" style="max-width:200px">
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
