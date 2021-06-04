<?php
    if (!function_exists('donate_proj')) require_once("project.php");
    if (!function_exists('edit_follow_list')) require_once("member_info.php");

    if(isset($_POST['id']) and isset($_POST['money']))
    {
        $result_proj = donate_proj($_POST['id'], $_POST['money']);
        $result_follow = edit_follow_list($_POST['id'], true);

        if(!$result or !$result_follow) echo "fail";
        else echo "success";
    }
    
?>