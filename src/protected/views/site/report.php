<?php
$this->pageTitle=Yii::app()->name . ' - Топ-10 Авторов';
?>

<h1>Топ-10 Авторов</h1>



<table>
	<thead>
		<th>Автор</th>
		<th>Количество книг вышедших в году</th>
	</thead>
	<?php foreach($report as $row): ?>
	<tr>
		<td><?php echo $row['author']; ?></td>
		<td><?php echo $row['cnt']; ?></td>
	</tr>
	<?php endforeach ?>
</table>