<?php 
	
	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: index.php");
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$statusError = null;
		
		// keep track post values
		$status = $_POST['status'];
		
		// validate input
		$valid = true;

		if (empty($status)) {
			$statusError = 'Please select a valid status.';
			$valid = false;
		}
		
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE customers  set status = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($department,$name,$amount,$reason,$status,$id));
			Database::disconnect();
			header("Location: index.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM customers where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$status = $data ['status'];
		Database::disconnect();
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
		    			<h3>Update a Customer</h3>
					
		    		</div>
    
					  <div class="control-group <?php echo !empty($statusError)?'error':'';?>">
					    <label class="control-label">Status</label>
					    <div class="controls">
					      	<select name="status">

							  <option value="pending">Pending</option>
							  <option value="granted">Granted</option>
							  <option value="rejected">Rejected</option>
							</select>

					      	<?php if (!empty($statusError)): ?>
					      		<span class="help-inline"><?php echo $statusError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>