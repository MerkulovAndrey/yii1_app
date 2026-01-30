<?php
$this->pageTitle=Yii::app()->name . ' - Топ-10 Авторов';
?>

<h1>
    Топ-10 Авторов
    <?php if ($year > 0) {
        echo "в {$year} году";
    }
    ?>
</h1>

<form action="<?php echo Yii::app()->createUrl('site/report'); ?>" method="post">
    <label for="text">Год выхода книг:</label>
    <input type="text" name="year" id="year" size="10" />
    <button type="submit">Показать</button>
</form>
<p></p>
<table>
	<thead>
		<th>Автор</th>
		<th>Количество книг</th>
	</thead>
	<?php foreach($report as $row): ?>
	<tr>
		<td><?php echo $row['author']; ?></td>
		<td><?php echo $row['cnt']; ?></td>
	</tr>
	<?php endforeach ?>
</table>