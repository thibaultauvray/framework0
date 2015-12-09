<?php

class Post extends AppModel
{
    var $name = 'Post';
    public $useTable = 'Posts';
    public $belongsTo = array(
        'Admins' => array(
            'foreignKey' => false,
             'conditions' => array(
                 'post.id_auteur = admins.id'
             ))
        );
    public $hasOne = array(
            'Vote');
}

?>