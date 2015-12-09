<?php

class Role extends AppModel
{
	public $useTable = 'roles';

	public $validate = array(
			'name' => array(
					array(
						'rule' => 'alphanumeric',
						'required' => true,
						'allowEmpty' => false,
						'message' => "Veuillez remplir un nom"
					),
					array(
						'rule' => 'isUnique',
						'message' => "Ce nom est deja pris"
						)

			));
}

?>