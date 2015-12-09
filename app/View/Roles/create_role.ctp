<div class="post adminForm">

<?php
echo $this->Form->create('Create'); ?>
	    <fieldset>
	        <legend><?php echo __('Creation'); ?></legend>
	        <?php 
	        	echo $this->Form->input('name', array('label' => "Nom :"));
	        	if (isset($err))
	      		{
	      			echo "<span class='error-message'>";
	      			echo $err['name']['0'];
	      			echo "</span>";
	      		}
	      		echo $this->Form->input('create', array('label' => "Creation :", 'type' => 'checkbox'));
	      		echo $this->Form->input('update', array('label' => "Modification :", 'type' => 'checkbox'));
	      		echo $this->Form->input('delete', array('label' => "Supression :", 'type' => 'checkbox'));
	      		echo $this->Form->input('superadmin', array('label' => "Super Admin :", 'type' => 'checkbox'));
	      ?>
	    </fieldset>
	<?php echo $this->Form->end(__('Creation'));?>

</div>