<div class="post adminForm">

 <?php echo $this->Form->create('Delete'); ?>
	    <fieldset>
	        <legend><?php echo __('Supprimer'); ?></legend>
	        <?php
	        echo $this->Form->input(
   				 'confirm', 
   				 array(
   				     'options' => array('oui' => 'Oui', 'non' => 'Non'),           
   				     'empty' => '',
   				     'label' => '',
   				     'class'=>'scale'
   				 )
			);

	     ?>
	    </fieldset>
	<?php echo $this->Form->end(__('Supprimer'));?>
</div>