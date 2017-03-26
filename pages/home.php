<?php
	if(isset($_GET['delete'])&& $_GET['delete']== "delete"){
		App::getInstance()->getTable('users')->delete($_GET['id']);
		$result="L'utilisateur a bien été supprimé";
	}else{
		$result="";
	}
?>
	<div class="row">
		<h1 class="text-center">Liste des employés</h1>
		<p class="success" role="alert"><strong>
		<?php
			echo $result;
		?>
		</strong>
		</p>
		<div class="col-md-2">
		<!--Tri des services-->
			<h2>Filtre</h2>
			<form methode="get" action="">
				<label>Tri par service</label>
				<select name="choix">
					<option value="0">Tous les services</option>
					<?php

						foreach (App::getInstance()->getTable('departments')->all() as $department){
				
                    		echo '<option value="'.$department->id.'" >'.$department->departmentName.'</option>';
                		}
            		?> 
             	</select>
             	<button type="submit" name="idDepartment" id="choix">Valider</button>     
			</form>
		</div>
		<!--Affichage des employés-->
		<table class="col-md-10">
			<thead>
				<tr>
					<td>Nom</td>
					<td>Prénom</td>
					<td>Date de naissance</td>
					<td>Adresse</td>
					<td>Code postal</td>
					<td>Téléphone</td>
					<td>Service</td>
			</thead>
			<?php
				if(isset($_GET['choix'])&& $_GET['choix']!=0){
					
					foreach (App::getInstance()->getTable('users')->joinSelection($_GET['choix']) as $user){          //Affiche selon le service selectionné
						echo '<form methode="get" action="">';
						echo '<tr>';
	                    	echo '<td>'.$user->lastName.'</td>';
	                    	echo '<td>'.$user->firstName.'</td>';
	                    	echo '<td>'.$user->birthDate.'</td>';
	                    	echo '<td>'.$user->adress.'</td>';
	                    	echo '<td>'.$user->zipCode.'</td>';
	                    	echo '<td>'.$user->phoneNumber.'</td>';
	                    	echo '<td>'.$user->departmentName.'</td>';
	                    	echo '<td><input type="checkbox" value="suppr" >Supprimer</td>';      
	                    	echo '<td><button type="submit" name="id" value="'.$user->id.'" >Valider</button></td>';
                  		echo '</tr>';
                  		echo '</form>'; 
					}
				}else{

					foreach (App::getInstance()->getTable('users')->join() as $user){                               //Affiche tous les services
						echo '<form>';
						echo '<tr>';
	                    	echo '<td>'.$user->lastName.'</td>';
	                    	echo '<td>'.$user->firstName.'</td>';
	                    	echo '<td>'.$user->birthDate.'</td>';
	                    	echo '<td>'.$user->adress.'</td>';
	                    	echo '<td>'.$user->zipCode.'</td>';
	                    	echo '<td>'.$user->phoneNumber.'</td>';
	                    	echo '<td>'.$user->departmentName.'</td>';
	                    	echo '<td><input type="checkbox" value="delete" name="delete">Supprimer</td>';      
	                    	echo '<td><button type="submit" name="id" value="'.$user->id.'" >Valider</button></td>';
                  		echo '</tr>';
                  		echo '</form>'; 
					}
				}
			?>
		</table>
	</div>
	<div class="text-center">
		<a href="index.php?p=add" class="btn btn-default" role="button">Ajouter un employé</a>
	</div>
