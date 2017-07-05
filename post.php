<?php

require_once 'connect.php';

$id = $_GET['id'];

$data = query("SELECT * FROM `db_post` WHERE `id` = $id");

$comments = query("SELECT * FROM `db_comments` WHERE `post_id` = '$id' ORDER BY `date` DESC");
$count_comments = count($comments);



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
        $(function() {
            $("#send").click(function(){
                var name = $("#name").val();
                var email = $("#email").val();
                var text = $("#text").val();
                var post_id = <?=$id?>;
                $.ajax({
                    type: "POST",
                    url: "sendcomment.php",
                    data: {"name": name, "email": email, "text": text, "post_id": post_id},
                    cache: false,
                    success: function(data){
                        if(data == 'empty_name'){
                            $('p.error').css({'opacity': '1', 'transition': '1s'});
                        } else if(data == 'valid_email') {
                            $("p.error").css('opacity', '0');
                            $('p.valid_email').css({'opacity': '1', 'transition': '1s'});
                        } else {
                            $('#comments').prepend(data);
                            $("#name").val("");
                            $("#email").val("");
                            $("#text").val("");
                            $("p.no-comment").css('display', 'none');
                            $("span.count").text(function(index, value){
                                count = +value + +1;
                                return count;
                            });
                            $("p.error").css('opacity', '0');
                            $("p.valid_email").css('opacity', '0');
                        }
                    }
                });
                return false;

            });
        });
    </script>
</head>
<body>
<div id="header">
    <a href="index.php"><h1>Blog <span class="blue">World</span><span class="gray">Shop</span></h1></a>
</div>
<div id="wrapp">
    <div class="btn-new">
        <a href="index.php" target="_parent">Main page</a>
    </div>
    <div class="post">
        <h2><?=$data[0]['title']?></h2>
        <p><?=htmlspecialchars_decode($data[0]['text'])?></p>
    </div>
    <h3 class="title-comment">Add a comment</h3>
    <span id="resp"></span>
    <div class="form-comment">
        <p class="note">Fields marked as <span class="red">*</span> is required</p>
        <form method="post">
            <span id="resp"></span>
            <input type="hidden" name="post_id" value="<?=$id?>"/>
            <div class="group">
                <p class="error">This field can not be empty!</p>
                <div class="clear"></div>
                <label>
                    name<span class="red"> *</span>
                </label>
                <input type="text" id='name' name='name' maxlength="255" placeholder="Enter your name"/>
            </div>
            <div class="group">
                <p class="valid_email">Please enter valid email address!</p>
                <div class="clear"></div>
                <label for="email">
                    email<span class="red"> *</span>
                </label>
                <input type="email" id='email' name='email' maxlength="255" placeholder="Enter your email"/>
            </div>
            <div class="group textarea">
                <label for="text">
                    Comment<span class="red"> *</span>
                </label>
                <p class="error">This field can not be empty!</p>
                <div class="clear"></div>
                <textarea name="text" id="text"></textarea>
            </div>
            <div class="group">
                <input type="submit" value="Send comment" id="send"/>
            </div>
        </form>
    </div>
    <div class="clear"></div>
    <h3 class="title-comment">Comments ( <span class="count"><?=$count_comments?></span> )</h3>
    <div id="comments">
        <?php if(!empty($comments)): ?>
        <?php for($i = 0;$i < count($comments); $i++ ): ?>
        <?php
            $date_array = $comments[$i]['date'];
            $date_array = explode(' ', $date_array);
            $day = $date_array[0];
            $time = mb_substr($date_array[1], 0, -3);
        ?>
        <div class="comment-item">
            <img src="images/noavatar.png" alt="avatar"/>
            <div class="comment-descr">
                <span class="name"><?=$comments[$i]['name']?></span>
                <span class="email"><?=$comments[$i]['email']?></span>
                <p class="date"><?=$day?> в <?=$time?></p>
                <p><?=$comments[$i]['text']?></p>
            </div>
        </div>
        <?php endfor; ?>
        <?php else: ?>
            <p class="no-comment">No comments at this moment...</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>