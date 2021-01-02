<?php session_start(); ?>
<?php require './header.php';?>
<?php require './menu.php';?>
    <hr>
<?php
    $name=$login=$password='';
    if (isset($_SESSION['user'])){
        $name=$_SESSION['user']['name'];
        $login=$_SESSION['user']['login'];
        $password=$_SESSION['user']['password'];
    }
    echo '<form action="customer-output.php" method="POST">';
    echo '<table>';
    echo '<tr><td>お名前</td><td>';
    echo '<input type="text" name="name" value="',$name,'">';
    echo '</td></tr>';
    echo '<tr><td>ログイン名</td><td>';
    echo '<input type="text" name="login" value="',$login,'">';
    echo '</td></tr>';
    echo '<tr><td>パスワード</td><td>';
    echo '<input type="password" name="password" value="',$password,'">';
    echo '</td></tr>';
    echo '</table>';
    echo '<input type="submit" value="確定">';
    echo '</form>';
?>
<?php require './footer.php';?>