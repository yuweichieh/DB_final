<?php
    session_start();
    // parameters setup
    define(host, 'localhost');
    define(user, 'root');
    define(password, 'root');
    define(db_name, 'my_db');
    define(port, 8889);

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
	<title>Event</title>
	<link rel="stylesheet" type="text/css" href="../css/styles.css"/>
    <link rel="stylesheet" type="text/css" href="../css/index.css"/>
    <!--
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    -->
    <script src="jquery-3.3.1.min.js"></script>
    
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
                <li><a href="./event.php">活動報名</a></li>
                <li><a href="../login/login.php">登入</a></li>
            </ul>
            
            <?php   }elseif($_SESSION['username']==1){  ?>
            <ul class="_nav">
                <li><a href="../index.php">首頁</a></li>
                <li><a href="./event.php">活動報名</a></li>
                <li><a href="./status.php">報名狀況</a></li>
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
            
            <?php   }else{  ?>
            <ul class="_nav">
                <li><a href="../index.php">首頁</a></li>
                <li><a href="./event.php">活動報名</a></li>
                <!--<li><a href="./login/logout.php">登出</a></li> class="btn btn-danger navbar-btn"-->
                <li style="color:white;">Hi, <?php echo $_SESSION['username']; ?></li>
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
                $conn = db_connect();
                $query = "SELECT * FROM events";
                $result = mysqli_query($conn, $query);
                mysqli_close($conn);
            ?>

            <h1>&nbsp;&nbsp;&nbsp;活動列表</h1>
            <?php if($_SESSION['username']==1){ ?>
                <a class="add_btn" href="./new_event.php">新增活動</a>
            <?php } ?>
            <table width=100% border="0" cellpadding ="6" cellspacing="0">
                <tr>
                    <th>項目</th> <td>規則</td> <td>報名</td>
                    <?php   if($_SESSION['username']==1){   ?>
                        <td>編輯活動</td><td>刪除活動</td>
                    <?php   }   ?>
                </tr>
            <?php
                while ($var = mysqli_fetch_array($result)){
            ?>
                <tr>
                    <th width=35%><?php echo $var['name'] ?></th>
                    <td width=35$><?php echo $var['rule'] ?></td>
                    <?php if($_SESSION['username']==1){  ?>
                        <td width = 10%><center><a class="detail_btn" href="./sign.php?event_id=<?php echo $var['event_id']?>">報名</a></center></td>
                        <td width = 10%><center><a class="edit_btn" href="./event_edit.php?event_id=<?php echo $var['event_id']?>">Edit</a></center></td>
                        <td width = 10%><center><a class="delete_btn" href="./event_delete.php?event_id=<?php echo $var['event_id']?>" onclick="return confirm('Are you sure?')">Delete</a></center></td>

                    <?php }elseif(isset($_SESSION['username'])){ ?>
                        <td width = 30%><a class="detail_btn" href="./sign.php?event_id=<?php echo $var['event_id']?>">報名</a></td>
                    <?php }else{ ?>
                        <td width = 30%><a class="detail_btn" href="../login/login.php">報名</a></td>
                    <?php } ?>
                </tr>
            <?php
                }
            ?>
            </table>
            <?php
                mysqli_free_result($result);
            ?>

        </div>
    </div>	
</body>
</html>