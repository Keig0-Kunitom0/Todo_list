<?php session_start(); ?>
<?php require './header.php';?>
<?php require './menu.php';?>
    <hr>
<?php
    unset($_SESSION['user']);
    $pdo=new PDO('mysql:host=127.0.0.1;dbname=todolist;charset=utf8;unix_socket=/tmp/mysql.sock',
                'dbuser', 'password');
    $sql=$pdo->prepare('select * from users where login=? and password=?');
    $sql->execute([$_POST['login'],$_POST['password']]);
    
    foreach ($sql as $row) {
        $_SESSION['user']=[
            'id'=>$row['id'],'name'=>$row['name'],
            'login'=>$row['login'],'password'=>$row['password']];
    }

    if(isset($_SESSION['user'])){
        echo 'いらっしゃいませ、',$_SESSION['user']['name'],'さん。';
    } else {
        echo 'ログイン名またはパスワードがちがいます。';
    }
?>
<?php require './footer.php';?>