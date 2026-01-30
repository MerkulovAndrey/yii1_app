<?php $this->pageTitle=Yii::app()->name . ' - Подписка на авторов'; ?>

<h1>Подписка на новые книги авторов</h1>

<div class="form">
<?php $form=$this->beginWidget(
    'CActiveForm', [
        'action' => Yii::app()->createUrl('/author/subscribeSave'),
        'id'=>'subscribe-form',
        'enableClientValidation'=>true,
        'clientOptions'=>[
            'validateOnSubmit'=>true,
        ]
    ]
); ?>

<p class="note"><span class="required">*</span> Обязательное поле</p>
<div class="row">
    <?php
        echo $form->checkBoxList($model, 'author_ids', $author_menu, [
            'separator' => '',
            'template' => '<span>{input} {label}</span>'
        ]);
    ?>
    <?php echo $form->error($model,'author_ids'); ?>
</div>
<p></p>
<div class="row">
    <?php echo $form->labelEx($model,'Телефон для уведомлений *'); ?>
    <?php echo $form->textField($model,'guest_phone', ['required'=>true]); ?>
    <?php echo $form->error($model,'author_sname'); ?>
</div>

<div class="row buttons">
    <?php echo CHtml::resetButton('Очистить'); ?>
    <?php echo CHtml::submitButton('Сохранить'); ?>
</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
