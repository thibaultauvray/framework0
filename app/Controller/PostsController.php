<?php
class PostsController extends AppController {
    var $name = 'Posts';
    public $paginate = array(
        'limit' => 10,
        'group' => 'post.id',
         'order' => array(
            'Post.date' => 'asc'
        )
    );

   
    function index(){
    	$this->set("title", "Poulet");
        $listePost = $this->paginate('Post');
        $this->set("posts", $listePost);
        if ($this->request->query('down'))
        {
            $id = $this->request->query('id');
            if ($this->request->query('up') != null || $id == null || $this->request->query('down') != 1)
            {
                $this->Session->setFlash("Une erreur a été détectée", "error");
            }
            else if(!AuthComponent::user('user'))
            {
                $this->Session->setFlash("Vous devez etre connecte pour voter", "notif"); 
            }
            else
            {
                $this->Post->recursive = 1 ;
                $this->updateVote($id, -1);                          
                $this->redirect($this->referer());
                $this->Session->setFlash("Votre vote a bien ete pris en compte", "notif");

            }
        }
        if ($this->request->query('up'))
        {
            $id = $this->request->query('id');
            if ($this->request->query('down') != null || $id == null || $this->request->query('up') != 1)
            {
                $this->Session->setFlash("Une erreur a été détectée", "error");
            }
            else if(!AuthComponent::user('user'))
            {
                $this->Session->setFlash("Vous devez etre connecte pour voter", "error"); 
            }
            else
            {
                $this->Post->recursive = 1 ;
                $this->updateVote($id, 1);
                $this->redirect($this->referer());
                $this->Session->setFlash("Votre vote a bien ete pris en compte", "notif");


            }
        }
        
    }
    public function count_neg($id_neg, $count)
    {
        $total = $this->Post->Vote->find('count', array(
            'conditions' => array('Vote.Post_id' => $id_neg,
                                    'Vote.vote' => $count)));
        return ($total);
    }
     public function updateVote($id, $count)
    {
       $votee = $this->Post->find('first', array(
           'conditions' => array(
               'vote.Post_id' => $id,
                'vote.user_id' => $this->Session->read('Auth.User.id')
        )));
       $inv = $count * -1;
       if ($votee['Vote']['vote'] == $inv || $votee['Vote'] == null)
       {
            $ide = $votee['Vote']['id'];
            $this->Post->Vote->id = $ide;
            $this->Post->Vote->save(array('vote' => $count,
                'Post_id' => $id,
                'user_id' => $this->Session->read('Auth.User.id'))); 
        }
      
    }

  
    public function top()
    {
        $params=array(
            'recursive' => 1,
            'group' => 'post.id',
            'order' => 'total desc',
            'fields' => array('*', 'SUM(vote) as total'),
            'group' => 'post.id');

        $total = $this->Post->find('all', $params);
        $this->set('posts', $total);
    }

    public function random()
    {
        $data = $this->Post->find('first', array(
            'order' => 'RAND()',
            'group' =>'post.id'
            ));
        $this->set("posts", $data);
    }

    /*          /*
    **  ADMIN   **
    **          */          

    public function view_posts()
    {
            $this->layout = 'admin';

        if($this->Session->read('Admin.admin') == null)
        {
            $this->Session->setFlash("Vous n'avez rien a faire ici, oust !", "notif");
            $this->redirect(array('controller' => 'Admin', 'action' => 'index'));
        }
        else{
            $lstPo = $this->Post->find("all");
            $this->set("posts", $lstPo);
        }   
    }

    public function create()
    {
            $this->layout = 'admin';

        if($this->Session->read('Admin.admin') == null)
        {
            $this->Session->setFlash("Vous n'avez rien a faire ici, oust !", "notif");
            $this->redirect(array('controller' => 'Posts', 'action' => 'view_posts'));
        }
        else
        {
            if ($this->Session->read('roles.create') == 0)
                  $this->redirect(array('controller' => 'Post', 'action' => 'view_posts'));
            if ($this->request->is('post'))
            {
                $d = $this->request->data;
                debug($d);
                $date = date("Y-m-d");
               if((!(empty($d['Create']['image_file']['tmp_name']))) &&
                    $d['Create']['image_file']['type'] == 'image/gif' &&
                    (!(empty($d['Create']['titre']))))
               {
                    debug($d['Create']['image_file']['type']);
                    $this->Session->setFlash("dsa", "notif");
                    move_uploaded_file($d['Create']['image_file']['tmp_name'], IMAGES . $this->Post->id . $d['Create']['image_file']['size'] . ".gif");
                    $this->Post->save(array('titre' => $d['Create']['titre'], 'img' => "/img/" . $this->Post->id . $d['Create']['image_file']['size'] . ".gif", 'texte' => $d['Create']['texte'], 'id_auteur' => $this->Session->read('Admin.id'), 'date' => date("Y-m-d")));
                    $this->Session->setFlash("Votre post a bien été crée", "notif");
                    $this->redirect(array('controller' => 'posts', 'action' => 'view_posts'));
               }
               else
               {
                    $this->Session->setFlash("Merci de bien fournir une image au format gif", "error");
               }
            }
        }
    }
    public function single($id)
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $da = $this->Post->find('first', array(
                'conditions' => array('post.id' => $id) 
            ));
        if ($da == null)
        {
            $this->Session->setFlash("Une erreur est survenue", "error");
        }
        else
        {
            $this->set("single", $da);
        }
    }
    public function update()
    {
            $this->layout = 'admin';

        if($this->Session->read('Admin.admin') == null)
        {
            $this->Session->setFlash("Vous n'avez rien a faire ici, oust !", "notif");
            $this->redirect(array('controller' => 'Admin', 'action' => 'index'));
        }
        else
        {
            if ($this->Session->read('roles.update') == 0)
            {
                 $this->redirect(array('controller' => 'posts', 'action' => 'view_posts'));
            }
            else
            {
               $id_del = $this->params['named']['id']; 
               $data = $this->Post->find("first", array(
                    'conditions' => array('post.id' => $id_del)
                ));
               $this->set("data", $data);
               $this->Post->id = $id_del;
                if ($this->request->is('post'))
                {
                    $da = $this->request->data;
                    debug($da);
                    if (empty($da['Update']['image_file']['tmp_name']))
                    {

                        $this->Post->save(array('titre' => $da['Update']['titre'], 'texte' => $da['Update']['texte']));
                        $data = $this->Post->find("first", array(
                                'conditions' => array('post.id' => $id_del)
                         ));
                        $this->set("data", $data);
                        $this->Session->setFlash("Votre post a bien été mis a jour", "notif");
                        $this->redirect(array('controller' => 'posts', 'action' => 'view_posts'));
                    }
                    else if ((!(empty($da['Update']['image_file']['tmp_name']))))
                    {
                        if ($da['Update']['image_file']['type'] == 'image/gif')
                        {
                            move_uploaded_file($da['Update']['image_file']['tmp_name'], IMAGES . $this->Post->id . $da['Update']['image_file']['size'] . ".gif");
                            $this->Post->save(array('titre' => $da['Update']['titre'], 'img' => "/img/" . $this->Post->id . $da['Update']['image_file']['size'] . ".gif", 'texte' => $da['Update']['texte'], 'id_auteur' => $this->Session->read('Admin.id'), 'date' => date("Y-m-d")));
                            $data = $this->Post->find("first", array(
                                    'conditions' => array('post.id' => $id_del)
                             ));
                            $this->set("data", $data);
                            $this->Session->setFlash("Votre post a bien été mis a jour", "notif");
                            $this->redirect(array('controller' => 'posts', 'action' => 'view_posts'));
                        }
                    }
                    else
                    {
                        $this->Session->setFlash("Veuillez remplir un titre", "notif");
                    }
                }
            }
        }
    }
    public function delete()
    {
            $this->layout = 'admin';

        if($this->Session->read('Admin.admin') == null)
        {
            $this->Session->setFlash("Vous n'avez rien a faire ici, oust !", "notif");
            $this->redirect(array('controller' => 'Admin', 'action' => 'index'));
        }
        else
        {
            if ($this->Session->read('roles.delete') == 0)
            {
                 $this->redirect(array('controller' => 'posts', 'action' => 'view_posts'));
            }
            else
            {
                $id_del = $this->params['named']['id'];
                if ($this->request->is('post'))
                {
                    $d = $this->request->data;
                    if($d['Delete']['confirm'] == "non")
                    {
                        $this->redirect(array('controller' => 'posts', 'action' => 'view_posts'));
                    }
                    else{
                        $this->Session->setFlash("Votre post a bien été supprimé", "notif");
                        $this->Post->delete($id_del, false);
                        $this->redirect(array('controller' => 'posts', 'action' => 'view_posts'));
                    }
                    debug($d);

                }

            }
        }
    }

}
?>