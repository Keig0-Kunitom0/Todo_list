<?php session_start();?>
<?php require './header.php';?>
<?php require './menu.php';?>
    <hr>
<?php
    $pdo=new PDO('mysql:host=127.0.0.1;dbname=todolist;charset=utf8;unix_socket=/tmp/mysql.sock',
    'dbuser', 'password');
    if (isset($_SESSION['user'])){
        $id=$_SESSION['user']['id'];
        $sql=$pdo->prepare('select * from users where id!=? and login=?');
        $sql->execute([$id,$_POST['login']]);
    } else {
        $sql=$pdo->prepare('select * from users where login=?');
        $sql->execute([$_POST['login']]);
    }

    if(empty($sql->fetchAll())){
        if((isset($_SESSION['user']))){
            $sql=$pdo->prepare('update users set name=?,login=?,password=? where id=?');
            $sql->execute([$_POST['name'],$_POST['login'],$_POST['password'],$id]);
            $_SESSION['user']=[
                'id'=>$id,'name'=>$_POST['name'],
                'login'=>$_POST['login'],'password'=>$_POST['password']
            ];
        echo 'お客様情報を更新しました。';
        } else {
            $sql=$pdo->prepare('insert into users values(null,?,?,?)');
            $sql->execute([
                $_POST['name'],$_POST['login'],$_POST['password']
            ]);
            echo 'お客様情報を登録しました。';
        }
    } else {
        echo 'ログイン名がすでに使用されていますので、変更してください。';
    }
?>
<?php require './footer.php';?>