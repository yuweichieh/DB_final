<?php
    session_start();
    // parameters setup
    /*define(host, 'localhost');
    define(user, 'root');
    define(password, 'root');
    define(db_name, 'my_db');
    define(port, 8889);
        //var_dump($_GET["ann_id"]);
    function db_connect(){
        // create connection to database
        $conn = mysqli_connect(host, user, password, db_name, port);
        if($conn->connect_error)
            die("Connection failed: ". $conn->connect_error);
        return $conn;
    }*/
    $servername = "localhost";//連接伺服器
	$username = "root";
	$password = "123";
	$dbname = "final";//選擇欲讀取的資料庫名稱
	$conn = new mysqli($servername, $username, $password, $dbname);//create connection
	mysqli_query($conn, "SET NAMES 'UTF8'");

?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<meta charset="utf-8">
	<title>Index</title>
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">    
</head>

<!-- ==================================== -->
<!-- Website Design -->
<body>
    
	<div class="header">
        
		<div class="container">

			<div class="logo">
                <h1><a href="#">NCTU SPORTS</a></h1>
			</div>
            <?php
            if(!isset($_SESSION['username'])){
            ?>
			<ul class="_nav">
				<li><a href="../index.php">首頁</a></li>
				<li><a href="../register/register.php">註冊</a></li>
				<li><a href="../event/event.php">活動報名</a></li>
				<li><a href="../login/login.php">登入</a></li>
			</ul>
            <?php   }elseif($_SESSION['username']==1){ ?>
            <ul class="_nav">
				<li><a href="../index.php">首頁</a></li>
				<li><a href="../event/event.php">活動報名</a></li>
                <li style="color:white;">Hi, Admin</li>
				<!--<li><a href="./login/logout.php">登出</a></li> class="btn btn-danger navbar-btn"-->
                <li><input type="button" value="登出" onclick="logout()"></li>
               <script type="text/javascript">
                    function logout(){
                        var conf = confirm("Do you want to logout?");
                        if(conf){
                            window.location.href = '../login/logout.php';   
                        }
                    }
                </script>
            </ul>
            <?php   }else{  ?>
            <ul class="_nav">
				<li><a href="../index.php">首頁</a></li>
				<li><a href="#">活動報名</a></li>
                <li style="color:white;">Hi, <?php echo $_SESSION['username']; ?></li>
				<!--<li><a href="./login/logout.php">登出</a></li> class="btn btn-danger navbar-btn"-->
                <li><input type="button" value="登出" onclick="logout()"></li>
               <script type="text/javascript">
                    function logout(){
                        var conf = confirm("Do you want to logout?");
                        if(conf){
                            window.location.href = '../login/logout.php';   
                        }
                    }
                </script>
			</ul>
            <?php   }   ?>
        </div>
    </div>
    
            
    <div class="container">
        <div class="ann_box">
            <?php
                if(isset($_SESSION['message'])){
                    echo "<div id='error_msg'>".$_SESSION['message']."</div>";
                    unset($_SESSION['message']);
                }
                //$conn = db_connect();
                if(isset($_GET['ann_id'])){
                $query = "SELECT * FROM announces WHERE ann_id=".$_GET["ann_id"];
                $result = mysqli_query($conn, $query);
                //mysqli_close($conn);
                $var = mysqli_fetch_array($result);
                }
            ?>
            <h1><?php echo $var['title']?></h1>
            <p align="right"><?php echo $var['ann_date']?></p>
            <h3><?php echo $var['content']?></h3>
            <img src="image.php?ann_id=<?php echo $var["ann_id"]; ?>" style="width:60%;" class="center">

            <?php
                mysqli_free_result($result);
            ?>

        </div>
	</div>
</body>
</html>