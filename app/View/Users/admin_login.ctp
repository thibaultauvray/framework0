<div class="form-con">
<?php if(AuthComponent::user('Admin'))
{
	echo "<div class='notif success'>Vous etes deja connecter</div>";
}
else{

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
<?php } ?>
</div>