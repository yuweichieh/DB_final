<?php
    session_start();
    // parameters setup
    define(host, 'localhost');
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
    }
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<meta charset="utf-8">
	<title>Edit Announcement</title>
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<link rel="stylesheet" type="text/css" href="../css/anncs.css">
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
            <ul class="_nav">
                <li><a href="../index.php">首頁</a></li>
                <li><a href="../event/event.php">活動報名</a></li>
                <li><a href="../event/status.php">報名狀況</a></li>
                <li style="color:white;">Hi, Admin</li>
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
        </div>
    </div>
    
            
    <div class="container">
        <div class="add_box">
            <?php
                if(isset($_SESSION['message'])){
                    echo "<div id='error_msg'>".$_SESSION['message']."</div>";
                    unset($_SESSION['message']);
                }
                $_SESSION['ann_id'] = $_GET['ann_id'];
                $conn = db_connect();
                $query = "select * from announces where ann_id=".$_GET['ann_id'];
                $result = mysqli_query($conn, $query);
                $var = mysqli_fetch_array($result);
            ?>      
            <form action="./update.php" method="post" id="ann">
                <font size="20">公告標題</font><br>
                <textarea class="title" cols="50" name="title" required><?php echo $var['title']?></textarea>
                <font size="20">公告內容</font><br>
                <!--<input class="content" type="text" name="content" required><br>-->
                <textarea class="content" cols="50" name="content" required><?php echo $var['content'] ?></textarea>
                <font size="20">公告圖片</font><br>
                <input type="file" name="image" required>
                <input type="submit" name="ann_post" value="發佈公告">
                <input type="reset" value="取消">
            </form>
        </div>
	</div>

</body>
</html>