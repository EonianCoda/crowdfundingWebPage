<?php 
    if (!function_exists('authentication')) require_once("account.php");
    function alert_message($msg)
    {
        echo "<script type='text/javascript'>";
        echo sprintf("alert('%s');", $msg);
        echo "</script>";
    }
    function register_alert($status_code)
    {
        switch($status_code)
        {
            case 0:
                alert_message("註冊成功");
                break;
            case 1:
                alert_message("重複的帳號名稱");
                break;
            default:
                alert_message("不明錯誤");
                break;
        } 
    }

    function login_alert($status_code)
    {
        switch($status_code)
        {
            case 0:
                //login success and then jump
                echo "<script type='text/javascript'>";
                echo "window.location.href= '../main/index.php'";
                echo "</script>";
                break;
            case 1:
            case 2:
                alert_message("找不到此帳號或密碼錯誤");
                break;
            default:
                alert_message("不明錯誤");
                break;
        } 
    }

    function edit_password_alert($status_code)
    {
        switch($status_code)
        {
            case 0:
                alert_message("修改密碼成功!");
                alert_message("請重新登入!");
                logout();
                //login success and then jump
                echo "<script type='text/javascript'>";
                echo "window.location.href= '../main/login.php'";
                echo "</script>";
                break;
            case 1:
                alert_message("原密碼不相符");
                break;
            default:
                alert_message("不明錯誤");
                break;
        } 
    }
?>