<?php
    if(!isset($_GET['category']))
    {
        $_GET['category'] = 'design';
    }
    if(!isset($_GET['page']))
    {
        $_GET['page'] = 1;
    }
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
            <?php
                $category = 0;
                switch($_GET['category'])
                {
                    case "design":
                        $category = 1;
                        break;
                    case "music":
                        $category = 2;
                        break;
                    case "education":
                        $category = 3;
                        break;
                    case "technology":
                        $category = 4;
                        break;
                    case "life":
                        $category = 5;
                        break;
                }
                
                if(!function_exists('get_hot')) require_once('../backend/project.php');
                $projects = search_proj($category);
                $proj_num = count($projects);

                
                $projects = array_slice($projects, (intval($_GET['page']) - 1)*6);
                foreach($projects as $project)
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
                        echo '<button disabled="disabled" type="button" class="button m-b-10">+關注</button>';
                        echo '<div class="horizon-between top-divider">';
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

    <div class="horizon-items horizon-center vertical-center">
        <button class="button-transparent" onclick="add_page(-1)" <?php if($_GET['page'] == 1) echo "disabled";   ?> > 上一頁</button>
        <?php
            $page_num = ceil(floatval($proj_num) / 6);
            for($i = 1; $i <= $page_num; $i++)
            {
                echo sprintf('<button class="button-transparent" onclick="turn_page(%d)"> %s </button>', $i, $i);
            }
        ?>
        <button class="button-transparent" onclick="add_page(1)"<?php if($_GET['page'] == $page_num) echo "disabled";  ?>> 下一頁</button>
    </div>

    <footer class="footerpage">
    </footer>
</body>
</html>

<script>

    function findGetParameter(parameterName) 
    {
        var result = null,
            tmp = [];
        location.search
            .substr(1)
            .split("&")
            .forEach(function (item) {
            tmp = item.split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
            });
        return result;
    }
    function turn_page(page)
    {
        var url = new URL(window.location.href);
        url.searchParams.set("page",page);
        window.location.href = url.toString();
    }
    function add_page(offset)
    {
        var url = new URL(window.location.href);
        if(url.searchParams.get('page'))
        {
            var page = url.searchParams.get('page');
            page += offset;
            url.searchParams.set("page",page);
            window.location.href = url.toString();
        }
    }
</script>
