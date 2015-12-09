<?php

class Admin extends AppModel
{
    var $name = 'Admin';
    public $useTable = 'admins';
    public $hasOne = array(
        'roles' => array(
            'foreignKey' => false,
             'conditions' => array(
                 'admin.role = roles.id'
             ))
        );
    public $validate = array(
			'admin' => array(
					array(
						'rule' => 'alphanumeric',
						'required' => true,
						'allowEmpty' => false,
						'message' => "Veuillez remplir votre pseuedo"
						),
					array(
						'rule' => 'isUnique',
						'message' => "Ce pseudo est deja pris"
						)
					),
			'passwd' => array(
					array(
						'rule' => 'notEmpty',
						'message' => 'Veuillez renseigner votre mot de passe',
						'allowEmpty' => false
						)
				),
			'email' => array(
					array(
						'rule' => 'notEmpty',
						'message' => 'Veuillez renseigner votre mot de passe',
						'allowEmpty' => false

						),
					array(
						'rule' => 'isUnique',
						'message' => "Ce pseudo est deja pris"
						)
				)
	);

}

?>