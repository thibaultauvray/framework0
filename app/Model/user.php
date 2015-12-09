<?php

class User extends AppModel
{
	public $validate = array(
			'user' => array(
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
			'email' => array(
					array(
						'rule' => 'email',
						'required' => true,
						'allowEmpty' => false,
						'message' => "Veuillez remplir votre mail"
						),
					array(
						'rule' => 'isUnique',
						'message' => "Ce mail est deja pris"
						)
					),
			'passwd' => array(
						'rule' => 'notEmpty',
						'message' => 'Veuillez renseigner votre mot de passe',
						'allowEmpty' => false

					)
			);
	public function send($d, $user)
	{
		App::uses('CakeEmail', 'Network/Email');
		debug($user);
		foreach ($user as $key => $value) {
			$mail = new CakeEmail();
			$mail->to($value['User']['email'])
				 ->from('tauvray@student.42.fr')
				 ->subject($d['Envoyer']['Objet']);
			$mail->send($d['Envoyer']['Message']);

		}
		//$mail
		return false;
	}
}
?>