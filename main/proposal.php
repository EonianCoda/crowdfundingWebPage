<!DOCTYPE html>
<html lang="zh-tw">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Achieve is Crowdfunding platform in Asia, which the goal is helping people make their dream come true.  Achieve 是一個群眾集資平台。立志於幫助人們實現夢想。">
    <meta name="keywords" content="crowdfunding, platform, dream, help">
    <meta name="author" content="楊雲翔">
    <meta property="og:site_name" content="Achieve">
    <meta property="og:locale" content="zh_TW">
    <meta property="og:title" content="關於我們 | Achieve">
    <meta property="og:description" content="Achieve is Crowdfunding platform in Asia, which the goal is helping people make their dream come true.  Achieve 是一個群眾集資平台。立志於幫助人們實現夢想。">
    <meta property="og:image" content="./images/achieve.png">
    <meta property="og:type" content="website">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>關於我們 | Achieve</title>
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
    <section class="bottom-divider p-t-40 p-b-40">
        <form method="POST" enctype="multipart/form-data">
            <div class="container horizon-items" >
                <div class="w-60 m-r-30 horizon-center vertical-center prop">
                    <input id="myfile" type="file"><br/>
		            <img src="" id="show" width="100%">
		            <script type="text/javascript">
			        $(function() {

                        $("#myfile").change(function() {
                        var readFile = new FileReader();
                        var mfile = $("#myfile")[0].files[0];  //注意這裡必須時$("#myfile")[0]，document.getElementById('file')等價與$("#myfile")[0]
                        readFile.readAsDataURL(mfile);
                        readFile.onload = function() {
                            var img = $("#show");
                            img.attr("src", this.result);
                        }
                        });

                    })
		</script>
                </div>
                <div class="w-40 vertical-items">
                    <div class="prop">
                        <textarea class="textarea_input" name="prop-name">這裡填入你的募款名稱
                        </textarea>
                    </div>
                    <div class="prop">
                        <p class="vertical-divider-thick"> 
                            <textarea class="textarea_input" name="prop-intro">為你的專案簡短介紹
                            </textarea>
                        </p>
                    </div>
                    <div class="horizon-items prop">
                        <input class="form-input" type="text" name="prop-objectname" placeholder="提案人" required> <br>
                    </div>
                    <div class="horizon-items prop">
                            <input class="form-input" type="number" name="prop-price" placeholder="募款金額" required> <br>
                    </div>
                    <button class="button"> 完成表單</button>
                </div>
            </div>
        </form>
    </section>


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
            圖片1: <input type="file" name="prop-img2"accept="image/gif, image/jpeg, image/png"><br>
            圖片2: <input type="file" name="prop-img3" accept="image/gif, image/jpeg, image/png"><br>
            圖片3: <input type="file" name="prop-img4" accept="image/gif, image/jpeg, image/png"><br>
            圖片4: <input type="file" name="prop-img5" accept="image/gif, image/jpeg, image/png"><br>
            圖片5: <input type="file" name="prop-img6" accept="image/gif, image/jpeg, image/png"><br>
            <br>
            <textarea class="textarea_input" name="prop-content1">產品的詳細內容
            </textarea>
            <textarea class="textarea_input" name="prop-content2">聯絡方式
            </textarea>
        </div>

    </div>
    <footer class="footerpage">
    </footer>
</body>
</html>