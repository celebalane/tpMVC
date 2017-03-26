<?php
namespace App\Table;

use Core\Table\Table;


/**
* 
*/
class UsersTable extends Table
{
	protected $table='users';
    //Jointure des deux tables
	public function join(){
		return $this->query("
							SELECT users.id,users.firstName,users.lastName,users.birthDate,users.adress,users.zipCode,users.phoneNumber,departments.departmentName 
							FROM ".$this->table." INNER JOIN departments ON users.departmentId = departments.id"
							);
	}
	//Jointure avec selection selon l'id
	public function joinSelection($id){
		return $this->query("
							SELECT users.id,users.firstName,users.lastName,users.birthDate,users.adress,users.zipCode,users.phoneNumber,departments.departmentName 
							FROM ".$this->table." INNER JOIN departments ON users.departmentId = departments.id WHERE departmentId =".$id.""
							);
	}
	//Insertion des données du formulaire (c'est le query qui gère le prepare et l execute)
	public function insert($donnees)
	{
		 return $req = $this->query("
		 						INSERT INTO " .$this->table."
								SET lastName  = :lastName,
								firstName 	  = :firstName,
								birthDate 	  = :birthDate,
								adress		  = :adress,
								zipCode 	  = :zipCode,
								phoneNumber	  = :phoneNumber,
								departmentId  = :departmentId", $donnees
							);
		 
	}

}