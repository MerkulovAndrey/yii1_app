<?php
/* @var $this BookController */

$this->pageTitle=Yii::app()->name;
?>

<h1>О книге</h1>
<h2><?php echo $model->book_title; ?></h2>
<p><?php echo $model->book_authors; ?></p>
<p><?php echo $model->book_year; ?> год</p>
<p>Описание: <?php echo $model->book_desc; ?></p>
<p>Обложка <?php echo $model->book_pic; ?></p>
<p>Назад</p>