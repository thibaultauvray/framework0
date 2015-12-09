<?php
class UsersController extends AppController {
    var $name = 'Users';
    public $components = array(
            'Auth' => array('authenticate' => array('Form' => array( 'userModel' => 'User',
                                    'fields' => array(
                                                        'username' => 'user',
                                                        'password' => 'passwd'
                                                        )
                                                )
                            ),
                    'authorize' => array('Controller'),
                    'loginAction' => array('controller' => 'users', 'action' => 'login'),
                    'loginRedirect' => array('controller' => 'home', 'action' => 'index'),
                    'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
                    'authError' => 'You don\'t have access here.',
            ),
        );
       function index(){
    	if ($this->request->is('post'))
        {
            $d = $this->request->data;
            $d['User']['id'] = null;
            if (!empty($d['User']['passwd']))
            {
                $d['User']['passwd'] = Security::hash($d['User']['passwd'],null,true);
            }
            if ($this->User->save($d, true, array('news','user', 'email', 'passwd')))
            {
                $d['User']['id'] = $this->User->id;
                $this->Session->setFlash("Votre compte a bien ete créé", "notif");
                $this->Auth->login($d['User']);
            }
            else
            {
                
            }
        }
    }

    function delete()
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
                 $this->redirect(array('controller' => 'users', 'action' => 'view_users'));
            }
            else
            {
                $id_del = $this->params['named']['id'];
                if ($this->request->is('post'))
                {
                    $d = $this->request->data;
                    if($d['Delete']['confirm'] == "non")
                    {
                        $this->redirect(array('controller' => 'users', 'action' => 'view_users'));
                    }
                    else{
                        $this->Session->setFlash("L'utilisateur a bien été supprimé", "notif");
                        $this->User->delete($id_del, false);
                        $this->redirect(array('controller' => 'users', 'action' => 'view_users'));
                    }
                }

            }
        }
    }
    function send_mail()
    {
            $this->layout = 'admin';

        if($this->Session->read('Admin.admin') == null)
        {
            $this->Session->setFlash("Vous n'avez rien a faire ici, oust !", "notif");
            $this->redirect(array('controller' => 'Admin', 'action' => 'index'));
        }
        else
        {
            $user = $this->User->find('all', array(
                    'conditions' => array('news' => 1)
                ));
            $this->set("user", $user);
            if ($this->request->is('post'))
            {
                $d = $this->request->data;
                $this->User->send($d, $user);
                $this->Session->setFlash("Votre mail a bien été envoyé", "notif");
                $this->redirect(array('controller' => 'users', 'action' => 'view_users'));
            }
            
        }
    }
    
    function create()
    {
            $this->layout = 'admin';

        if($this->Session->read('Admin.admin') == null)
        {
            $this->Session->setFlash("Vous n'avez rien a faire ici, oust !", "notif");
            $this->redirect(array('controller' => 'Admin', 'action' => 'index'));
        }
        else
        {
            if ($this->Session->read('roles.create') == 0)
            {
                 $this->redirect(array('controller' => 'Users', 'action' => 'view_users'));
            }
            else
            {
            if ($this->request->is('post'))
            {
                    $d = $this->request->data;
                    $d['User']['id'] = null;
                    if (!empty($d['User']['passwd']))
                    {
                        $d['User']['passwd'] = Security::hash($d['User']['passwd'],null,true);
                    }
                    if ($this->User->save($d, true, array('news','user', 'email', 'passwd')))
                    {
                        $d['User']['id'] = $this->Post->id;
                        $this->Session->setFlash("Le compte a bien été crée", "notif");
                        $this->redirect(array('controller' => 'users', 'action' => 'view_users'));
                    }
                    else
                    {
                        $this->Session->setFlash("Probleme huston", "notif");

                    }
                }
            }
        }
    }
    function update()
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
                 $this->redirect(array('controller' => 'Users', 'action' => 'view_users'));
            }
            else
            {
                $id_del = $this->params['named']['id']; 
               $data = $this->User->find("first", array(
                    'conditions' => array('user.id' => $id_del)
                ));
               $this->set("data", $data);
               $this->User->id = $id_del;
               if ($this->request->is('post'))
               {
                    $d = $this->request->data;
                    $this->User->save(array('user' => $d['Update']['Login'], 'email' => $d['Update']['Email'], 'news' => $d['Update']['Newletter']));
                    $this->Session->setFlash("L'utilisateur a bien ete mis a jour", "notif");
                    $this->redirect(array('controller' => 'Users', 'action' => 'view_users'));
               }
            }
        }
    }
    function view_users()
    {
            $this->layout = 'admin';

         if($this->Session->read('Admin.admin') == null)
        {
            $this->Session->setFlash("Vous n'avez rien a faire ici, oust !", "notif");
            $this->redirect(array('controller' => 'Admin', 'action' => 'index'));
        }
        else{
            $lstPo = $this->User->find("all");
            $this->set("users", $lstPo);
        }   
    }
    function logout(){
        $this->Auth->logout();
        $this->redirect($this->referer());
    }

    function login()
    {
        if ($this->request->is('post'))
        {
            if ($this->Auth->login())
            {
                $this->Session->setflash("Connection reussie", "notif");
                $this->redirect("/");
            }
         else
            {
                $this->Session->setflash("Identifiant incorrect", "error");
            }
        }
    }
}
?>