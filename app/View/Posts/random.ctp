<?php
		echo "<div class='post'>";
		echo "<h2>";
		echo $this->Html->link(
   			 $posts['Post']['titre'],
   			 array('controller' => 'posts', 'action' => 'single', $posts['Post']['id'])
);
		echo "</h2>";
		echo "<span class='auteur'>Proposé par <span class='user'>";
		echo $posts['Admins']['username'];
		echo "</span></span>";
		echo $this->Html->image($posts['Post']['img'], array('alt' => $posts['Post']['titre'], 'class' => 'gif_f'));
		echo "<div class='info'>";
		echo "<span class='txte'>";
		echo $posts['Post']['texte'];
		echo "</span>";
		echo "<a href='";
		echo $this->Html->url(array(
    		"action" => "index",
    		"?" => array("id" => $posts['Post']['id'],
    			"up" => '1'
    			)));
		echo "'>";
		echo "<span class='vote up'>";
		echo $this->requestAction(array( 'controller' => 'posts', 
                            'action' => 'count_neg', 
                            $posts['Post']['id'], 1
                        ));;
		echo "</span></a>";
		echo "<a href='";
		echo $this->Html->url(array(
    		"action" => "index",
    		"?" => array("id" => $posts['Post']['id'],
    			"down" => '1'
    			)));
		echo "'>";
		echo "</span><span class='vote down'>";
		echo $this->requestAction(array( 'controller' => 'posts', 
                            'action' => 'count_neg', 
                            $posts['Post']['id'], -1
                        ));;
		echo "</span></a>";
		echo"</div>";
		echo "</div>";
	
	// print_r($posts); DEBUG
?>
