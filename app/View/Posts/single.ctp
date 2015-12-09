<?php

echo "<div class='post'>";
		echo "<h2>";
		echo $this->Html->link(
   			 $single['Post']['titre'],
   			 array('controller' => 'posts', 'action' => 'single', $single['Post']['id'])
);
		echo "</h2>";
		echo "<span class='auteur'>Proposé par <span class='user'>";
		echo $single['Admins']['username'];
		echo "</span></span>";
		echo $this->Html->image($single['Post']['img'], array('alt' => $single['Post']['titre'], 'class' => 'gif_f'));
		echo "<div class='info'>";
		echo "<span class='txte'>";
		echo $single['Post']['texte'];
		echo "</span>";
		echo "<a href='";
		echo $this->Html->url(array(
    		"action" => "index",
    		"?" => array("id" => $single['Post']['id'],
    			"up" => '1'
    			)));
		echo "'>";
		echo "<span class='vote up'>";
		echo $this->requestAction(array( 'controller' => 'posts', 
                            'action' => 'count_neg', 
                            $single['Post']['id'], 1
                        ));;
		echo "</span></a>";
		echo "<a href='";
		echo $this->Html->url(array(
    		"action" => "index",
    		"?" => array("id" => $single['Post']['id'],
    			"down" => '1'
    			)));
		echo "'>";
		echo "</span><span class='vote down'>";
		echo $this->requestAction(array( 'controller' => 'posts', 
                            'action' => 'count_neg', 
                            $single['Post']['id'], -1
                        ));;
		echo "</span></a>";
		echo"</div>";
		echo "</div>";?>