<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "config.php";
 $strsearchcriteria="";
$search_err="";
$resulta1="";
$resulta2="";
$resulta3="";
$resulta4="";
$resulta5="";
$resulta6="";
$resulta7="";
$resulta8="";
$resulta9="";
$resulta10="";
$resulta11="";
if($_SERVER["REQUEST_METHOD"] == "POST"){

// Check if input text is empty
    if(empty(trim($_POST["search"]))){
		$strsearchcriteria = trim($_POST["search"]);
     //   $search_err = "Please enter your search criteria.";
    } else{
        $strsearchcriteria = trim($_POST["search"]);
  }
  
  
  
  // lagay mo dito ung viewer
   if(empty($search_err)){
	   //search
	   
	   
    if(empty(trim($_POST["search"]))){
		//$strsearchcriteria = trim($_POST["search"]);
      $sql = "SELECT * FROM tbldeliveryupdate";
	}
	else{
		$strsearchcriteria = trim($_POST["search"]);
		 $sql = "SELECT * FROM tbldeliveryupdate WHERE strso = ?";
	}
	   
	  
	   
	     if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_search);
			
			if(empty(trim($_POST["search"]))){
		$param_search = "*";
	}
	else{
		 $param_search = $strsearchcriteria;
	}
			            // Set parameters
           
			
			
			 // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
				
				
				                // Check if search criteria exists
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $strdatetimein, $strdatetimeout,$strso,$strname,$strsalespersonel,$strrecievedby,$strdeliveredby,$strdeliverycomment,$strdeliveryaddress,$strdatetime);
                    if(mysqli_stmt_fetch($stmt)){


                            $resulta1=$strso;
							$resulta2=$strname;
							$resulta3=$strsalespersonel;
							$resulta4=$strrecievedby;
							$resulta5=$strdeliveredby;
							$resulta6=$strdeliverycomment;
							$resulta7=$strdeliveryaddress;
							$resulta8=$strdatetime;
							
							$resulta9=$strdatetimein;
							$resulta10=$strdatetimeout;
							$resulta101=$strdatetime;
                            // Store data in session variables
                          //  $_SESSION["loggedin"] = true;
                          //  $_SESSION["id"] = $id;
                          //  $_SESSION["search"] = $strsearch;                            
                            

                       
                    }
                } else{
                    // Display an error message if search criteria dont exist
                    $search_err = "No record found.";
                }
				
				
			}
			
			
		 }
	   
   }
  
  
}
 mysqli_close($link);
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Delivery Update</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
    body {
        color: #566787;
		background: #f5f5f5;
		font-family: 'Varela Round', sans-serif;
		font-size: 13px;
	}
    .table-responsive {
        margin: 30px 0;
    }
	.table-wrapper {
        min-width: 1000px;
        background: #fff;
        padding: 20px 25px;
		border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
	.table-title {
		padding-bottom: 15px;
		background: #299be4;
		color: #fff;
		padding: 16px 30px;
		margin: -20px -25px 10px;
		border-radius: 3px 3px 0 0;
    }
    .table-title h2 {
		margin: 5px 0 0;
		font-size: 24px;
	}
	.table-title .btn {
		color: #566787;
		float: right;
		font-size: 13px;
		background: #fff;
		border: none;
		min-width: 50px;
		border-radius: 2px;
		border: none;
		outline: none !important;
		margin-left: 10px;
	}
	.table-title .btn:hover, .table-title .btn:focus {
        color: #566787;
		background: #f2f2f2;
	}
	.table-title .btn i {
		float: left;
		font-size: 21px;
		margin-right: 5px;
	}
	.table-title .btn span {
		float: left;
		margin-top: 2px;
	}
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
		padding: 12px 15px;
		vertical-align: middle;
    }
	table.table tr th:first-child {
		width: 60px;
	}
	table.table tr th:last-child {
		width: 100px;
	}
    table.table-striped tbody tr:nth-of-type(odd) {
    	background-color: #fcfcfc;
	}
	table.table-striped.table-hover tbody tr:hover {
		background: #f5f5f5;
	}
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }	
    table.table td:last-child i {
		opacity: 0.9;
		font-size: 22px;
        margin: 0 5px;
    }
	table.table td a {
		font-weight: bold;
		color: #566787;
		display: inline-block;
		text-decoration: none;
	}
	table.table td a:hover {
		color: #2196F3;
	}
	table.table td a.settings {
        color: #2196F3;
    }
    table.table td a.delete {
        color: #F44336;
    }
    table.table td i {
        font-size: 19px;
    }
	table.table .avatar {
		border-radius: 50%;
		vertical-align: middle;
		margin-right: 10px;
	}
	.status {
		font-size: 30px;
		margin: 2px 2px 0 0;
		display: inline-block;
		vertical-align: middle;
		line-height: 10px;
	}
    .text-success {
        color: #10c469;
    }
    .text-info {
        color: #62c9e8;
    }
    .text-warning {
        color: #FFC107;
    }
    .text-danger {
        color: #ff5b5b;
    }
    .pagination {
        float: right;
        margin: 0 0 5px;
    }
    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }
    .pagination li a:hover {
        color: #666;
    }	
    .pagination li.active a, .pagination li.active a.page-link {
        background: #03A9F4;
    }
    .pagination li.active a:hover {        
        background: #0397d6;
    }
	.pagination li.disabled i {
        color: #ccc;
    }
    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }
    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }
</style>
<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
</script>
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<div class="form-group <?php echo (!empty($search_err)) ? 'has-error' : ''; ?>">
                <label>Search</label>
                <input type="text" name="search" placeholder=". . ." class="form-control" value="<?php echo $strsearchcriteria; ?>">
                <span class="help-block"><?php echo $search_err; ?></span>
            </div>

<div class="form-group">
                <input type="submit" class="btn btn-primary" value="GO">
            </div>


<div class="container">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-xs-5">
                        <h2>Delivery <b>Update</b></h2>
                    </div>
                    <div class="col-xs-7">
                        <!--<a href="#" class="btn btn-primary"><i class="material-icons">&#xE147;</i> <span>Add New User</span></a> -->
                        <a href="#" class="btn btn-primary"><i class="material-icons">&#xE24D;</i> <span>Export to Excel</span></a>						
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>TIME IN</th>
						<th>TIME OUT</th>
                        <th>SALES ORDER</th>						
                        <th>CUSTOMER NAME</th>
                        <th>SALES PERSONEL</th>
                        <th>RECEIVED BY</th>
                        <th>DELIVERED BY</th>
						<th>DELIVERED COMMENT</th>
						<th>DELIVERY ADDRESS</th>
						<th>DATE TIME</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
					<td><b><?php echo htmlspecialchars($resulta9); ?></b></td>
				<td><b><?php echo htmlspecialchars($resulta10); ?></b></td>
				<td><b><?php echo htmlspecialchars($resulta1); ?></b></td>
				<td><b><?php echo htmlspecialchars($resulta2); ?></b></td>
				<td><b><?php echo htmlspecialchars($resulta3); ?></b></td>
				<td><b><?php echo htmlspecialchars($resulta4); ?></b></td>
				<td><b><?php echo htmlspecialchars($resulta5); ?></b></td>
				<td><b><?php echo htmlspecialchars($resulta6); ?></b></td>
				<td><b><?php echo htmlspecialchars($resulta7); ?></b></td>
				<td><b><?php echo htmlspecialchars($resulta8); ?></b></td
				<td><b><?php echo htmlspecialchars($resulta11); ?></b></td>
 
                    </tr>
                   
                </tbody>
            </table>
          <!-- <div class="clearfix">
                <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                <ul class="pagination">
                    <li class="page-item disabled"><a href="#">Previous</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item active"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
                </ul>
            </div -->
        </div>
    </div>        
</div>     
</body>
</html>