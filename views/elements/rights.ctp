<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo ('Aco');?></th>
	<th><?php echo ('create');?></th>
	<th><?php echo ('read');?></th>
	<th><?php echo ('update');?></th>
	<th><?php echo ('delete');?></th>
</tr>
<?php
$i = 0;
foreach ($rights as $right):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $right['Aco']; ?>
		</td>
		<td>
			<?php echo $right['create']; ?>
		</td>
		<td>
			<?php echo $right['read']; ?>
		</td>
		<td>
			<?php echo $right['update']; ?>
		</td>
		<td>
			<?php echo $right['delete']; ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>