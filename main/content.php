<!DOCTYPE html>
<html lang="zh-tw">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Achieve is Crowdfunding platform in Asia, which the goal is helping people make their dream come true.  Achieve 是一個群眾集資平台。立志於幫助人們實現夢想。">
    <meta name="keywords" content="crowdfunding, platform, dream, help">
    <meta name="author" content="楊雲翔">
    <meta property="og:site_name" content="Achieve">
    <meta property="og:locale" content="zh_TW">
    <meta property="og:title" content="韓寶 | Achieve">
    <meta property="og:description" content="Achieve is Crowdfunding platform in Asia, which the goal is helping people make their dream come true.  Achieve 是一個群眾集資平台。立志於幫助人們實現夢想。">
    <meta property="og:image" content="./images/achieve.png">
    <meta property="og:type" content="website">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>韓寶 | Achieve</title>
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
        if(!function_exists('get_info')) require_once('../backend/project.php');

        function not_find_proj()
        {
            echo "<script type='text/javascript'>";
            echo sprintf("alert('%s');", "無此專案!");
            echo "window.location.href= '../main/index.php'";
            echo "</script>";
        }
        if(!isset($_GET['id']))
        {
            not_find_proj();
        }
        else
        {
            $result = get_info($_GET['id']);
            if(!$result) not_find_proj();
        }
    ?>
    <section class="bottom-divider p-t-40 p-b-40">
        <div class="container horizon-items">
            <div class="w-60 m-r-30">
                
                <img src=  "<?php echo $result['main_img']; ?>" height="100%" width="100%"> </img>
            </div>
            <div class="w-40 vertical-items">
                <div>
                    <h1> <?php echo $result['name']; ?> </h1>
                    <p class="vertical-divider-thick"> <?php echo $result['info']['intro']; ?></p>
                </div>
                <div class="horizon-items">
                    <p>提案人：<p>
                    <a href="#"> <?php echo $result['organizer']; ?> </a>
                </div>
                <div class="horizon-between vertical-center bottom-divider">
                    <div class="horizon-items vertical-center">
                        <h3> <?php echo $result['now_money']; ?></h3>
                        <p class="vertical-divider"> <b><?php echo $result['ratio']; ?></b> </p>
                    </div>
                    <p> <?php echo $result['sponsor_num']; ?> 位贊助者</p>
                </div>
                
                <div class="prompt">
                    <p> <b>剩餘天數</b> &nbsp;&nbsp; <?php echo $result['remain_day']; ?>天 </p>
                    <p> <b>時程</b> &nbsp;&nbsp; <?php echo $result['begin_date']; ?> – <?php echo $result['end_date']; ?> </p>
                </div>
            </div>
        </div>
    </section>


    <div>
        <div class="w-100 bg-block bottom-divider horizon-center">
            <div class="horizon-between w-50 p-t-20 p-b-20">
                <a href="../content.php?q=content"> 專案內容</a>
                <a href="../content.php?q=qa"> 常見問題</a>
            </div>
        </div>
    </div>
    <div class="container horizon-between m-t-20 ">
        <div class="vertical-items m-t-20 w-65">

            <?php 
            foreach($result['info']['intro_img'] as $img)
            {
                if($img != "")
                {
                    echo '<div class="m-r-30 m-t-30">';
                    echo sprintf('<img src="%s" class="content_img">', $img);
                    echo ' </div>';
                        
                }
            }
            ?>

            <div class="horizon-between m-r-30">
                <div class="w-40">
                    <h2>詳細規格</h2>
                    <div class="w-100 form-input h-200p">
                        <p> <?php echo $result['info']['content']; ?> </p>
                    </div>
                </div>
                <div class="w-40">
                    <h2>聯絡資訊</h2>
                    <div class="w-100 form-input h-200p">
                        <p>  <?php echo $result['info']['contact']; ?> </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="vertical-items vertical-start m-t-20 w-30">

            <div class="getmoney">
                <div class="image-container">
                    <img src="<?php echo $result['main_img']; ?>">
                </div>
                <div class="h-30">
                    <h3>  <?php echo $result['name']; ?> </h3>
                </div>
                <div class="h-15">
                    <p>純做善事，不求回饋</p>
                </div>
                <div class="horizon-between top-divider">
                    <div class="horizon-items vertical-center">
                        <b>NT$ 100</b>
                    </div>
                    <p>還剩<?php echo $result['remain_day']; ?>天</p>
                </div>
                <?php echo sprintf('<button class="button" onclick="donate(%s, 100)" > 贊助專案</button>',$_GET['id']); ?>
                
            </div>
            <div class="getmoney">
                <div class="image-container">
                    <img src="<?php echo $result['main_img']; ?>">
                </div>
                <div class="h-30">
                        <h3> <?php echo $result['name']; ?></h3>
                </div>
                <div class="h-15">
                    <p>純做善事，不求回饋</p>
                </div>
                <div class="horizon-between top-divider">
                    <div class="horizon-items vertical-center">
                        <b>NT$ 500</b>
                    </div>
                    <p>還剩<?php echo $result['remain_day']; ?>天</p>
                </div>
                <?php echo sprintf('<button class="button" onclick="donate(%s, 500)" >贊助專案</button>',$_GET['id']); ?>
            </div>
            <div class="getmoney">
                <div class="image-container">
                    <img src="<?php echo $result['main_img']; ?>">
                </div>
                <div class="h-30">
                        <h3> <?php echo $result['name']; ?></h3>
                </div>
                <div class="h-15">
                    <p>純做善事，不求回饋</p>
                </div>
                <div class="horizon-between top-divider">
                    <div class="horizon-items vertical-center">
                        <b>NT$ 2,000</b>
                    </div>
                    <p>還剩<?php echo $result['remain_day']; ?>天</p>
                </div>
                <?php echo sprintf('<button class="button" onclick="donate(%s, 2000)" >贊助專案</button>',$_GET['id']); ?>
            </div>
        </div>
        
    </div>


    <footer class="footerpage">
    </footer>
</body>
</html>

<script>
    function donate(proj_id, money)
    {
        $.post("../backend/donate.php", { 'id': proj_id, 'money': money }).done(function( data ) {
            if (data == "fail")
            {
                alert("請先登入再進行此操作!");
                window.location.href = '../main/login.php';
            }
            else
            {
                alert("贊助成功!");
                location.reload();
            }
        });
    }
</script>