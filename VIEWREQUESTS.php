<!DOCTYPE html>
<html lang="en"> 

<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Chollerton Tearooms</title>
	<link rel="stylesheet" href="new.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
    
<body> 
<header class="header">
    
    <nav> 
        <a href="http://unn-w21012510.newnumyspace.co.uk/Chollerton/HOME.html"> <img src="Graphics/logo-mixed.png" alt="Main logo"> </a>
        <div class="nav-links" id="navLinks">

            <i class="fa fa-times" onclick="hideMenu()"></i>
            <ul>
                <li> <a href="http://unn-w21012510.newnumyspace.co.uk/Chollerton/HOME.html"> HOME </a></li>
                <li> <a href="http://unn-w21012510.newnumyspace.co.uk/Chollerton/FINDOUTMORE.html"> FIND OUT MORE </a></li>
                <li> <a href="http://unn-w21012510.newnumyspace.co.uk/Chollerton/VIEWREQUESTS.php"> VIEW REQUESTS </a></li>
                <li> <a href="http://unn-w21012510.newnumyspace.co.uk/Chollerton/CREDITS.html"> CREDITS </a></li>
            </ul>
        </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
    </nav>
    
    <div class="text-box">
        <h1>REQUESTS</h1>  
    <p>All requests submitted are as follows:</p>
    </div>
    
    </header>
<!------- Main ------->
<section class="infoTable"> 
    
<!--This block of code will retrieve the form data, check for null/empty, upload to db and return info on requests page-->
    <?php
    include 'database_conn.php';
    
    $forename = isset($_REQUEST['forename'])?$_REQUEST['forename']:null;
    $surname = isset($_REQUEST['surname'])?$_REQUEST['surname']:null;
    $postalAddress = isset($_REQUEST['postalAddress'])?$_REQUEST['postalAddress']:null;
    $mobileTelNo = isset($_REQUEST['mobileTelNo'])?$_REQUEST['mobileTelNo']:null;
    $email = isset($_REQUEST['email'])?$_REQUEST['email']:null;
    $facility = isset($_REQUEST['facility'])?$_REQUEST['facility']:null;
    $sendMethod = isset($_REQUEST['sendMethod'])?$_REQUEST['sendMethod']:null;
    
    if(empty($forename)||empty($surname)||empty($postalAddress)||empty($mobileTelNo)||empty($email)){
        echo'<p class="contrast-2">Complete all fields on contact form to join list.<br>';
        echo '<A class="contrast-2" href="http://unn-w21012510.newnumyspace.co.uk/Chollerton/FINDOUTMORE.html"><b> Go back.</b></a></p></body></html>';
    } else{
    
        $forename=$_REQUEST['forename'];
        $surname=$_REQUEST['surname'];
        $postalAddress=$_REQUEST['postalAddress'];
        $mobileTelNo=$_REQUEST['mobileTelNo'];
        $email=$_REQUEST['email'];
        $facility=$_REQUEST['facility'];
        $sendMethod=$_REQUEST['sendMethod'];


        
        $insertSQL = "INSERT INTO CT_expressedInterest (forename, surname, postalAddress, mobileTelNo, email, sendMethod, catID) VALUES ('$forename', '$surname', '$postalAddress', '$mobileTelNo', '$email', '$sendMethod', '$facility')";
        
        $success=$dbConn->query($insertSQL);
        if($success === false){
            echo "<p class='contrast-2'>Sorry, $forename there was a problem when saving data.<br>";
            echo "<a class='contrast-4' href='http://unn-w21012510.newnumyspace.co.uk/Chollerton/FINDOUTMORE.html'> Please try again.</a></p>\n";
        } else{
            echo"<p class='contrast-2'>$forename, Your information was successfully submitted.</p>\n";
        } echo"<p class='contrast-2'>Return to the Home Page <a href='http://unn-w21012510.newnumyspace.co.uk/Chollerton/HOME.html'>here.</a></p>\n";
    }
        $dbConn->close();
    ?>

    <!--this code will connect to the db and output all data enteries onto the requests page-->
    <?php 
    include 'database_conn.php';

        $selectSQL = "SELECT expressInterestID, forename, surname, postalAddress, mobileTelNo, email, sendMethod, catDesc FROM CT_expressedInterest INNER JOIN CT_category ON CT_category.catID = CT_expressedInterest.catID ORDER BY surname";
        $queryResult = $dbConn->query($selectSQL);

        if($queryResult === false){
            echo "<p class='contrast-2'>Query failed: ".$dbConn->error."</p>\n</body>\n</html>";
            exit;
        }
        else {
            while($rowObj = $queryResult->fetch_object()){
                echo "<div class='part'> 
                    <span class='item'> Forename: {$rowObj->forename} </span> <br>
                    <span class='item'> Surname: {$rowObj->surname} </span> <br>
                    <span class='item'> Address: {$rowObj->postalAddress} </span> <br>
                    <span class='item'> Mobile number: {$rowObj->mobileTelNo} </span> <br>
                    <span class='item'> Email: {$rowObj->email} </span> <br>
                    <span class='item'> Facility: {$rowObj->catDesc}</span> <br>
                    <span class='item'> Send method: {$rowObj->sendMethod} </span> <br>
                </div>\n";
                }
        }
        $queryResult->close();
        $dbConn->close();
    ?>
    
</section>
    
<!------- footer ------->
<section class="footer">
<a class="title" href="http://unn-w21012510.newnumyspace.co.uk/Chollerton/HOME.html"><h4> CHOLLERTON TEAROOMS</h4></a>

    <div class="icons">
        <i class="fa fa-facebook"></i>
        <i class="fa fa-twitter"></i>
        <i class="fa fa-google-plus"></i>
        <i class="fa fa-instagram" ></i>
        <i class="fa fa-share-square-o"></i>
    </div>
        <p class="contrast"> <i class="fa fa-copyright"></i> All rights reserved to Chollerton Tearooms 2023.</p>
</section>
    
<!------ JavaScript for toggle menu -----> 

   
        <script>
        var navLinks = document.getElementById("navLinks");
        
            function showMenu(){
                navLinks.style.right = "0";
            }
            
            function hideMenu(){
                navLinks.style.right = "-200px";
            }
        </script>
    
</body>
</html>