<?php
    if (!function_exists('edit_watch_list')) require_once("member_info.php");

    if(isset($_POST['id']) and isset($_POST['status']))
    {
        edit_watch_list($_POST['id'], $_POST['status']);
    }
?>