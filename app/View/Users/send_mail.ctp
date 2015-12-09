<div class="post adminForm">
<?php
echo $this->Form->create('Envoyer'); ?>
	    <fieldset>
	        <legend><?php echo __('Envoyer'); ?></legend>
	        <?php 
	        	echo $this->Form->input('Objet', array('label' => "Objet :"));
	      		echo $this->Form->input('Message', array('label' => "Message :", 'type' => 'textarea'));
	      		
	     ?>
	    </fieldset>
	<?php echo $this->Form->end(__('Envoyer'));?>
</div>