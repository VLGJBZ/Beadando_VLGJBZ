<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>Page access is forbidden!</h1>
<?php else : ?>

	<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addWorker'])) {
		$postData = [
			'first_name' => $_POST['first_name'],
			'last_name' => $_POST['last_name'],
			'email' => $_POST['email'],
			'gender' => $_POST['gender'],
			'nationality' => $_POST['nationality'],
			'tipus' => $_POST['tipus']
		];

		if(empty($postData['first_name']) || empty($postData['last_name']) || empty($postData['email']) || empty($postData['nationality']) || empty($postData['tipus']) || $postData['gender'] < 0 && $postData['gender'] > 2) {
			echo "Hiányzó adat(ok)!";
		} else if(!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
			echo "Hibás email formátum!";
		} else {
			$query = "INSERT INTO workers (first_name, last_name, email, gender, tipus, nationality ) VALUES (:first_name, :last_name, :email, :gender, :tipus, :nationality)";
			$params = [
				':first_name' => $postData['first_name'],
				':last_name' => $postData['last_name'],
				':email' => $postData['email'],
				':gender' => $postData['gender'],
				':nationality' => $postData['nationality'],
				':tipus' => $postData['tipus']

			];
			require_once DATABASE_CONTROLLER;
			if(!executeDML($query, $params)) {
				echo "Hiba az adatbevitel során!";
			} header('Location: ?P=list_worker');
		}
	}
	?>

	<form method="post">
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="workerFirstName">Keresztnév</label>
				<input type="text" class="form-control" id="workerFirstName" name="first_name">
			</div>
			<div class="form-group col-md-6">
				<label for="workerLastName">Vezetéknév</label>
				<input type="text" class="form-control" id="workerLastName" name="last_name">
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="workerEmail">Email</label>
				<input type="email" class="form-control" id="workerEmail" name="email">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
		    	<label for="workerGender">Nem</label>
		    	<select class="form-control" id="workerGender" name="gender">
		      		<option value="0">Nő</option>
		      		<option value="1">Férfi</option>
		      		<option value="2">Egyéb</option>
		    	</select>
		  	</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="workerNationality">Nemzetiséged</label>
				<input type="text" class="form-control" id="workerNationality" name="nationality">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="worker">Beosztása</label>
				<input type="text" class="form-control" id="workerBeosztas" name="tipus">
			</div>
		</div>

		<button type="submit" class="btn btn-primary" name="addWorker" onclick="return confirm('Tényleg hozzá akarod adni?');"> Hozzáadás</button>
	</form>
<?php endif; ?>