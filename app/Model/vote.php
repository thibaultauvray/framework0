<?php

class Vote extends AppModel
{
	public $belongsTo = array(
        'User' => array(
            'foreignKey' => false,
             'conditions' => array(
                 'vote.user_id = user.id'
             )),
        'Post' => array(
        	'foreignKey' => false,
        	'conditions' => array(
        		'post.id = vote.Post_id'
        		)
        )
        );
}
?>