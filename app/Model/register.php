<?php

class User extends AppModel
{
	public $validate = array(
			'username' =>array(
					array(
						'rule' => 'alphanumeric',
						'required' => true,
						'allowEmpty' => false,
						'message' => "Veuillez remplir votre pseuedo"
						)
						)
			);
}
?>