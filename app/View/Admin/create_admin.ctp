<div class="post adminForm">

<?php
echo $this->Form->create('Create'); ?>
	    <fieldset>
	        <legend><?php echo __('Creation'); ?></legend>
	        <?php 
	        	echo $this->Form->input('admin', array('label' => "Login :"));
	      		echo $this->Form->input('passwd', array('label' => "Mot de passe :"));
	      		echo $this->Form->input('Username', array('label' => "Username :"));
	      		echo $this->Form->input('email', array('label' => "Email :"));
	      		echo $this->Form->input('Role', array('label' => "Roles :"));
	      		echo $this->Html->link('Creation dun role',
						   		 array('controller' => 'roles', 'action' => 'create_role'),
						   		 array('class' => 'btn btn-primary')
							);
	      		echo $this->Html->link('Suppresion dun role',
						   		 array('controller' => 'roles', 'action' => 'supp_role'),
						   		 array('class' => 'btn btn-primary')
							);
	     ?>
	    </fieldset>
	<?php echo $this->Form->end(__('Creation'));?>

	</div>