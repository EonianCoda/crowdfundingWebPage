<!DOCTYPE html>
<html lang="zh-tw">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Achieve is Crowdfunding platform in Asia, which the goal is helping people make their dream come true.  Achieve 是一個群眾集資平台。立志於幫助人們實現夢想。">
    <meta name="keywords" content="crowdfunding, platform, dream, help">
    <meta name="author" content="楊雲翔">
    <meta property="og:site_name" content="Achieve">
    <meta property="og:locale" content="zh_TW">
    <meta property="og:title" content="Achieve | make dream come true">
    <meta property="og:description" content="Achieve is Crowdfunding platform in Asia, which the goal is helping people make their dream come true.  Achieve 是一個群眾集資平台。立志於幫助人們實現夢想。">
    <meta property="og:image" content="./images/achieve.png">
    <meta property="og:type" content="website">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Achieve | make dream come true</title>
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
    <div class="marquee-outer">
        <div class="horizon-center vertical-center w-80">
            <a href="../main/content.php">
                <p>剩下10天</p>
                <h3>
                    Alexander AutoChess自走軍棋 - 滿足成為指揮官的快感
                </h3>
                <div class="marquee-inner">
                    <span>查看計畫內容</span>
                </div>
            </a>
        </div>
    </div>


    <div class="container m-t-40 horizon-center vertical-items text-center">
        <h1>探索專案類別</h1>
    
        <div class="horizon-between vertical-center text-center m-t-45">
            <div class="vertical-items fg-1">
                <a href="./project.php?category=design" class=" category-button"> 
                    <img src="../images/categoryIcon/design.png" height="100" width="100"> </img>
                    <p>設計<p>
                </a>
            </div>

            <div class="vertical-items fg-1">
                <a href="./project.php?category=music" class=" category-button"> 
                    <img src="../images/categoryIcon/music.png" height="100" width="100"> </img>
                    <p>音樂<p>
                </a>
            </div>
            <div class="vertical-items fg-1">
                <a href="./project.php?category=education" class=" category-button"> 
                    <img src="../images/categoryIcon/edu.png" height="100" width="100"> </img>
                    <p>教育<p>
                </a>
            </div>
            <div class="vertical-items fg-1">
                <a href="./project.php?category=technology" class=" category-button"> 
                    <img src="../images/categoryIcon/tech.png" height="100" width="100"> </img>
                    <p>科技<p>
                </a>
            </div>
            <div class="vertical-items fg-1">
                <a href="./project.php?category=life" class=" category-button"> 
                    <img src="../images/categoryIcon/life.png" height="100" width="100"> </img>
                    <p>生活<p>
                </a>
            </div>
        </div>
    </div>

    <section class="container m-t-25">
        <div class="vertical-center">
            <h1 class="quote">熱門項目</h1>
        </div>
        <div class="horizon-items wrap">
            <?php 
            if(!function_exists('get_hot')) require_once('../backend/project.php');
            if(!function_exists('get_user_project_list')) require_once('../backend/member_info.php');
            $hot_projects = get_hot();


            //get watch list
            session_start();
            if(isset($_SESSION['online_key'])) $user_id = authentication($_SESSION['online_key']);
            else $user_id = 0;
            $watch_list = NULL;
            if($user_id != 0)  $watch_list = get_user_project_list($user_id)['watch_list'];

             
            foreach($hot_projects as $project)
            {
                echo '<div class="project-object">';
                    echo '<div class="image-container">';
                        echo sprintf('<img src="%s">',$project['main_img']);
                    echo '</div>';
                    echo '<div class="h-20">';
                        echo sprintf('<a href="../main/content.php?id=%s">',$project['id']);
                            echo sprintf('<h3>%s</h3>',$project['name']);
                        echo '</a>';
                    echo '</div>';
                    
                    echo sprintf('<button id = "%d" onclick="watch(this)" type="button" ', $project['id']);
                    if($watch_list != NULL and ($key = array_search(intval($project['id']), $watch_list))!=false )
                    {
                        echo 'class="button-watched" >✔已關注</button>';
                    }
                    else
                    {
                        echo 'class="button" >+關注</button>';
                    }
                    echo '<div class="horizon-between top-divider m-t-10">';
                        echo '<div class="horizon-items vertical-center">';
                            echo sprintf('<b>%s</b>', $project['now_money']);
                            echo sprintf('<p class="vertical-divider"> <b>%s</b> </p>',$project['ratio']);
                        echo '</div>';
                        echo sprintf('<p>還剩%s天</p>',$project['remain_day']);
                    echo '</div>';
                echo '</div>';
            }
            ?>
        </div>


    </section>

    <footer class="footerpage">
    </footer>
</body>
</html>

<script>
    function watch(button)
    {
        var watched = false; 
        var newClass =  "button";
        var newValue = "+關注";
        if(button.className == "button")
        {
            watched = true;
            newClass = "button-watched";
            newValue = "✔已關注";
        }
        $.post("../backend/add_watch_list.php", { 'id': button.id, 'status': watched }).done(function( data ) {
            if (data == "fail")
            {
                alert("請先登入再進行此操作!");
                window.location.href = '../main/login.php';
            }
        });
        button.className = newClass;
        button.innerHTML = newValue;
    }
</script>