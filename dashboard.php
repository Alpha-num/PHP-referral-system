<?php 
session_start();
require_once __DIR__.'/include/connection.php';

if(empty($_SESSION['firstname']) && empty($_SESSION['lastname'])){
    header('Location:login.php');
    exit;
}
$userID = $_SESSION['userID'];
$_SESSION['is_affiliate'] = '';

$fetch_affiliate = mysqli_query($connection, "SELECT * FROM affiliates WHERE affiliateID = '$userID' ");
echo mysqli_error($connection);
if(mysqli_num_rows($fetch_affiliate) === 1){
    $_SESSION['is_affiliate'] = true;
}else{
    $_SESSION['is_affiliate'] = false;
}
$affiliate_link = '';


if(isset($_GET['userID'])){
    $userID = $_GET['userID'];
    $query = "SELECT * FROM users WHERE userID ='$userID' ";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) === 0){
        header("Location:login.php");
        exit;
    }

    $query2 = "INSERT INTO affiliates(affiliateID) VALUES('$userID')";
    $result2 = mysqli_query($connection, $query2);
    
    if(!$result2){
        echo "An error occurred. Please try again later";
    }else{
        $_SESSION['is_affiliate'] = true;
        $website_url = isset($_SERVER['https']) && $_SERVER['https'] === 'on' ? "https":"http";
        $website_url .= "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        header("Location:dashboard.php");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    <title>Affiliate Dashboard</title>
</head>
<body>

    <div class='main-content container my-3 text-center'> 
        <h3>Welcome <?php echo $_SESSION['firstname']?> </h3>
        <p>Email Address: <?php echo $_SESSION['email'] ?><p>
        <div>
            <?php 
                if($_SESSION['is_affiliate'] === false){
                    echo "<a class='btn btn-primary' href='dashboard.php?userID=$userID'>Become an Affiliate</a>";       
                }
            ?>
            
        </div>
        
        <div>
            <input type="text" id="textToCopy" readonly value="Text to be copied">
            <span id='copyButton'><i class="ri-clipboard-line"></i></span>
        </div>
        <?php 
            if($_SESSION['is_affiliate']){
                echo "<p> Affiliate since:  </p>";
                echo "<p> Total Referrals:  </p>";
                echo "<p>Total Amount:  </p>";
            }
        ?>
        
    </div>
    
    
</body>
</html>