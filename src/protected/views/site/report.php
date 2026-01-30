<?php
$this->pageTitle=Yii::app()->name . ' - Топ-10 Авторов';
?>

<h1>
    Топ-10 Авторов
    <?php if ($model->year > 0) {
        echo "в ".$model->year." году";
    }
    ?>
</h1>

<div class="form">
    <?php $form=$this->beginWidget(
        'CActiveForm', [
            'action' => Yii::app()->createUrl('/site/report'),
            'id'=>'report-top-form',
            'enableClientValidation'=>true,
            'clientOptions'=>[
                'validateOnSubmit'=>true,
            ]
        ]
    ); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'Год выхода книг *'); ?>
        <?php echo $form->textField($model,'year'); ?>
        <?php echo $form->error($model,'year'); ?>
        <?php echo CHtml::submitButton('Показать'); ?>
    </div>
<?php $this->endWidget(); ?>
</div><!-- form -->

<p></p>
<?php if ($model->year > 0) { ?>
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
<?php } ?>