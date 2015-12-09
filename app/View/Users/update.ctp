<div class="post adminForm">
<?php
debug($data);
echo $this->Form->create('Update'); ?>
	    <fieldset>
	        <legend><?php echo __('Update'); ?></legend>
	        <?php 
	        	echo $this->Form->input('Login', array('label' => "Titre :", 'value' => $data['User']['user']));
	      		echo $this->Form->input('Email', array('label' => "Email :", 'value' => $data['User']['email']));
	      		if ($data['User']['news'] == false)
	      		{
	      			echo $this->Form->input('Newletter', array('label' => "Texte :", 'options' => array('1' => 'Oui', '0' => 'Non'), 'default' => "0"));
	      		}
	      		else
	      			echo $this->Form->input('Newletter', array('label' => "Texte :", 'options' => array('1' => 'Oui', '0' => 'Non'), 'default' => "1"));
	     ?>
	    </fieldset>
	<?php echo $this->Form->end(__('Update'));?>
</div>