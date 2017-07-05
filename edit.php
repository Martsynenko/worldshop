<?php

require_once 'connect.php';

$notice = [];

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $data = query("SELECT `title`, `text` FROM `db_post` WHERE `id` = '$id'");
    $title = $data[0]['title'];
    $text = $data[0]['text'];
    $link_action = "/worldshop/edit.php?id=$id";
} else {
    $link_action = "/worldshop/edit.php";
}

if($_POST){

    $title = trim($_POST['title']);
    $title = strip_tags($title);
    $title = htmlspecialchars($title, ENT_QUOTES);
    $title = stripcslashes($title);

    $text = trim($_POST['text']);
    $text = htmlspecialchars($text, ENT_QUOTES);
    $text = stripcslashes($text);

    if(isset($id)){
        $bool = query("UPDATE `db_post` SET `title` = '$title', `text` = '$text' WHERE `id` = '$id'");
        $notice['update'] = 'Post successfully updated';
    } else {
        $date = date('Y:m:d H:i:s');
        $bool = query("INSERT INTO `db_post` (`title`, `text`, `date`) VALUES ('$title', '$text', '$date')");
        $notice['insert'] = 'Post successfully added!';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog WorldShop</title>
    <link rel="stylesheet" href="styles/styles.css"/>
    <link href="styles/bootstrap.min.css" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/summernote.min.js"></script>
    <script src="js/lang/summernote-ru-RU.js"></script>
    <script src="js/script.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>
<body>
<div id="header">
    <a href="/"><h1>Blog <span class="blue">World</span><span class="gray">Shop</span></h1></a>
</div>
<div id="wrapp">
    <h3 class="title-page">Add/Edit Post</h3>
    <div class="block-form">
        <form action="<?=$link_action?>" method="post">
            <?php if(isset($notice['update'])): ?>
            <p class="notice"><?=$notice['update']?></p>
            <?php elseif(isset($notice['insert'])): ?>
            <p class="notice"><?=$notice['insert']?></p>
            <?php endif; ?>
            <div class="group">
                <label>
                    Title post
                </label>
                <br>
                <input type="text" name="title" required maxlength="255" <?php if(isset($title)&&isset($id)): ?> value="<?=$title?>" <?php endif; ?> placeholder="Enter title post"/>
            </div>
            <div class="group">
                <label>
                    Text post
                </label>
                <br>
                <textarea rows="10" name="text" id="answer" required><?php if(isset($text)&&isset($id)): ?><?=$text?><?php endif; ?></textarea>
            </div>
            <div class="group btn-submit">
                <input type="submit" value="Save"/>
                <a href="index.php">Cancel</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>