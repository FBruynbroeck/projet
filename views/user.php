<div>
    Login: <?php echo $user->login?>
    <br>
    Email: <?php echo $user->email?>
    <br>
    <a href="/user/<?=$user->login?>/edit" class="btn btn-outline-success">Editer</a>
</div>
