<div class="form-con">
<?php if(AuthComponent::user('user'))
{
	echo "<div class='notif success'></div>";
}
else{

?>
<div class="post">
	   <?php echo $this->Form->create('User'); ?>
	    <fieldset>
	        <legend><?php echo __('Creez un utilisateur'); ?></legend>
	        <?php echo $this->Form->input('user', array('label' => "Login :"));
	       echo $this->Form->input('email', array('label' => "Adresse e-mail :"));
	       echo $this->Form->input('passwd', array('label' => "Mot de passe :"));
	       echo $this->Form->input('news',array('type'=>'checkbox', 'label' => "voulez vous recevoir des newsletters ?"));

	     ?>
	    </fieldset>
	<?php echo $this->Form->end(__('Creez un utilisateur'));?>
</div>
<?php } ?>
</div>