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
                    <div class="w-60 m-r-30 horizon-center vertical-center prop border">
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
                    <div class="w-40 vertical-items h-100 ">
                        <div class="prop h-15">
                            <input class ="form-input h-90" type="text" maxlength=50 placeholder= "募款名稱" name="name" required> </input>
                        </div>
                        <div class="prop h-10" >
                            <select class="mt-2 mb-3 p-l-20 w-100 prop" 
                                name="category" >
                                <option value=1 selected> 設計 </option>
                                <option value=2> 音樂 </option>
                                <option value=3> 教育 </option>
                                <option value=4> 科技 </option>
                                <option value=5> 生活 </option>
                            </select>
                        </div>
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
                        <div class="horizon-center prop h-10">
                            <button class="button w-100"> 完成表單</button>
                        </div>
                    </div>
                </div>
            
        </div>


        <!-- <div>
            <div class="w-100 bg-block bottom-divider horizon-center">
                <div class="horizon-between w-50 p-t-20 p-b-20">
                    <a href="./content.php?q=content"> 專案內容</a>
                    <a href="./content.php?q=qa"> 常見問題</a>
                </div>
            </div>
        </div> -->
        <div class="container horizon-between m-t-20 ">
            <div class="vertical-items horizon-center m-t-20 w-70">
                    <h2>專案內容</h2>
                    <div class="w-100 h-200p">
                        <textarea type="text" class="form-input h-90p p-t-15" placeholder="專案內容" name="content" required></textarea>
                    </div>
                <div class="m-t-30">
                    <div class="prop horizon-center vertical-center border">
                        <input id="myfile1" type="file" name="intro_img1"><br/>
                        <img class="maxh-1000"src="" id="show1" width="100%">
                        <script type="text/javascript">
                        $(function() {
                            $("#myfile1").change(function() {
                            var readFile = new FileReader();
                            var mfile = $("#myfile1")[0].files[0]; 
                            readFile.readAsDataURL(mfile);
                            readFile.onload = function() {
                                var img = $("#show1");
                                img.attr("src", this.result);
                            }
                            });

                        })
                        </script>
                    </div>
                </div>
                <div class="m-t-30">
                    <div class="prop horizon-center vertical-center border">
                        <input id="myfile2" type="file" name="intro_img2"><br/>
                        <img class="maxh-1000"src="" id="show2" width="100%">
                        <script type="text/javascript">
                        $(function() {
                            $("#myfile2").change(function() {
                            var readFile = new FileReader();
                            var mfile = $("#myfile2")[0].files[0]; 
                            readFile.readAsDataURL(mfile);
                            readFile.onload = function() {
                                var img = $("#show2");
                                img.attr("src", this.result);
                            }
                            });

                        })
                        </script>
                    </div>
                </div>
                <div class="m-t-30">
                    <div class="prop horizon-center vertical-center border">
                        <input id="myfile3" type="file" name="intro_img3"><br/>
                        <img class="maxh-1000"src="" id="show3" width="100%">
                        <script type="text/javascript">
                        $(function() {
                            $("#myfile3").change(function() {
                            var readFile = new FileReader();
                            var mfile = $("#myfile3")[0].files[0]; 
                            readFile.readAsDataURL(mfile);
                            readFile.onload = function() {
                                var img = $("#show3");
                                img.attr("src", this.result);
                            }
                            });

                        })
                        </script>
                    </div>
                </div>
                <div class="m-t-30">
                    <div class="prop horizon-center vertical-center border">
                        <input id="myfile4" type="file" name="intro_img4"><br/>
                        <img class="maxh-1000"src="" id="show4" width="100%">
                        <script type="text/javascript">
                        $(function() {
                            $("#myfile4").change(function() {
                            var readFile = new FileReader();
                            var mfile = $("#myfile4")[0].files[0]; 
                            readFile.readAsDataURL(mfile);
                            readFile.onload = function() {
                                var img = $("#show4");
                                img.attr("src", this.result);
                            }
                            });

                        })
                        </script>
                    </div>
                </div>
                <div class="m-t-30">
                    <div class="prop horizon-center vertical-center border">
                        <input id="myfile5" type="file" name="intro_img5"><br/>
                        <img class="maxh-1000"src="" id="show5" width="100%">
                        <script type="text/javascript">
                        $(function() {
                            $("#myfile5").change(function() {
                            var readFile = new FileReader();
                            var mfile = $("#myfile5")[0].files[0]; 
                            readFile.readAsDataURL(mfile);
                            readFile.onload = function() {
                                var img = $("#show5");
                                img.attr("src", this.result);
                            }
                            });

                        })
                        </script>
                    </div>
                </div>
                <div class="horizon-between m-r-30">
                    <!-- <div class="w-40">
                        <h2>詳細規格</h2>
                        <div class="w-100 h-200p">
                        <textarea type="text" class="form-input h-90p p-t-15" placeholder="詳細規格" name="content" maxlength="200" required></textarea>
                        </div>
                    </div> -->
                    <div class="w-40">
                        <h2>聯絡資訊</h2>
                        <div class="w-100 h-200p">
                        <textarea type="text" class="form-input h-90p p-t-15" placeholder="聯絡資訊" name="contact" maxlength="200" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <footer class="footerpage">
    </footer>
</body>
</html>