<div class="container">
    <form method="post">
        <div class="form-group">
            <label for="title">Titre de l'article</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
            <label for="price">Prix</label>
            <input type="number" min="0" step="any" class="form-control" id="price" name="price">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description">
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
