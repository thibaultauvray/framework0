<div class="post adminForm">

<?php
debug($data);
echo $this->Form->create('Update', array('type' => 'file')); ?>
	    <fieldset>
	        <legend><?php echo __('Update'); ?></legend>
	        <?php 
	        	echo $this->Form->input('titre', array('label' => "Titre :", 'value' => $data['Post']['titre']));
	      		echo $this->Form->input('image_file', array('label' => "Image :", 'type' => 'file'));
	      		echo $this->Form->input('texte', array('label' => "Texte :", 'value' => $data['Post']['texte']));

	     ?>
	    </fieldset>
	<?php echo $this->Form->end(__('Update'));?>

</div>