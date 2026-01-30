<?php
/* @var $this BookController */

$this->pageTitle=Yii::app()->name . ' - Просмотр книги';
?>

<h1>О книге</h1>
<h2><?php echo $model->book_title; ?></h2>
<p><?php echo $model->book_authors; ?></p>
<p><?php echo $model->book_year; ?> год</p>
<p>Описание: <?php echo $model->book_desc; ?></p>
<p><img src="<?php echo Yii::app()->request->baseUrl . '/' . $model->book_pic; ?>" style="width: 100px;" alt="Обложка" /></p>


<p><?php
        echo CHtml::htmlButton('Назад', ['onclick' => 'history.back();']);
?></p>