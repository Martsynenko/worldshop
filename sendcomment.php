<?php

require_once 'connect.php';

if(empty($_POST['name']) || (empty($_POST['text']))) {
    echo 'empty_name';
} elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    echo 'valid_email';
} else{

    $post_id = $_POST['post_id'];

    $name = $_POST['name'];
    $name = addslashes($name);
    $name = htmlspecialchars($name);
    $name = stripslashes($name);

    $email = $_POST['email'];
    $email = addslashes($email);
    $email = htmlspecialchars($email);
    $email = stripslashes($email);

    $text = $_POST['text'];
    $text = addslashes($text);
    $text = htmlspecialchars($text);
    $text = stripslashes($text);

    $date = date("Y-d-m H:i:s");
    $result = query("INSERT INTO `db_comments` (`name`, `email`, `text`, `date`, `post_id`) VALUES ('$name', '$email', '$text', '$date', $post_id)");

    $date_array = $date;
    $date_array = explode(' ', $date_array);
    $day = $date_array[0];
    $time = mb_substr($date_array[1], 0, -3);
    echo "<div class=\"comment-item\">
            <img src=\"images/noavatar.png\" alt=\"avatar\"/>
            <div class=\"comment-descr\">
                <span class='name'>$name</span>
                <span class='email'>$email</span>
                <p class=\"date\">$day в $time</p>
                <p>$text</p>
            </div>
        </div>";

}