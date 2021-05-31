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
    <title>Document</title>
</head>
<body>
    <header class="headerpage">
    </header>
    <div class="member_nav">
    </div>
    <?php
        if (!function_exists('get_personal_info')) require_once("../backend/member_info.php");
        if (!function_exists('edit_password_alert')) require_once('../backend/alert.php');


        if(isset($_POST['username']) and isset($_POST['realname']) and isset($_POST['useremail']) and isset($_POST['phone_number']))
        {
            $status_code = edit_profile($_POST, $_FILES);
            edit_profile_alert($status_code);
        }
        $user_data = get_personal_info();
    ?>  
    <div class="container member">
        <h3>個人資料</h3>
        <form method ="POST" action="setting.php" enctype="multipart/form-data">
            <div class="horizon-items vertical-start">

                    <div class="image-container w-50 .p-r-100" style="max-height: 25em;">
                        <img id="myphoto" src= "<?php get_personal_img($user_data); ?>" style="max-width: 20em; max-height:20em;">
                        <input id="imgfile" type="File" name="photo">
                        <script type="text/javascript">
                        $(function() {
                            $("#imgfile").change(function() {
                            var readFile = new FileReader();
                            var mfile = $("#imgfile")[0].files[0];  
                            readFile.readAsDataURL(mfile);
                            readFile.onload = function() {
                                var img = $("#myphoto");
                                img.attr("src", this.result);
                            }
                            });
                        })
		                </script>
                    </div>
                    <div class="p-l-50 w-50">
                            帳號名稱:
                            <input class="form-input" type="text"  name="username" placeholder="帳號名稱"  maxlength="20" value="<?php echo $user_data['username']; ?>" required> <br>
                            真實名稱:
                            <input class="form-input" type="text"  name="realname" placeholder="真實名稱" maxlength="10" value="<?php echo $user_data['realname']; ?>" required> <br>
                            電子信箱:
                            <input class="form-input" type="email" name="useremail" placeholder="註冊信箱" maxlength="50" value="<?php echo $user_data['useremail']; ?>" required> <br>
                            電話號碼:
                            <input class="form-input" type="text" name="phone_number" maxlength="12" onkeyup="value=value.replace(/[^\d#]/g,'')" placeholder="手機" value="<?php echo $user_data['phone_number']; ?>" required> <br>
                            <button class="button w-100">儲存修改</button>
                    </div>
            </div>
        </form>
    </div>

    <footer class="footerpage">
    </footer>
</body>
</html>
