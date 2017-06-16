<?php 
	//error_reporting(0);
	require 'db/connect.php';
	require 'functions/security.php';
	
	$records = array();
	if(!empty($_POST)){
		if(isset($_POST['first_name'], $_POST['last_name'], $_POST['bio'])){
			$first_name 	= trim($_POST['first_name']);
			$last_name 	= trim($_POST['last_name']);
			$bio 				= trim($_POST['bio']);
			
			if(!empty($first_name) && !empty($last_name) && !empty($bio)){
				
				$insert = $db->prepare("
				INSERT INTO people(first_name, last_name, bio, created)
				VALUES(?, ?, ?, NOW())
				");
				
				$insert->bind_param('sss', $first_name, $last_name, $bio);
				
				if($insert->execute()){
					header('Location: index.php');
					die();
				}
				
			}
			
		}
	}
	
	
	if($results = $db->query("SELECT * FROM people")){
			if($results->num_rows){
				while($row=$results->fetch_object()){
					$records [] = $row;
				}
				$results->free();
			}
	}

	
?>

<!DOCTYPE html>
<html>
	<head>
		
		
		  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>People</title>
		<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	<body>
	
		<div class="container">
			<div class="jumbotron">
				<h3>DressApp Accounts</h3>
			</div>   
		</div>
		
		
		<div class="container">
			<?php
			if(!count($records)){
				echo 'No records';
			} else {
			?>

			<table class="table table-condensed">
			  <tr>
				<th>Firstname</th>
				<th>Lastname</th> 
				<th>Bio</th>
				<th>Created</th>
			  </tr>
			  
			  <?php 
				foreach($records as $r){
			  ?>
					  <tr>
						<td><?php echo escape($r->first_name); ?></td>
						<td><?php echo escape($r->last_name); ?></td>
						<td><?php echo escape($r->bio); ?></td>
						<td><?php echo escape($r->created); ?></td>
					  </tr>
			  <?php
			}
			?>
			</table>
			<?php
			}
			?>
			  
		</div>
		
		
		<hr>
		
		<div class="container">
		<div class ="row">
			<div class="col-md-12">
					<form action="" method="post">
						<div class="field">
								<label  for="first_name">Firstname</label>
								<input class="form-control" id="first_name" type="text" name="first_name" autocomplte="off">
						</div>
						
						<div class="field">
								<label for="last_name">Lastname</label>
								<input class="form-control" id="last_name" type="text" name="last_name" autocomplte="off">
						</div>
						
						<div class="field">
								<label for="bio">Bio</label>
								<textarea class="form-control" id="bio" name="bio"></textarea>
						</div>
						<br>
						
						<input class="btn btn-primary" type="submit" value="insert">
					
				</form>
					
			</div>
		</div>
			
		</div>
		
		
	</body>
</html>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	