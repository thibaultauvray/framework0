<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="example"> 
<?php
debug($users);
?>
	<tr>
		<td>Login</td>
		<td>Email</td>
		<td>Newsletter</td>
		<td>Mis a jour</td>
		<td>Supprimer</td>
	</tr>
<?php
foreach ($users as $key => $value) {
	echo "<tr>";
	echo "<td>";
	echo $value['User']['user'];
	echo "</td>";
	echo "<td>";
	echo $value['User']['email'];
	echo "</td>";
	echo "<td>";
	if ($value['User']['news'] === false)
		echo "Non";
	else
		echo "Oui";
	echo "</td>";
	if ($this->Session->read('roles.update') == 1)
	{
		echo "<td>";
		echo $this->html->link('Update', array('controller' => 'users', 'action' => 'update', 'id' => $value['User']['id']));
		echo "</td>";
	}
	if ($this->Session->read('roles.delete') == 1)
	{
		echo "<td>";
		echo $this->html->link('Delete', array('controller' => 'users', 'action' => 'delete', 'id' => $value['User']['id']));
		echo "</td>";
	}
	echo "</tr>";
}
echo "<tr>";
	if ($this->Session->read('roles.create') == 1)
	{
		echo "<td>";
		echo $this->html->link('Creez un utilisateur', array('controller' => 'users', 'action' => 'create'));
		echo "</td>";
	}
		echo "<td>";
		echo $this->html->link('Envoyer une newsletter', array('controller' => 'users', 'action' => 'send_mail'));
		echo "</td>";
	echo "</tr>";

?>
</table>