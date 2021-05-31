<div class="bottom-divider">
    <nav class="container">
        <ul class="horizon-between container">
            <li><a href="history.php">募資記錄</a></li>
            <li><a href="watchlist.php">關注清單</a></li>
            <li><a href="myproposal.php">我的提案</a></li>
            <li><a href="setting.php">個人資料</a></li>
            <li><a href="editpassword.php">修改密碼</a></li>
        </ul>
    </nav>
</div>

<?php
    if (!function_exists('authentication')) require_once('../backend/account.php');
    only_for_members();
?>