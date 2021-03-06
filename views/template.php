<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <!-- CSS -->
        <link rel="stylesheet" href="/public/bootstrap.min.css">
        <link rel="stylesheet" href="/public/sticky-footer-navbar.css">

        <!-- jQuery and JS bundle w/ Popper.js -->
        <script src="/public/jquery-3.5.1.min.js"></script>
        <script src="/public/bootstrap.bundle.min.js"></script>
        <script src="/public/cart.js"></script>
        <script src="/public/Chart.bundle.min.js"></script>
        <script src="/public/chart.js"></script>
        <title><?php echo $title; ?></title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="/"><?= TITLE; ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/articles">Articles</a>
                    </li>
                    <?=$menu?>
                </ul>
                <a href="/mycart" class="btn btn-primary">
                    Mon panier <span id="total_items" class="badge badge-light"/>
                </a>
<?php
if(isset($_SESSION['login_id'])){
    echo '<a href="/user" class="btn btn-outline-info my-2 my-sm-0">Mon compte</a>';
    echo '<a href="/logout" class="btn btn-outline-danger my-2 my-sm-0">Se déconnecter</a>';
}
else {
    echo '<a href="/login" class="btn btn-outline-success my-2 my-sm-0">Se connecter</a>';
}
?>
            </div>
        </nav>
        <main role="main" class="container">
<?php
if(!empty($_SESSION['message'])){
    echo '<div class="alert alert-info" role="alert">'.$_SESSION['message'].'</div>';
    unset($_SESSION['message']);
}
if(!empty($_SESSION['error'])){
    echo '<div class="alert alert-danger" role="alert">'.$_SESSION['error'].'</div>';
    unset($_SESSION['error']);
}
?>
<div class="jumbotron">
    <h1><?php echo $title; ?></h1>
    <?php echo $content; ?>
</div>
        </main>
        <footer class="footer">
            <div class="container">
                <span class="text-muted"><?= TITLE; ?></span>
            </div>
        </footer>
    </body>
</html>
