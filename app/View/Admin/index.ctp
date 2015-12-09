<div class="form-con">
<?php
	if($this->Session->read('Admin.admin') == null)
	{

?>
<div class="post">
	   <?php echo $this->Form->create('Admin'); ?>
	    <fieldset>
	        <legend><?php echo __('Se connecter'); ?></legend>
	        <?php 
	        	echo $this->Form->input('user', array('label' => "Login :"));
	      		echo $this->Form->input('passwd', array('label' => "Mot de passe :"));
	     ?>
	    </fieldset>
	<?php echo $this->Form->end(__('Se connecter'));?>
</div>
<?php  }
else{
	echo $this->Html->link('Voir les posts',
						   		 array('controller' => 'Posts', 'action' => 'view_posts'),
						   		 array('class' => 'btn btn-primary')
							);
	echo $this->Html->link('Voir les utlisateurs',
						   		 array('controller' => 'Users', 'action' => 'view_users'),
						   		 array('class' => 'btn btn-primary')
							);
	if ($this->Session->read('roles.superadmin') == 1)
	{
	echo $this->Html->link('Creation dun admin',
						   		 array('controller' => 'Admin', 'action' => 'create_admin'),
						   		 array('class' => 'btn btn-primary')
							);
	}
}
?>
</div>