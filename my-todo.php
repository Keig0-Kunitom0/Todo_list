<?php session_start();?>
<?php require './header.php';?>
<?php require './menu.php';?>
    <hr>
    <h2>Todo一覧</h2>
    <form action="my-todo.php" method="POST">
        Todoを作成 <input type="text" name="title">
        <input type="submit" value="追加する">
    </form>
    <hr>
<?php 
    $id=$_SESSION['user']['id'];
    $pdo=new PDO('mysql:host=127.0.0.1;dbname=todolist;charset=utf8;unix_socket=/tmp/mysql.sock',
                'dbuser', 'password');
    $sql=$pdo->prepare('select * from todo where user_id =?');
    $sql->execute([$id]);
        foreach ($sql as $row){
            echo '<p>',$row['title'],'</p>';
            echo '<form action="my-todo.php" method="POST">';
            echo '<input type="hidden" name="id" value="',$row['id'],'">';
            echo '<input type="submit" value="削除">';
            echo '</form>';
            echo '<hr>';
        }
    if(!empty($_POST['title'])){
        if(isset($_POST['title'])){
        $sql=$pdo->prepare('insert into todo values(null,?,?)');
        $sql->execute([$id,$_POST['title']]);
        header("Location: " . $_SERVER['PHP_SELF']);
        } 
    }

    if(isset($_POST['id'])){
        $sql=$pdo->prepare('delete from todo where id=?');
        $sql->execute([$_POST['id']]);
        header("Location: " . $_SERVER['PHP_SELF']);
    }
?>
<?php require './footer.php';?>