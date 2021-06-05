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
    <style>
        .swiper-container {
            height: 27em;
        }
        .swiper-container .swiper-button-hidden {
            opacity: 0;
        }

    </style>
</head>
<body>
    <header class="headerpage">
    </header>
    <div class="member_nav">
    </div>
    <div class="container member">

        <h3>我的贊助項目</h3>
        <?php
            if(!function_exists("get_user_project_list")) require_once("../backend/member_info.php");
            if(!function_exists("search_proj_by_ids")) require_once("../backend/project.php");
            $proj_list = get_user_project_list();
            $proj_list = $proj_list['follow'];
            $proj_info = search_proj_by_ids($proj_list);
            $empty_category = array(0,0,0,0,0);
            $null_check = 0;
            foreach($proj_info as $project)
            {
                $null_check = 1;
                $empty_category[intval($project['category'])] = 1;
            }
            if (!$null_check)
            {
                echo "<h3>您目前沒有贊助任何提案</h3>";
            }
            else
            {
                for ($category = 1; $category < 6; $category++)
                {
                    if (!$empty_category[$category]) continue;
                    switch($category)
                    {
                        case 1:
                            echo "<h3>設計</h3>";
                            $swp_id = swp_design;
                            break;
                        case 2:
                            echo "<h3>音樂</h3>";
                            $swp_id = swp_music;
                            break;
                        case 3:
                            echo "<h3>教育</h3>";
                            $swp_id = swp_edu;
                            break;
                        case 4:
                            echo "<h3>科技</h3>";
                            $swp_id = swp_tech;
                            break;
                        case 5:
                            echo "<h3>生活</h3>";
                            $swp_id = swp_life;
                            break;
                    }
                    echo "<div style=\"position:relative\">";
                        echo "<div class=\"swiper-container\" id=\"".$swp_id."\">";
                            echo "<div class=\"swiper-wrapper\">";
                                if(!function_exists('get_hot')) require_once('../backend/project.php');
                                
                                foreach($proj_info as $project)
                                {
                                    if($project['category'] != $category) continue;
                                    echo '<div class="swiper-slide">';
                                        echo '<div class="image-container">';
                                            echo sprintf('<img src="%s">',$project['main_img']);
                                        echo '</div>';
                                        echo '<div class="h-20">';
                                            echo sprintf('<a href="../main/content.php?id=%s">',$project['id']);
                                                echo sprintf('<h3>%s</h3>',$project['name']);
                                            echo '</a>';
                                        echo '</div>';
                                        //echo '<button disabled="disabled" type="button" class="button m-b-10">+關注</button>';
                                        echo '<div class="horizon-between top-divider">';
                                            echo '<div class="horizon-items vertical-center">';
                                                echo sprintf('<b>%s</b>', $project['now_money']);
                                                echo sprintf('<p class="vertical-divider"> <b>%s</b> </p>',$project['ratio']);
                                            echo '</div>';
                                            echo sprintf('<p>還剩%s天</p>',$project['remain_day']);
                                        echo '</div>';
                                    echo '</div>';
                                }
                            echo "</div>";
                            echo "<div class=\"swiper-button-prev\"></div>";
                            echo "<div class=\"swiper-button-next\"></div>";
                            echo "<div class=\"swiper-scrollbar\"></div>";
                        echo "</div>";
                        echo "<script>
                            var ".$swp_id." = new Swiper('#".$swp_id."', {
                                grabCursor : true,
                                centeredSlides: true,
                                spaceBetween: 40,
                                slidesPerView: 2,
                                slidesPerGroup: 1,
                                navigation: {
                                    nextEl: '.swiper-button-next',
                                    prevEl: '.swiper-button-prev',
                                },
                                scrollbar: {
                                    el: '.swiper-scrollbar',
                                },
                            });
                            
                        </script>";
                    echo "</div>";
                }
            }
        ?>

    </div>

    <footer class="footerpage">
    </footer>
</body>
</html>
