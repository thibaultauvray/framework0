<div class="content-post">
<div class="main-post">
<?php
	foreach ($posts as $key => $value) {
		echo "<div class='post'>";
		echo "<h2>";
		echo $this->Html->link(
   			 $value['Post']['titre'],
   			 array('controller' => 'posts', 'action' => 'single', $value['Post']['id'])
);
		echo "</h2>";
		echo "<span class='auteur'>Proposé par <span class='user'>";
		echo $value['Admins']['username'];
		echo "</span></span>";
		echo $this->Html->image($value['Post']['img'], array('alt' => $value['Post']['titre'], 'class' => 'gif_f'));
		echo "<div class='info'>";
		echo "<span class='txte'>";
		echo $value['Post']['texte'];
		echo "</span>";
		echo "<a href='";
		echo $this->Html->url(array(
    		"action" => "index",
    		"?" => array("id" => $value['Post']['id'],
    			"up" => '1'
    			)));
		echo "'>";
		echo "<span class='vote up'>";
		echo $this->requestAction(array( 'controller' => 'posts', 
                            'action' => 'count_neg', 
                            $value['Post']['id'], 1
                        ));;
		echo "</span></a>";
		echo "<a href='";
		echo $this->Html->url(array(
    		"action" => "index",
    		"?" => array("id" => $value['Post']['id'],
    			"down" => '1'
    			)));
		echo "'>";
		echo "</span><span class='vote down'>";
		echo $this->requestAction(array( 'controller' => 'posts', 
                            'action' => 'count_neg', 
                            $value['Post']['id'], -1
                        ));;
		echo "</span></a>";
		echo"</div>";
		echo "</div>";
	}
	// print_r($posts); DEBUG
	echo "<div class='pagination'>";

      echo $this->Paginator->first(__('First', true), array('class' => 'enable'));
     echo $this->Paginator->prev('<< ' . __('Previous', true), array(), null, array('class'=>'enable'));
     echo $this->Paginator->numbers(array('class' => 'numbers', 'first' => false, 'last' => false, 'separator' => ''));
     echo $this->Paginator->next(__('Next', true) . ' >>', array(), null, array('class' => 'enable'));
     echo $this->Paginator->last(__('Last', true), array('class' => 'enable'));
?>
</div>
</div>

<div class="side_dr">
	<div class="post">
		<h2>Lorem Lipsum</h2>
		<p>Lorem lipsum</p>
	</div>
</div>
</div>
<div class="clearfix"></div>
