<?php
class AdminController extends AppController {
public $uses = array('Role', 'Admin');
	public function index()
	{
     $this->layout = 'admin';
		if ($this->request->is('post'))
        {
            $da = $this->request->data;
            if (empty($da['Admin']['passwd']) || empty($da['Admin']['user']))
            	$this->Session->setFlash("Remplissez les champs", "notif");
            else
            {
               $da['Admin']['passwd'] = Security::hash($da['Admin']['passwd'],null,true);
               $eo = $this->Admin->find("first", array(
               		"conditions" => array(
               			'admin' => $da['Admin']['user'],
               			'passwd' => $da['Admin']['passwd'])
               	));
               if ($eo != null)
               {
               		$this->Session->write($eo);
               }

            
        	}
        }
	}

  public function create_admin()
  {
     $this->layout = 'admin';
     if($this->Session->read('Admin.admin') == null)
     {
            $this->Session->setFlash("Vous n'avez rien a faire ici, oust !", "error");
            $this->redirect(array('controller' => 'Admin', 'action' => 'index'));
     }
     else
     {
            if ($this->Session->read('roles.superadmin') == 0)
            {
                 $this->Session->setFlash("Vous n'avez pas le droit de faire sa", "error");
                 $this->redirect(array('controller' => 'Admin', 'action' => 'index'));
            }
            else
            {
              $role = $this->Role->find('list');
              $this->set("roles", $role);
              if($this->request->is('post'))
              {
                $d = $this->request->data;
                $d['Create']['id'] = null;
                if (!empty($d['Create']['passwd']))
                {
                    $d['Create']['passwd'] = Security::hash($d['Create']['passwd'],null,true);
                }
                 if ($this->Admin->save(array('admin' => $d['Create']['admin'], 'email' => $d['Create']['email'], 'passwd' => $d['Create']['passwd'], 'role' => $d['Create']['Role'], 'username' => $d['Create']['Username'])))
                {
                    $this->Session->setFlash("Admin créé", "notif");
                }   
                else
                {
                    $this->Session->setFlash("Erreur", "error");
                }            
              }
            }
     }

  }

	
}
?>