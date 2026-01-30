<?php
/* @var $this BookController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Подтвердить удаление книги</h1>
<h2><?php echo $model->book_title; ?></h2>
<p><?php echo $model->book_authors; ?></p>
<p><?php echo $model->book_year; ?> год</p>
<p>Описание: <?php echo $model->book_desc; ?></p>
<p>Обложка <?php echo $model->book_pic; ?></p>
<p>Назад | <?php echo CHtml::link('Удалить', Yii::app()->createUrl('/book/delete/' . $model->book_id)); ?></p>