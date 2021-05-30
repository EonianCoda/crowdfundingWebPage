<!DOCTYPE html>
<html lang="zh-tw">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Achieve is Crowdfunding platform in Asia, which the goal is helping people make their dream come true.  Achieve 是一個群眾集資平台。立志於幫助人們實現夢想。">
    <meta name="keywords" content="crowdfunding, platform, dream, help">
    <meta name="author" content="楊雲翔">
    <meta property="og:site_name" content="Achieve">
    <meta property="og:locale" content="zh_TW">
    <meta property="og:title" content="註冊 | Achieve">
    <meta property="og:description" content="Achieve is Crowdfunding platform in Asia, which the goal is helping people make their dream come true.  Achieve 是一個群眾集資平台。立志於幫助人們實現夢想。">
    <meta property="og:image" content="./images/achieve.png">
    <meta property="og:type" content="website">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>註冊 | Achieve</title>
    <link rel="Shortcut Icon" type="image/x-icon" href="../images/icon.png" />
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/util.css">
    <link rel="stylesheet" href="../styles/basis.css">
    <script src="../js/jquery-3.6.0.js"></script>
    <script src="../js/all.js"></script>
</head>
<body>
    <header class="headerpage">
    </header>
    <?php
        require_once('../backend/account.php');
        require_once('../backend/alert.php');
        if(isset($_POST['username']) AND (isset($_POST['password'])) AND (isset($_POST['realname'])) AND (isset($_POST['birthday'])) 
        AND isset($_POST['phone_number']) AND (isset($_POST['useremail'])))
        {
            $status_code = register($_POST);
            register_alert($status_code);
        }
    ?>

    <div class="container-fill">
        <div class="horizon-center m-t-60">
            <div class="vertical-items">
                <h1 class="text-center">註冊</h1>
                <form method="POST">
                    <input class="form-input" type="text"  name="username" placeholder="名稱" required> <br>
                    <input class="form-input" type="text"  name="realname" placeholder="真實名稱" required> <br>
                    <input class="form-input" type="email" name="useremail" placeholder="註冊信箱" required> <br>
                    <input class="form-input" type="password" name="password" placeholder="密碼" required> <br>
                    <input class="form-input" type="password" name="confirmedpassword" placeholder="密碼確定" required> <br>
                    <input class="form-input" type="text" onkeyup="value=value.replace(/[^\d]/g,'')" name="phone_number" placeholder="手機" required><br>
                    <input class="form-input" type="date" name="birthday" required><br>
                    <label>
                        <input  type="checkbox" name="remeber"> </input>
                        同意我們的
                        <a href="./privacy.php">隱私政策</a>
                        <br>
                    </label>
                    <label>
                        <input  type="checkbox" name="remeber"> </input>
                        願意接收最新的熱門募資項目快訊
                    </label>
                    <button class="button w-100" type="submit">送出</button>
                </form>
            </div>
        </div>
    </div>
    <footer class="footerpage">
    </footer>
</body>
</html>