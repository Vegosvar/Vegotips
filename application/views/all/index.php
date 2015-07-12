<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<table class="table table-striped">
	<tr>
		<td>ID</td>
		<td>NAMN</td>
		<td>AV</td>
		<td>GODKÄND</td>
	</tr>
<?php
foreach ($meals as $meal) {
	?>
	<tr>
		<td><?php echo $meal['meals_id'] ?></td>
		<td><a href="<?php echo $meal['meals_link'] ?>"><?php echo $meal['meals_name'] ?></a></td>
		<td><a href="<?php echo $meal['meals_ownerlink'] ?>"><?php echo $meal['meals_owner'] ?></a></td>
		<td><?php echo $meal['meals_approved'] ?></td>
	</tr>
	<?
}
	
?>
</table>