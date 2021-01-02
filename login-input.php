<?php require './header.php';?>
<?php require './menu.php';?>
    <hr>
    <form action="login-output.php" method="POST">
        ログイン名<input type="text" name="login"><br>
        パスワード<input type="password" name="password"><br>
        <input type="submit" value="ログイン">
    </form>
<?php require './footer.php';?>