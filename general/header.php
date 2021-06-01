<?php 
    if (!function_exists('authentication')) require_once("../backend/account.php");
    $lo = false;
    session_start();

    if(isset($_SESSION['online_key']))
    {
        $user_id = authentication($_SESSION['online_key']);
        //authentication success
        if ($user_id != 0) $lo = true;
    }
    function online()
    {
        global $lo;
        if($lo == true)
        {
            echo "<li><a href='../member/setting.php'>會員中心</a></li>";
            echo "<li><button disabled='disabled' class='logout' type='button' id='logout'>登出</button></li>";
        }
        else
        {
            echo'<li><a href="../main/login.php">登入</a></li>';
            echo'<li><a href="../main/register.php" >註冊</a></li>';
        }
    }
?>
<script>
    function addItem(form, name, value)
    {
        const hiddenField = document.createElement("input");
        hiddenField.type = 'hidden';
        hiddenField.name =  name;
        hiddenField.value = value;
        form.appendChild(hiddenField);
    }
	
	$("#logout").on("click", function () 
    { 
        if (confirm("確定登出" + "?")) 
        {
            var form = document.createElement("form");
		    form.setAttribute("action", '../backend/logout.php');
		    form.setAttribute("method", "post");
            document.body.appendChild(form);
		    form.submit();
		}
	}
	);
</script>
<header class="bottom-divider">
    <div class="container horizon-between">
        <nav class="vertical-center">
            <a href="../main/index.php" class="m-r-35"> 
                <img src="../images/achieve.png" width="148" height="42"> </img>
            </a>
            <div class="horizon-center wrap">
                <li>
                    <a href="../main/proposal.php">提案</a>
                </li>
                <li>
                    <a href="../main/project.php?category=design">探索</a>
                </li>
            </div>
        </nav>
        <nav class="horizon-center wrap vertical-center">
           <?php online();?>
        </nav>
    </div>
</header>