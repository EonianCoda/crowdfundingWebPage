<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Shortcut Icon" type="image/x-icon" href="../images/icon.png" />
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/util.css">
    <link rel="stylesheet" href="../styles/basis.css">
    <link rel="stylesheet" href="../js/swiper/swiper-bundle.min.css">
    <script src="../js/swiper/swiper-bundle.min.js"></script>
    <script src="../js/jquery-3.6.0.js"></script>
    <script src="../js/all.js"></script>
    <script src="../js/nav.js"></script>
    <title>修改密碼 | Achieve</title>
</head>


<body>
    <header class="headerpage">
    </header>
    <div class="member_nav">
    </div>
    <?php
        if (!function_exists('edit_password')) require_once('../backend/member_info.php');
        if (!function_exists('edit_password_alert')) require_once('../backend/alert.php');

        if(isset($_POST['oldpassword']) AND (isset($_POST['newpassword'])))
        {
            $status_code = edit_password($_POST['oldpassword'], $_POST['newpassword']);
            edit_password_alert($status_code);
        }
    ?>
    <div class="container member">
        <h3>修改密碼</h3>
        
        <form method ="POST" action="editpassword.php">
            請輸入舊密碼:
            <input class="form-input" type="password"  name="oldpassword" placeholder="請輸入舊密碼" value="" required> <br>
            請輸入新密碼:
            <input class="form-input" type="password"  name="newpassword" placeholder="請輸入新密碼" value="" required> <br>
            再輸入新密碼:
            <input class="form-input" type="password"  name="newpassword2" placeholder="再輸入新密碼" value="" required> <br>
            <button class="button w-100"type="submit" >確定修改</button>
        </form>
    </div>

    <footer class="footerpage">
    </footer>
</body>
</html>
