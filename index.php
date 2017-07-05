<?php

require_once 'connect.php';

if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])){

    $id = $_GET['id'];

    query("DELETE FROM `db_post` WHERE `id` = '$id'");

    header('Location: index.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog WorldShop</title>
    <link rel="stylesheet" href="styles/styles.css"/>
    <link href="styles/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
</head>
<div id="header">
    <a href="index.php"><h1>Blog <span class="blue">World</span><span class="gray">Shop</span></h1></a>
</div>
<iframe src="content.php">
</iframe>
</html>