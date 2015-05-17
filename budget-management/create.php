<?php 
	
	require 'database.php';
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$departmentError = null;
		$teacherError = null;
		$emailError = null;
		$amountError = null;
		$statusError = null;
		$reasonError = null;
		
		// keep track post values
		$department = $_POST['department'];
		$teacher = $_POST['teacher'];
		$email = $_POST['email'];
		$amount = $_POST['amount'];
		$status = $_POST['status'];
		$reason = $_POST['reason'];
		
		// validate input

		if (empty($department)) {
			$departmentError = 'Please enter Department Name';
			$valid = false;
		}

		$valid = true;
		if (empty($teacher)) {
			$teacherError = 'Please enter teacher';
			$valid = false;
		}
		
		if (empty($email)) {
			$emailError = 'Please enter Email Address';
			$valid = false;
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$emailError = 'Please enter a valid Email Address';
			$valid = false;
		}

		if (empty($amount)) {
			$amountError = 'Please enter a valid amount (cannot be more then 6 digits)';
			$valid = false;
		}

		if (empty($reason)) {
			$reasonError = 'Please enter a valid reason';
			$valid = false;
		}

		if (empty($status)) {
			$statusError = 'Please enter a valid status';
			$valid = false;
		}
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO customers (department,teacher,email,amount,reason,status) values(?, ?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($department,$teacher,$email,$amount,$reason,$status));
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
		    			<h3>Create a Customer</h3>
		    		</div>

		    		<div class="control-group <?php echo !empty($departmentError)?'error':'';?>">
					    <label class="control-label">Department Name</label>
					    <div class="controls">
					      	<select name="department">
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
					      	<?php if (!empty($departmentError)): ?>
					      		<span class="help-inline"><?php echo $departmentError;?></span>
					      	<?php endif;?>
					    </div>
    		
	    			<form class="form-horizontal" action="create.php" method="post">
					  <div class="control-group <?php echo !empty($teacherError)?'error':'';?>">
					    <label class="control-label">Teacher</label>
					    <div class="controls">
					    	<select name="teacher">
					    	  <option value="#" disabled>Select...</option>
							  <option value="Mr.Marc Morris">Mr.Marc Morris</option>
							  <option value="Mr.Neil Hodgson">Mr.Neil Hodgson</option>
							  <option value="Mr.Greg Thornton">Mr.Greg Thornton</option>
							  <option value="Mrs.Christine Rowlands">Mrs.Christine Rowlands</option>
							  <option value="Mr.Paul Hoang">Mr.Paul Hoang</option>
							  <option value="Mr.Gareth Morgan">Mr.Gareth Morgan</option>
							  <option value="Mr.Bryan Turner">Mr.Bryan Turner</option>
							  <option value="Mr.Lee O'Leary">Mr.Lee O'Leary</option>
				    	  <option value="#" disabled>Arts and Physical Education</option>
<!-- PE -->
							  <option value="Mrs.Jane Parry">Mrs.Jane Parry</option>
							  <option value="Mr.Antony Webster">Mr.Antony Webster</option>
							  <option value="Mr.Maurice Devlin">Mr.Maurice Devlin</option>
							  <option value="Ms.Deborah Hanley">Ms.Deborah Hanley</option>
							  <option value="Mr.Andrew Service">Mr.Andrew Service</option>
							  <option value="Ms.Emma Shields">Ms.Emma Shields</option>
							  <option value="Mr.Mostafa Khalfaoui">Mr.Mostafa Khalfaoui</option>
<!-- Art -->
							  <option value="Mr.John Doherty">Mr.John Doherty</option>							
							  <option value="Ms.Amy Hart">Ms.Amy Hart</option>
							  <option value="Ms.Kate Turbett">Ms.Kate Turbett</option>
<!-- Drama -->
							  <option value="Mr.Neil Harris">Mr.Neil Harris</option>
							  <option value="Ms.Sian Lewis">Ms.Sian Lewis</option>
							  <option value="Ms.Amanda O'Halloran">Ms.Amanda O'Halloran</option>
<!-- Music -->
							  <option value="Mr.Malcolm Godsman">Mr.Malcolm Godsman</option>
							  <option value="Mr.Joseph Travers">Mr.Joseph Travers</option>
				    	  <option value="#" disabled>English</option>						  
							  <option value="Ms.Lindsay Tandy">Ms.Lindsay Tandy</option>
							  <option value="Ms.Alexandra Daw">Ms.Alexandra Daw</option>
							  <option value="Ms.Nouhad Aoukar">Ms.Nouhad Aoukar</option>
							  <option value="Mr.Jonathan Barton">Mr.Jonathan Barton</option>
							  <option value="Ms.Zoe Buis">Ms.Zoe Buis</option>
							  <option value="Ms.Alice Gibbons">Ms.Alice Gibbons</option>
							  <option value="Mr.David Hooper">Mr.David Hooper</option>
							  <option value="Mr.Joseph Koszary">Mr.Joseph Koszary</option>
							  <option value="Mrs.Eliane McIntyre">Mrs.Eliane McIntyre</option>
							  <option value="Ms.Rachel Walker">Ms.Rachel Walker</option>
							  <option value="Mrs.Laurie Stein">Mrs.Laurie Stein</option>
							  <option value="Ms.Jessica Loebig">Ms.Jessica Loebig</option>
							  <option value="Ms.Mary Paciello">Ms.Mary Paciello</option>
							  <option value="Ms.Kimberly Ryou">Ms.Kimberly Ryou</option>
							  <option value="Ms.Nandita Tewari">Ms.Nandita Tewari</option>
							  <option value="Ms.Caroline Wong">Ms.Caroline Wong</option>
							  <option value="Ms.Renee Wong">Ms.Renee Wong</option>
							  <option value="Mrs.Lesley Watkins">Mrs.Lesley Watkins</option>
							<option value="#" disabled>Humanities</option>
							<!-- Economics/Bus Studies -->
							  <option value="Ms.Margaret Ducie">Ms Margaret Ducie</option>
							  <option value="Ms.Fiona Charnley">Ms.Fiona Charnley</option>
							  <option value="Mr.Paul Hoang">Mr.Paul Hoang</option>
							  <option value="Ms.Meiling Tsang">Ms.Meiling Tsang</option>
							  <option value="Ms.Urvashi Sharma">Mr.Urvashi Sharma</option>
							 <!--Geography-->
							  <option value="Ms.Jennifer Lederer">Ms.Jennifer Lederer</option>
							  <option value="Ms.Karen Griffiths">Ms.Karen Griffiths</option>
							  <option value="Mr.Richard Overens">Mr.Richard Overens</option>
<!-- History -->
							  <option value="Ms.Amanda Walker">Ms.Amanda Walker</option>
							  <option value="Mr.Chris Taylor">Mr.Chris Taylor</option>
<!-- PRS -->
							  <option value="Ms.Lucie Purves">Ms.Lucie Purves</option>
							  <option value="Mr.Crispian Farrow">Mr.Crispian Farrow</option>
							  <option value="Mrs.Sian May">Mrs.Sian May</option>
							  <option value="Ms.Lucy Ogilvie">Ms.Lucy Ogilvie</option>
							  <option value="Mrs.Christine Rowlands">Mrs.Christine Rowlands</option>
							  <option value="Ms.Ariana Thomson">Ms.Ariana Thomson</option>
							  <option value="Mrs.Imelda Weston">Mrs.Imelda Weston</option>
							 <!-- Psychology -->
							  <option value="Mr.Luke Smetherham">Mr.Luke Smetherham</option>
							  <option value="Mr.Patrick Campbell">Mr.Patrick Campbell</option>
							<option value="#" disabled>Languages</option>
							  <!-- European Languages -->
							  <option value="Ms.Racula Paraschivescu">Ms.Racula Paraschivescu</option>
							  <option value="Mr.Lee O'Leary">Mr.Lee O'Leary</option>
							  <option value="Ms.Katia Pitarch">Ms.Katia Pitarch</option>
							  <option value="Mr.Benoit Bardin">Mr.Benoit Bardin</option>
							 <!-- Asian Languages -->
							  <option value="Ms.Danielle Yang">Ms.Danielle Yang</option>
							  <option value="Ms.June Chen">Ms.June Chen</option>
							  <option value="Ms.Yu Min Chen">Ms.Yu Min Chen</option>
							  <option value="Ms.Vivienne Fung">Ms.Vivienne Fung</option>
							  <option value="Ms.Bibi Lee">Ms.Bibi Lee</option>
							  <option value="Ms.Ranny Liu">Ms.Ranny Liu</option>
							  <option value="Mr.Patton Zhou">Mr.Patton Zhou</option>
							  <option value="Ms.Constance Chung">Ms.Constance Chung</option>
							 <option value="#" disabled>Mathematics</option>
							  <option value="Mr.Martin Astill">Mr.Martin Astill</option>							
							<option value="Mr.Bryan Coulton">Mr.Bryan Coulton</option>
							  <option value="Ms.Morag Brooks">Ms.Morag Brooks</option>
							  <option value="Mr.Brian Hagan">Mr.Brian Hagan</option>
							  <option value="Mr.Cliff Imeson">Mr.Cliff Imeson</option>
							  <option value="Ms.Nicole Jones">Ms.Nicole Jones</option>
							  <option value="Mr.Greg Thornton">Mr.Greg Thornton</option>
							  <option value="Mr.Bryan Turner">Mr.Bryan Turner</option>
							  <option value="Mr.Mick Wilson">Mr.Mick Wilson</option>
							  <option value="Mr.Kim Yip">Mr.Kim Yip</option>							
							<option value="Mrs.Joanne Letters">Mrs.Joanne Letters</option>
							  <option value="#" disabled>Science</option>
							  <option value="Mr.Paul Drew">Mr.Paul Drew</option>
							  <option value="Ms.Laura Brown">Ms.Laura Brown</option>
							  <option value="Mr.Michael Chiu">Mr.Michel Chiu</option>
							  <option value="Ms.Joanne Davies">Ms Joanne Davies</option>
							  <option value="Mr.Anthony Flynn">Mr.Anthony Flynn</option>
							  <option value="Mr.Kristian French">Mr.Kristian French</option>
							  <option value="Mr.Rhodri George">Mr.Rhodri George</option>
							  <option value="Ms.Wendy Ho">Ms.Wendy Ho</option>
							  <option value="Mr.Neil Hodgson">Mr.Neil Hodgson</option>
							  <option value="Mr.James Lewis">Mr.James Lewis</option>
							  <option value="Ms.Laura Ryan">Ms.Laura Ryan</option>
							  <option value="Mr.Lau-Cuang Ta">Mr.Lau-Cuang Ta</option>
							  <option value="Mr.Daniel Worrall">Mr.Daniel Worrall</option>
							 <option value="#" disabled>Technology and ICT</option>				
							  <option value="Mr.Paul Clarke">Mr.Paul Clarke</option>
							  <option value="Mr.Richard Atkinson">Mr.Richard Atkinson</option>
							  <option value="Ms.Rebecca Cottam">Ms.Rebecca Cottam</option>		
							  <option value="Ms.Jutka Czirok">Ms.Jutka Czirok</option>
							  <option value="Mr.Alan Dickson">Mr.Alan Dickson</option>
							  <option value="Ms.Victoria Harvey">Ms.Victoria Harvey</option>
							  <option value="Ms.Alison Marshall">Ms.Alison Marshall</option>
							  <option value="Mr.Gareth Morgan">Mr.Gareth Morgan</option>
							  <option value="Ms.Kathryn Reed">Ms.Kathryn Reed</option>
							  <option value="Mr.David Scott">Mr.David Scott</option>
							 
							  <option value="#" disabled>Support Staff</option>							  
							  <option value="Ms.Shwan Law">Ms.Shwan Law</option>
							  <!-- General Office -->
							  <option value="Ms.Vivian Wong">Ms.Vivian Wong</option>
							  <option value="Ms.Jane Yao">Ms.Jane Yao</option>
							  <option value="Ms.Patricia Lai">Ms.Patricia Lai</option>
							  <!-- Finance Office -->
							  <option value="Ms.Maureen Tam">Ms.Maureen Tam</option>
							  <option value="Ms.Siew Poh Lee">Ms.Siew Poh Lee</option>
							  <!-- Resources Office -->
							  <option value="Ms.Daniel Wong">Ms.Daniel Wong</option>		
							  <option value="Ms.Pell Lo">Ms.Pell Lo</option>
							  <option value="TBA">TBA</option>
							  <option value="Ms.Anita Law">Ms.Anita Law</option>
							  <!-- Senior School -->
							  <option value="Ms.Kin Hoang">Ms.Kin Hoang</option>
							  <option value="Ms.Julie Slater">Ms.Julie Slater</option>
							  <!-- Middle School -->
							  <option value="Ms.Allie Cho">Ms.Allie Cho</option>
							  <!-- Lower School -->
							  <option value="Ms.Elaine Cheuk">Ms.Elaine Cheuk</option>
							  <!-- Examinations and Higher Education -->
							  <option value="Ms.Iris Wan">Ms.Iris Wan</option>		
							  <option value="Ms.Minnie Cheung">Ms.Minnie Cheung</option>
							  <!-- Library and Learning Centre -->
							  <option value="Ms.Sonia Hansen">Ms.Sonia Hansen</option>
							  <option value="Ms.Jill Wong">Ms.Jill Wong</option>
							  <!-- Medical -->
							  <option value="TBA">TBA</option>
							  <!-- IT -->
							  <option value="Mr.Quincy Cheng">Mr.Quincy Cheng</option>
							  <option value="Mr.Keith Lam">Mr.Keith Lam</option>
							  <option value="Ms.Grace Tsui">Ms.Grace Tsui</option>
							  <option value="Mr.Eric Liu">Mr.Eric Liu</option>		
							  <option value="Mr.Jonathan Ching">Mr.Jonathan Ching</option>
							  <option value="Mr.Kwan Ping Siu">Mr.Kwan Ping Siu</option>
							  <!-- Science -->
							  <option value="Mr.Winson Chow">Mr.Winson Chow</option>
							  <option value="Mr.Peter Sheung">Mr.Peter Sheung</option>
							  <option value="Mr.Thai Ho">Mr.Thai Ho</option>
							  <option value="Ms.Janice Lee">Ms.Janice Lee</option>	
							  <option value="Ms.Yako Liu">Ms.Yako Liu</option>
							  <option value="TBA">TBA</option>		
							  <option value="Mr.Leon Ching">Mr.Leon Ching/option>
							  <option value="Mr.Ray Lai">Mr.Ray Lai</option>
							  <!-- Deisgn and Technology -->
							  <option value="Mr.Philip Sze">Mr.Philip Sze</option>
							  <option value="Mr.Albert Sze">Mr.Albert Sze</option>
							  <!-- Food Technology -->
							  <option value="Ms.Ruth Xu">Ms.Ruth Xu</option>
							  <option value="Ms.Vicki Chau">Ms.Vicki Chau</option>
							  <!--Educational Assistant  -->
							  <option value="Mr.Henry Wong">Mr.Henry Wong</option>
							  <option value="Ms.C Y Tsang">Ms.C Y Tsang</option>		
							  <option value="Ms.Rie Nomoto">Ms.Rie Nomoto</option>
							  <option value="Mr.Vincent Liu">Mr.Vincent Liu</option>
							  <option value="Ms.Angel Chau">Ms.Angel Chau</option>
							  <option value="TBA">TBA</option>
							  <option value="Mr.Richard Carman">Mr.Richard Carman</option>
							  <option value="Ms.Vivien Grogan">Ms.Vivien Grogan</option>
							  <option value="Ms.Katy Scott">Ms.Katy Scott</option>
							  <option value="Mr.Jamie Bilbow">Mr.Jamie Bilbow</option>		
							  <option value="Ms.Stella Ni">Ms.Stella Ni</option>
							  <!-- Facilities -->
							  <option value="Mr.Benjamin Chan">Mr.Benjamin Chan</option>
							  <option value="Mr.Simon Li">Mr.Simon Li</option>
							  <option value="Ms.Alison Marshall">Ms.Alison Marshall</option>
							  <!-- Life Guards -->
							  <option value="Mr.Alex Law">Mr.Alex Law</option>
							  <option value="Mr.Joe Lee">Mr.Joe Lee</option>
							  <!-- Cleaning Team -->
							  <option value="Ms.Sau Yuk Elsa Chan">Ms.Sau Yuk Elsa Chan</option>
							  <option value="Ms.Sau Kuen Ip">Ms.Sau Kuen Ip</option>		
							  <option value="Ms.Sui Chu Li">Ms.Sui Chu Li</option>
							  <option value="Ms.Tjhun Siat Pui">Ms.Tjhun Siat Pui</option>
							  <!-- ISS Facilities Services -->
							  <option value="Mr.Chung On Yeung">Mr.Chung On Yeung</option>
							  <!-- Security -->
							  <option value="TBA">TBA</option>
							  <!-- Non-School hour service -->
							  <option value="Phabulous Pest Control & Cleaning Limited">Phabulous Pest Control & Cleaning Limited</option>
							  <option value="Ngai Hoi Swimming Services Limited">Ngai Hoi Swimming Services Limited</option>						  
							</select>
					      	<?php if (!empty($teacherError)): ?>
					      		<span class="help-inline"><?php echo $teacherError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
					    <label class="control-label">Email Address</label>
					    <div class="controls">
					      	<input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>">
					      	<?php if (!empty($emailError)): ?>
					      		<span class="help-inline"><?php echo $emailError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($departmentError)?'error':'';?>">
					    <label class="control-label">Department Name</label>
					    <div class="controls">
					      	<select name="department">
					      	  <option value="#" disabled>Select...</option>
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
					      	<?php if (!empty($teacherError)): ?>
					      		<span class="help-inline"><?php echo $teacherError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
					    <label class="control-label">Email Address</label>
					    <div class="controls">
					      	<input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>">
					      	<?php if (!empty($emailError)): ?>
					      		<span class="help-inline"><?php echo $emailError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  

					  </div>
					    <!-- amount -->
					    <div class="control-group <?php echo !empty($amountError)?'error':'';?>">
						    <label class="control-label">Amount Requested</label>
						    <div class="controls">
						      	<input name="amount" type="text" placeholder="Amount requested" value="<?php echo !empty($amount)?$amount:'';?>">
						      	<?php if (!empty($amountError)): ?>
						      		<span class="help-inline"><?php echo $amountError;?></span>
						      	<?php endif;?>
						    </div>
					    </div>
					    <!-- reason -->

					    <div class="control-group <?php echo !empty($reasonError)?'error':'';?>">
						    <label class="control-label">Reason for budget request</label>
						    <div class="controls">
						      	<textarea name="reason" placeholder="Reason for Budget Request" rows="5" cols="80" value="<?php echo !empty($reason)?$reason:'';?>"></textarea>
						      	<?php if (!empty($reasonError)): ?>
						      		<span class="help-inline"><?php echo $reasonError;?></span>
						      	<?php endif;?>
						    </div>
						</div>
					  
					  <!-- status -->
					  <div class="control-group <?php echo !empty($statusError)?'error':'';?>">
					    <div class="controls">
					      	<input name="status" type="hidden" value="Requested" >
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
