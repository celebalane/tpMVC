<?php
	$message = [];
	if(isset($_POST) && !empty($_POST)){
		//Vérifications
		$donnee=[];
		if (isset($_POST['lastName']) && $_POST['lastName']!='' && preg_match("/^[a-zA-Zéè ]*$/",$_POST['lastName'])) {
			$donnee['lastName'] = htmlspecialchars($_POST['lastName']);
		}else{
			$message['danger'][]= 'Veuillez indiquer le nom';
		}

		if (isset($_POST['firstName']) && $_POST['firstName']!='' && preg_match("/^[a-zA-Zéè ]*$/",$_POST['firstName'])) {
			$donnee['firstName'] = htmlspecialchars($_POST['firstName']);
		}else{
			$message['danger'][]= 'Veuillez indiquer le prénom';
		}

		if (isset($_POST['birthDate']) && $_POST['birthDate']!='') {
			$donnee['birthDate'] = htmlspecialchars($_POST['birthDate']);
		}else{
			$message['danger'][]= 'Veuillez indiquer une date de naissance';
		}

		if (isset($_POST['adress']) && $_POST['adress']!='') {
			$donnee['adress'] = htmlspecialchars($_POST['adress']);
		}else{
			$message['danger'][]= 'Veuillez indiquer une adresse';
		}

		if (isset($_POST['zipCode']) && $_POST['zipCode']!='' && preg_match("/^[0-9]*$/",$_POST['zipCode'])) {
			$donnee['zipCode'] = htmlspecialchars($_POST['zipCode']);
		}else{
			$message['danger'][]= 'Veuillez indiquer un code postal valide';
		}

		if (isset($_POST['phoneNumber']) && $_POST['phoneNumber']!='' && preg_match("/^[0-9]*$/",$_POST['phoneNumber'])) {
			$donnee['phoneNumber'] = htmlspecialchars($_POST['phoneNumber']);
		}else{
			$message['danger'][]= 'Veuillez indiquer un numéro de téléphone valide';
		}

		if (isset($_POST['departmentId']) && $_POST['departmentId']!='') {
			$donnee['departmentId'] = htmlspecialchars($_POST['departmentId']);
		}else{
			$message['danger'][]= 'Veuillez choisir un service';
		}
		//Ajout dans la table users
		if (!isset($message['danger'])){

			App::getInstance()->getTable('users')->insert($donnee);

			$message['success'][] = "L'utilisateur a bien été ajouté";
		}

	}

?>

<div class="row" id="formulaire">
	<h2>Ajout employé</h2>
	<ul>
	<?php 
		foreach ($message as $key => $tableau) {
				foreach ($tableau as  $value) {
				echo "<li class=".$key.">$value</li>";
			}
		}
	?>
	</ul>
	<form method="post" action="">
		<div class="form-group col-md-6">
    		<label for="lastName">Nom</label>
    		<input type="text" class="form-control" name="lastName" id="lastName" placeholder="Nom" required>
  		</div>
  		<div class="form-group col-md-6">
    		<label for="firstName">Prénom</label>
    		<input type="text" class="form-control" name="firstName" id="firstName" placeholder="Prénom" required>
  		</div>
  		<div class="form-group col-md-6">
    		<label for="birthDate">Date de naissance</label>
    		<input type="date" class="form-control" name="birthDate" id="birthDate" required>
  		</div>
  		<div class="form-group col-md-6">
    		<label for="adress">Adresse</label>
    		<input type="text" class="form-control" name="adress" id="adress" placeholder="Adresse" required>
  		</div>
  		<div class="form-group col-md-6">
    		<label for="zipCode">Code postal</label>
    		<input type="text" class="form-control" name="zipCode" id="zipCode" placeholder="00000" maxlength="5" required>
  		</div>
  		<div class="form-group col-md-6">
    		<label for="phoneNumber">Téléphone</label>
    		<input type="text" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="0648567944" maxlength="10" required>
  		</div>
  		<div class="col-md-3">
  		<label>Service</label>
		<select name="departmentId" class="form-control">
			<option value="">--Service--</option>
				<?php

					foreach (App::getInstance()->getTable('departments')->all() as $department){
				
                    	echo '<option value="'.$department->id.'" >'.$department->departmentName.'</option>';
                	}
            	?> 
        </select>
        </div>
        <div class="text-right">
  			<button type="submit" class="btn btn-default">Ajouter</button>
  		</div>
	</form>
	
</div>


<div class="text-center">
	<a href="index.php?p=home.php" class="btn btn-default" role="button">Retour</a>
</div>