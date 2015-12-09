<?php
class RolesController extends AppController {

	public function create_role()
  {
        $this->layout = 'admin';

     if($this->Session->read('Admin.admin') == null)
     {
            $this->Session->setFlash("Vous n'avez rien a faire ici, oust !", "notif");
            $this->redirect(array('controller' => 'Admin', 'action' => 'index'));
     }
     else
     {
            if ($this->Session->read('roles.superadmin') == 0)
            {
                 $this->Session->setFlash("Vous n'avez pas le droit de faire sa");
                 $this->redirect(array('controller' => 'Admin', 'action' => 'index'));
            }
            else
            {
              if($this->request->is('post'))
              {
                  $d = $this->request->data;
                  if ($this->Role->save(array('name' => $d['Create']['name'], 'create' => $d['Create']['create'], 'update' => $d['Create']['update'], 'delete' => $d['Create']['delete'], 'superadmin' => $d['Create']['superadmin']), true))
                  {
                      $this->Session->setFlash("Le role a bien ete cree", "notif");
                  }
                  else
                  {
                          $this->set("err", $this->Role->validationErrors); //show validationErrors           
                  }
              }
            }
     }
   }

   public function supp_role()
   {
    $this->layout = 'admin';
    $role = $this->Role->find("all");
    $this->set("role", $role);
   }

   public function delete()
   {    $this->layout = 'admin';

    if($this->Session->read('Admin.admin') == null)
        {
            $this->Session->setFlash("Vous n'avez rien a faire ici, oust !", "notif");
            $this->redirect(array('controller' => 'Admin', 'action' => 'index'));
        }
        else
        {
            if ($this->Session->read('roles.superadmin') == 0)
            {
                 $this->redirect(array('controller' => 'Admin', 'action' => 'index'));
            }
            else
            {
                $id_del = $this->params['named']['id'];
                if ($this->request->is('post'))
                {
                    $d = $this->request->data;
                    if($d['Delete']['confirm'] == "non")
                    {
                        $this->redirect(array('controller' => 'roles', 'action' => 'supp_role'));
                    }
                    else{
                        $this->Session->setFlash("Votre roles a bien été supprimé", "notif");
                        $this->Role->delete($id_del, false);
                        $this->redirect(array('controller' => 'roles', 'action' => 'supp_role'));
                    }
                    debug($d);

                }

            }
        }
   }
 
}
?>