<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version());
App::uses('AuthComponent', 'Controller/Component');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800,300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script> 
	<script type="text/javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('/theme/style.css');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
		<div class="container">

		<header>
			</div>
			<nav class ="menu">
				<div class="container">
					<ul class="nav navbar-nav men">		
						<li class="home">
							<h1>
						<?php
							echo $this->Html->link(
							    $this->Html->tag('span', '', array('class' => 'menuspan logo')) . "Framework0();",
							    array('controller' => 'posts', 'action' => 'index'),
							    array('class' => 'some other  classes', 'escape' => false)
							);
							?>
							</h1>
						</li>

						<li class="top_li">
							<?php
							echo $this->Html->link(
							    $this->Html->tag('span', '', array('class' => 'menuspan top')) . "Les meilleurs",
							    array('controller' => 'posts', 'action' => 'top'),
							    array('class' => 'some other  classes', 'escape' => false)
							);
							?>
						</li>
						<li class="random">

							<?php
							echo $this->Html->link(
							    $this->Html->tag('span', '', array('class' => 'menuspan rand')) . "Random();",
							    array('controller' => 'posts', 'action' => 'random'),
							    array('class' => 'some other  classes', 'escape' => false)
							);
							?>
						</li>
					</ul>

					<div class="register">
						<?php
						
						if(AuthComponent::user('user'))
						{
							echo $this->Html->link(
						    'Se deconnecter',
						     array('controller' => 'Users', 'action' => 'logout'),
						     array('class' => 'btn btn-primary')
						);
						}
						else
						{
							echo $this->Html->link('S\'enregistrer',
						   		 array('controller' => 'Users', 'action' => 'index'),
						   		 array('class' => 'btn btn-primary')
							);
							echo $this->Html->link('Se connecter',
						   		 array('controller' => 'Users', 'action' => 'login'),
						   		 array('class' => 'btn btn-primary')
							);
							}
						
						?>
					</div>
				</div>
		</nav>
		<div class="container">
		
		</header>
		<div id="content">
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			
<script type="text/javascript">
$(document).ready(function() {
    $('#example').dataTable();
} );</script>			
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
