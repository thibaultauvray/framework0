<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="example"> 
<?php
foreach ($posts as $key => $value) {
	echo "<tr>";
	echo "<td>";
	echo $value['Post']['titre'];
	echo "</td>";
	echo "<td>";
	echo $this->Html->image($value['Post']['img'], array('alt' => $value['Post']['titre'], 'class' => 'gif_f', 'with' => 150, 'height' => 150));
	echo "</td>";
	echo "<td>";
	echo $value['Post']['texte'];
	echo "</td>";
	if ($this->Session->read('roles.update') == 1)
	{
		echo "<td>";
		echo $this->html->link('Update', array('controller' => 'posts', 'action' => 'update', 'id' => $value['Post']['id']));
		echo "</td>";
	}
	if ($this->Session->read('roles.delete') == 1)
	{
		echo "<td>";
		echo $this->html->link('Delete', array('controller' => 'posts', 'action' => 'delete', 'id' => $value['Post']['id']));
		echo "</td>";
	}
	echo "</tr>";
}
if ($this->Session->read('roles.create') == 1)
	{
		echo "<td colspan=2>";
		echo $this->html->link('Creez un post', array('controller' => 'posts', 'action' => 'create'));
		echo "</td>";
	}
?>
</table>