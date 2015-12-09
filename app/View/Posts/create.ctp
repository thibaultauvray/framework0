<div class="post adminForm">

<?php

echo $this->Form->create('Create', array('type' => 'file')); ?>
	    <fieldset>
	        <legend><?php echo __('Creation'); ?></legend>
	        <?php 
	        	echo $this->Form->input('titre', array('label' => "Titre :"));
	      		echo $this->Form->input('image_file', array('label' => "Image :", 'type' => 'file'));
	      		echo $this->Form->input('texte', array('label' => "Texte :"));

	     ?>
	    </fieldset>
	<?php echo $this->Form->end(__('Creer'));?>

</div>