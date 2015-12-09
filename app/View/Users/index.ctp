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
	        <legend><?php echo __('S\'enregistrer'); ?></legend>
	        <?php echo $this->Form->input('user', array('label' => "Login :"));
	       echo $this->Form->input('email', array('label' => "Adresse e-mail :"));
	       echo $this->Form->input('passwd', array('label' => "Mot de passe :"));
	       echo $this->Form->input('news',array('label' => "Voulez vous recevoir des newsletters ?", 'type'=>'checkbox'));

	     ?>
	    </fieldset>
	<?php echo $this->Form->end(__('S\'enregistrer'));?>
</div>
<?php } ?>
</div>