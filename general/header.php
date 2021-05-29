<?php 
    $lo = true;
    function login()
    {
        global $lo;
        if($lo == true)
        {
            echo "<li><a href='../member/setting.html'>會員中心</a></li>";
        }
        else
        {
            echo'<li><a href="../main/login.html">登入</a></li>';
            echo'<li><a href="../main/register.html" >註冊</a></li>';
        }
    }
?>
<header class="bottom-divider">
    <div class="container horizon-between">
        <nav class="vertical-center">
            <a href="../main/index.html" class="m-r-35"> 
                <img src="../images/achieve.png" width="148" height="42"> </img>
            </a>
            <div class="horizon-center wrap">
                <li>
                    <a href="../main/proposal.html">提案</a>
                </li>
                <li>
                    <a href="../main/project.html">探索</a>
                </li>
            </div>
        </nav>
        <nav class="horizon-center wrap vertical-center">
           <?php login();?>
        </nav>
    </div>
</header>