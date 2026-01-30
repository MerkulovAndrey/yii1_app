<?php $this->pageTitle=Yii::app()->name. ' - Удаление автора'; ?>

<h1>Подтвердить удаление автора</h1>
<h2><?php echo $model->author_name; ?></h2>
<p>
    <?php
        echo CHtml::htmlButton('Назад', ['onclick' => 'history.back();']);

        echo "&nbsp;&nbsp;";

        echo CHtml::htmlButton('Удалить', [
            'onclick' => "window.location.replace('" . Yii::app()->createUrl('/author/delete/' . $model->author_id) . "');"
        ]);
    ?>
</p>

