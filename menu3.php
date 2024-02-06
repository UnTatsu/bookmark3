<link rel="stylesheet" href="./css/style.css">
<div id="menu3">
    <div class="menuleft">
        <div class="userimgbox"><img src="upload/<?php echo $_SESSION["img"]; ?>" class="userimg" width="20px"></div>
        <div class="menu-logname"> <?php echo $_SESSION["name"]; ?>さん</div>
    </div>
    <nav class="manu-navbar ">
    <ul class="menu-navcon">
        <li><a class="navbar-brand" href="index2.php">登録画面</a></li>
        <li><a class="navbar-brand" href="select2.php">登録一覧</a></li>
        <li><a class="navbar-brand" href="logout2.php">ログアウト</a></li>
    </ul>
</nav>
</div>