<!DOCTYPE html>
<html lang="zh-tw">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Achieve is Crowdfunding platform in Asia, which the goal is helping people make their dream come true.  Achieve 是一個群眾集資平台。立志於幫助人們實現夢想。">
    <meta name="keywords" content="crowdfunding, platform, dream, help">
    <meta name="author" content="楊雲翔">
    <meta property="og:site_name" content="Achieve">
    <meta property="og:locale" content="zh_TW">
    <meta property="og:title" content="提案 | Achieve">
    <meta property="og:description" content="Achieve is Crowdfunding platform in Asia, which the goal is helping people make their dream come true.  Achieve 是一個群眾集資平台。立志於幫助人們實現夢想。">
    <meta property="og:image" content="./images/achieve.png">
    <meta property="og:type" content="website">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>提案 | Achieve</title>
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
        if (!function_exists('authentication')) require_once('../backend/account.php');
        if (!function_exists('new_proposal')) require_once('../backend/project.php');
        if (!function_exists('new_proposal_alert')) require_once('../backend/alert.php');
        only_for_members();

        if(isset($_POST['name']))
        {
            $status_code = new_proposal();
            new_proposal_alert($status_code);
        }
    ?>
    <form method="POST" action="proposal.php" enctype="multipart/form-data">
        <div class="bottom-divider p-t-40 p-b-40 maxh-1000">
                <div class="container horizon-items h-32em" >
                    <div class="w-60 m-r-30 horizon-center vertical-center prop">
                        <input id="myfile" type="file" name="main_img" required><br/>
                        <img class="maxh-1000"src="" id="show" width="100%">
                        <script type="text/javascript">
                        $(function() {
                            $("#myfile").change(function() {
                            var readFile = new FileReader();
                            var mfile = $("#myfile")[0].files[0]; 
                            readFile.readAsDataURL(mfile);
                            readFile.onload = function() {
                                var img = $("#show");
                                img.attr("src", this.result);
                            }
                            });

                        })
                        </script>
                    </div>
                    <div class="w-40 vertical-items h-100">
                        <div class="prop h-15">
                            <input class ="form-input h-90" type="text" maxlength=20 placeholder= "募款名稱" name="name" required> </input>
                        </div>
                        <select class="mt-2 mb-3 prop p-l-20 h-10" 
                            name="category" >
                            <option selected>請選擇專案類別...</option>
                            <option value=1> 設計 </option>
                            <option value=2> 音樂 </option>
                            <option value=3> 教育 </option>
                            <option value=4> 科技 </option>
                            <option value=5> 生活 </option>
                        </select>

                        <div class="prop h-30">
                            <textarea type="text" placeholder="為你的專案簡短介紹" class="form-input h-90 p-t-15" name="intro" maxlength="200" required></textarea>
                        </div>
                        <div class="horizon-items prop h-20 wrap">
                            <label class=" p-l-5">募款結束日期</label>
                                <input class="form-input h-50" type="date" name="end_date" required> <br>
                        </div>
                        <div class="horizon-items prop h-10">
                                <input class="form-input h-90" type="text" name="goal_money" onkeyup="value=value.replace(/[^\d]/g,'')" placeholder="募款金額" required> <br>
                        </div>
                        <button class="button h-10"> 完成表單</button>
                    </div>
                </div>
            
        </div>


        <div>
            <div class="w-100 bg-block bottom-divider horizon-center">
                <div class="horizon-between w-50 p-t-20 p-b-20">
                    <a href="./content.php?q=content"> 專案內容</a>
                    <a href="./content.php?q=qa"> 常見問題</a>
                </div>
            </div>
        </div>
        <div class="container horizon-center m-t-20 ">
            <div>
                圖片1: <input type="file" name="intro_img1"accept="image/gif, image/jpeg, image/png"><br>
                圖片2: <input type="file" name="intro_img2" accept="image/gif, image/jpeg, image/png"><br>
                圖片3: <input type="file" name="intro_img3" accept="image/gif, image/jpeg, image/png"><br>
                圖片4: <input type="file" name="intro_img4" accept="image/gif, image/jpeg, image/png"><br>
                圖片5: <input type="file" name="intro_img5" accept="image/gif, image/jpeg, image/png"><br>
                <br>
                    <textarea type="text" class="form-input h-90p p-t-15" placeholder="詳細規格" name="content" maxlength="200"></textarea>
                    <textarea type="text" class="form-input h-90p p-t-15" placeholder="聯絡資訊" name="contact" maxlength="200"></textarea>
            </div>
            
        </div>
        
    </form>
    <footer class="footerpage">
    </footer>
</body>
</html>