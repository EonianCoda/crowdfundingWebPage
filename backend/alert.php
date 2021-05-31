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

    function edit_profile_alert($status_code)
    {
        switch($status_code)
        {
            case 0:
                alert_message("修改成功!");
                break;
            case 1:
                alert_message("帳號名稱重複");
                break;
            case 2:
                alert_message("圖片名稱過長(最多30字)");
                break;
            default:
                alert_message("不明錯誤");
                break;
        } 
    }
    function new_proposal_alert($status_code)
    {
        switch($status_code)
        {
            case 0:
                alert_message("新增成功!");
                break;
            case 1:
                alert_message("未選擇類別");
                break;
            case 2:
                alert_message("結束時間不可早於現在");
                break;
            case 3:
                alert_message("圖片名稱過長(最多30字)");
                break;
            case 4:
                alert_message("目標金額格式錯誤");
                break;
            case 5:
                alert_message("請先登入後再進行此操作");
                break;
            case 6:
                alert_message("專案名稱已被定義");
                break;
            default:
                alert_message("不明錯誤");
                break;
        } 
    }
?>