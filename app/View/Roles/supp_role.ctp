<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="example"> 
<?php
?>
	<tr>
		<td>Nom</td>
		<td>Create</td>
		<td>Update</td>
		<td>Delete</td>
		<td>Superadmin</td>
		<td>Supprimer</td>

	</tr>
<?php
foreach ($role as $key => $value) {
	echo "<tr>";
	echo "<td>";
	echo $value['Role']['name'];
	echo "</td>";
	echo "<td>";
	echo $value['Role']['create'];
	echo "</td>";
	echo "<td>";
	echo $value['Role']['update'];
	echo "</td>";
	echo "<td>";
	echo $value['Role']['delete'];
	echo "</td>";
	echo "<td>";
	echo $value['Role']['superadmin'];
	echo "</td>";
	echo "<td>";
	echo $this->html->link('Delete', array('controller' => 'roles', 'action' => 'delete', 'id' => $value['Role']['id']));
	echo "</td>";
	echo "</tr>";
}
echo "<tr>";
	

?>
</table>