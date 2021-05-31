<?php
    function getcat($category){
        if($category===$_GET['category']){
            echo 'category-button-selected';
        }
        else{
            echo 'category-button';
        }
    }
    
?>
<!DOCTYPE html>
<html lang="zh-tw">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Achieve is Crowdfunding platform in Asia, which the goal is helping people make their dream come true.  Achieve 是一個群眾集資平台。立志於幫助人們實現夢想。">
    <meta name="keywords" content="crowdfunding, platform, dream, help">
    <meta name="author" content="楊雲翔">
    <meta property="og:site_name" content="Achieve">
    <meta property="og:locale" content="zh_TW">
    <meta property="og:title" content="探索 | Achieve">
    <meta property="og:description" content="Achieve is Crowdfunding platform in Asia, which the goal is helping people make their dream come true.  Achieve 是一個群眾集資平台。立志於幫助人們實現夢想。">
    <meta property="og:image" content="./images/achieve.png">
    <meta property="og:type" content="website">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>探索 | Achieve</title>
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

    <div class="container m-t-40 horizon-center vertical-items text-center">
        <h1>專案類別</h1>
        <div class="horizon-between vertical-center text-center m-t-45">
            <div class="vertical-items fg-1">
                <a href="./project.php?category=design" class="<?php getcat('design')?>"> 
                    <img src="../images/categoryIcon/design.png" height="100" width="100"> </img>
                    <p>設計<p>
                </a>
            </div>

            <div class="vertical-items fg-1">
                <a href="./project.php?category=music" class="<?php getcat('music')?>"> 
                    <img src="../images/categoryIcon/music.png" height="100" width="100"> </img>
                    <p>音樂<p>
                </a>
            </div>
            <div class="vertical-items fg-1">
                <a href="./project.php?category=education" class="<?php getcat('education')?>"> 
                    <img src="../images/categoryIcon/edu.png" height="100" width="100"> </img>
                    <p>教育<p>
                </a>
            </div>
            <div class="vertical-items fg-1">
                <a href="./project.php?category=technology" class="<?php getcat('technology')?>"> 
                    <img src="../images/categoryIcon/tech.png" height="100" width="100"> </img>
                    <p>科技<p>
                </a>
            </div>
            <div class="vertical-items fg-1">
                <a href="./project.php?category=life" class="<?php getcat('life')?>"> 
                    <img src="../images/categoryIcon/life.png" height="100" width="100"> </img>
                    <p>生活<p>
                </a>
            </div>
        </div>
    </div>

    <section class="container m-t-25 horizon-center">
    <div class="horizon-items wrap m0">
            <div class="project-object">
                <div class="image-container">
                    <img src="../images/product/chicken.jpg">
                </div>
                <div class="h-20">
                    <a href="../main/content.php">
                        <h3> [KMT] 韓寶，一款真正人性化的智能語音 | 能說能唱 一台就給全家好心情</h3>
                    </a>
                </div>
                <button type="button" class="button m-b-10">+關注</button>
                <div class="horizon-between top-divider">
                    <div class="horizon-items vertical-center">
                        <b>NT$ 2,900,500</b>
                        <p class="vertical-divider"> <b>300 %</b> </p>
                    </div>
                    <p>還剩40天</p>
                </div>
            </div>
            <div class="project-object">
                <div class="image-container">
                    <img src="../images/product/chicken.jpg">
                </div>
                <div class="h-20">
                    <a href="../main/content.php">
                        <h3> [KMT] 韓寶 </h3>
                    </a>
                </div>
                <button type="button" class="button m-b-10">+關注</button>
                <div class="horizon-between top-divider">
                    <div class="horizon-items vertical-center">
                        <b>NT$ 2,900,500</b>
                        <p class="vertical-divider"> <b>300 %</b> </p>
                    </div>
                    <p>還剩40天</p>
                </div>
            </div>
            <div class="project-object">
                <div class="image-container ">
                    <img src="../images/product/chicken.jpg">
                </div>
                <div class="h-20">
                    <a href="../main/content.php">
                        <h3> [KMT] 韓寶，一款真正人性化的智能語音 | 能說能唱 一台就給全家好心情ttttttttttttttttttttttttt</h3>
                    </a>
                </div>
                <button type="button" class="button m-b-10">+關注</button>
                <div class="horizon-between top-divider">
                    <div class="horizon-items vertical-center">
                        <b>NT$ 2,900,500</b>
                        <p class="vertical-divider"> <b>300 %</b> </p>
                    </div>
                    <p>還剩40天</p>
                </div>
            </div>
            <div class="project-object">
                <div class="image-container ">
                    <img src="../images/product/chicken.jpg">
                </div>
                <div class="h-20">
                    <a href="../main/content.php">
                        <h3> [KMT] 韓寶，一款真正人性化的智能語音 | 能說能唱 一台就給全家好心情ttttttttttttttttttttttttt</h3>
                    </a>
                </div>
                <button type="button" class="button m-b-10">+關注</button>
                <div class="horizon-between top-divider">
                    <div class="horizon-items vertical-center">
                        <b>NT$ 2,900,500</b>
                        <p class="vertical-divider"> <b>300 %</b> </p>
                    </div>
                    <p>還剩40天</p>
                </div>
            </div>
            <div class="project-object">
                <div class="image-container ">
                    <img src="../images/product/chicken.jpg">
                </div>
                <div class="h-20">
                    <a href="../main/content.php">
                        <h3> [KMT] 韓寶，一款真正人性化的智能語音 | 能說能唱 一台就給全家好心情ttttttttttttttttttttttttt</h3>
                    </a>
                </div>
                <button type="button" class="button m-b-10">+關注</button>
                <div class="horizon-between top-divider">
                    <div class="horizon-items vertical-center">
                        <b>NT$ 2,900,500</b>
                        <p class="vertical-divider"> <b>300 %</b> </p>
                    </div>
                    <p>還剩40天</p>
                </div>
            </div>
           
        </div>

    </section>

    <div class="horizon-items horizon-center vertical-center">
        <button class="button-transparent"> 上一頁</button>
        <button class="button-transparent"> 1</button>
        <button class="button-transparent"> 2</button>
        <button class="button-transparent"> 3</button>
        <button class="button-transparent"> 下一頁</button>
    </div>

    <footer class="footerpage">
    </footer>
</body>
</html>