<?php $this->pageTitle=Yii::app()->name . ' - Редактирование автора'; ?>

<h1>Редактирование автора</h1>

<div class="form">
<?php $form=$this->beginWidget(
    'CActiveForm', [
        'action' => Yii::app()->createUrl('/author/update'),
        'id'=>'update-author-form',
        'enableClientValidation'=>true,
        'clientOptions'=>[
            'validateOnSubmit'=>true,
        ]
    ]
); ?>

    <p class="note"><span class="required">*</span> Обязательное поле</p>

    <?php echo CHtml::activeHiddenField($model,'author_id'); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'Фамилия *'); ?>
        <?php echo $form->textField($model,'author_lname', ['required'=>true]); ?>
        <?php echo $form->error($model,'author_lname'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'Имя *'); ?>
        <?php echo $form->textField($model,'author_fname', ['required'=>true]); ?>
        <?php echo $form->error($model,'author_fname'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'Отчество'); ?>
        <?php echo $form->textField($model,'author_sname', ['required'=>false]); ?>
        <?php echo $form->error($model,'author_sname'); ?>
    </div>

    <div class="row buttons">
        <?php
            echo CHtml::htmlButton('Назад', ['onclick' => 'history.back();']);

            echo "&nbsp;&nbsp;";

            echo CHtml::submitButton('Сохранить');
        ?>
    </div>

<?php $this->endWidget(); ?>
</div><!-- form -->
