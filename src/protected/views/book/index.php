<?php $this->pageTitle=Yii::app()->name . ' - Каталог книг'; ?>

<h1>Каталог книг</h1>

<?php if (Yii::app()->user->isGuest) { ?>
<table>
	<thead>
		<th>Название</th>
		<th>Год</th>
		<th>Автор</th>
		<th>Описание</th>
		<th>ISBN</th>
		<th>Обложка</th>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
	</thead>
	<?php foreach($books as $book): ?>
	<tr>
		<td><?php echo $book->book_title; ?></td>
		<td><?php echo $book->book_year; ?></td>
		<td><?php echo $book->book_authors; ?></td>
		<td><?php echo $book->book_desc; ?></td>
		<td><?php echo $book->book_isbn; ?></td>
		<td><img src="<?php echo Yii::app()->request->baseUrl . '/' . $book->book_pic; ?>" style="width: 100px;" alt="Обложка" /></td>
        <td><?php echo CHtml::link('Просмотр', Yii::app()->createUrl('/book/view/' . $book->book_id)); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
	</tr>
	<?php endforeach ?>
</table>
<?php } else { ?>
<table>
	<thead>
		<th>Название</th>
		<th>Год</th>
		<th>Автор</th>
		<th>Описание</th>
		<th>ISBN</th>
		<th>Обложка</th>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
	</thead>
	<?php foreach($books as $book): ?>
	<tr>
		<td><?php echo $book->book_title; ?></td>
		<td><?php echo $book->book_year; ?></td>
		<td><?php echo $book->book_authors; ?></td>
		<td><?php echo $book->book_desc; ?></td>
		<td><?php echo $book->book_isbn; ?></td>
		<td><img src="<?php echo Yii::app()->request->baseUrl . '/' . $book->book_pic; ?>" style="width: 100px;" alt="Обложка" /></td>
        <td><?php echo CHtml::link('Просмотр', Yii::app()->createUrl('/book/view/' . $book->book_id)); ?></td>
        <td><?php echo CHtml::link('Редактирование', Yii::app()->createUrl('/book/edit/' . $book->book_id)); ?></td>
        <td><?php echo CHtml::link('Удаление', Yii::app()->createUrl('/book/deleteConfirm/' . $book->book_id)); ?></td>
    </tr>
	<?php endforeach ?>
    <tr><td colspan="8">&nbsp;</td><td><?php echo CHtml::link('Добавить книгу', Yii::app()->createUrl('/book/create')); ?></td></tr>
</table>
<?php } ?>
