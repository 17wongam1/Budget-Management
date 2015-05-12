<?php 
	
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$departmentError = null;
		$nameError = null;
		$amountError = null;
		$reasonError = null;
		$statusError = null;
		
		// keep track post values
		$department = $_POST['department'];
		$name = $_POST['name'];
		$amount = $_POST['amount'];
		$reason = $_POST['reason'];
		// $status = $_POST['status'];
		
		// validate input
		$valid = true;
		if (empty($department)) {
			$departmentError = 'Please select a valid department';
			$valid = false;
		}
		
		if (empty($name)) {
			$nameError = 'Please enter a valid name';
			$valid = false;
		}
		
		if (empty($amount)) {
			$amountError = 'Please enter a valid amount';
			$valid = false;
		}
		
		if (empty($reason)) {
			$reasonError = 'Please enter a valid reason';
			$valid = false;
		}
		
		if (empty($status)) {
			$statusError = 'Please select a valid status';
			$valid = false;
		}
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO request (department,name,amount,reason) values(?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($department,$name,$amount,$reason));
			Database::disconnect();
			header("Location: index.php");
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Create a Request</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="create.php" method="post">
					  <div class="control-group <?php echo !empty($departmentError)?'error':'';?>">
					    <label class="control-label">Department</label>
					    <div class="controls">
					      	<!-- <input name="name" type="text" placeholder="Department" value="<?php echo !empty($name)?$name:'';?>"> -->
					      	
					      	<select name="Department">
					      	  <option value="#">Select...</option>
							  <option value="Arts and Physical Education">Arts and Physical Education</option>
							  <option value="English">English</option>
							  <option value="Humanities">Humanities</option>
							  <option value="Languages">Languages</option>
							  <option value="Mathematics">Mathematics</option>
							  <option value="Science">Science</option>
							  <option value="Technology and ICT">Technology and ICT</option>
							  <option value="General Administration">General Administration</option>
							  <option value="Finance Administration">Finance Administration</option>
							  <option value="Resources Administration">Resources Administration</option>
							  <option value="Senior School Office">Senior School Office</option>
							  <option value="Middle School Office">Middle School Office</option>
							  <option value="Lower School Office">Lower School Office</option>
							  <option value="Examinations and Higher Education">Examinations and Higher Education</option>
							  <option value="Library and Learning Centre">Library and Learning Centre</option>
							  <option value="Medical Support">Medical Support</option>
							  <option value="IT Support">IT Support</option>
							  <option value="Science Support">Science Support</option>
							  <option value="Design and Technology Support">Design and Technology Support</option>
							  <option value="Food Technology Support">Food Technology Support</option>
							  <option value="Art Support">Art Support</option>
							  <option value="PE Support">PE Support</option>
							  <option value="Educational Support">Educational Support</option>
							  <option value="Facilities">Facilities</option>					  
							  <option value="Life Guards">Life guards</option>
							  <option value="Cleaning Team">Cleaning Team</option>
							  <option value="ISS Facilities Services">ISS Facilities Services</option>
							  <option value="Security Services">Security Services</option>
							  <option value="Non-School Hour Services">Non-School Hour Services</option>
							</select>  

					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">Name</label>
					    <div class="controls">
					      	<input name="name" type="text" placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
					      	<?php if (!empty($nameError)): ?>
					      		<span class="help-inline"><?php echo $nameError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($amountError)?'error':'';?>">
					    <label class="control-label">Amount</label>
					    <div class="controls">
					      	<input name="amount" type="text"  placeholder="Amount" value="<?php echo !empty($amount)?$amount:'';?>">
					      	<?php if (!empty($amountError)): ?>
					      		<span class="help-inline"><?php echo $amountError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <divclass="control-group <?php echo !empty($reasonError)?'error':'';?>">
					    <label class="control-label">Reason</label>
					    <div class="controls">
							<textarea name="reason" placeholder="Address" rows="5" cols="80" value="<?php echo !empty($reason)?$reason:'';?>"></textarea>
					      	<?php if (!empty($reasonError)): ?>
					      		<span class="help-inline"><?php echo $reasonError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>