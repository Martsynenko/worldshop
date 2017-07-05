<?php

require_once 'connect.php';

$data = query('SELECT * FROM `db_post` ORDER BY `date` DESC');

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
    <script>
        function confirmDelete() {
            if (confirm("Do you confirm the deletion?")) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</head>
<body>
<div id="wrapp">
    <div class="btn-new">
        <a href="edit.php" target="_parent">Add new post</a>
    </div>
    <?php for($i = 0;$i < count($data); $i++): ?>
        <?php
        $date_array = $data[$i]['date'];
        $date_array = explode(' ', $date_array);
        $day = $date_array[0];
        $time = mb_substr($date_array[1], 0, -3);
        $text = $data[$i]['text'];
        $text = mb_substr($text, 0, 300).'...';
        ?>
    <div class="post-item">
        <h2><?=$data[$i]['title']?></h2>
        <p class="date"><?=$day?> в <?=$time?></p>
        <p><?=htmlspecialchars_decode($text)?></p>
        <a href="/worldshop/post.php?id=<?=$data[$i]['id']?>" target="_parent">Read more</a>
        <div class="btn-action">
            <a href="edit.php?id=<?=$data[$i]['id']?>" target="_parent" class="btn-edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Edit</a>
            <a href="index.php?action=delete&id=<?=$data[$i]['id']?>" target="_parent" class="btn-delete" onclick="return confirmDelete();"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>Delete</a>
        </div>
    </div>
    <?php endfor; ?>
</div>
</body>