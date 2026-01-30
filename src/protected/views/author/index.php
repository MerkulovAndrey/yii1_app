<?php
if (!Yii::app()->user->isGuest) {

    $this->pageTitle=Yii::app()->name . ' - Авторы';
    ?>
    <h1>Авторы</h1>
    <table>
        <thead>
            <th>Автор</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </thead>
        <?php foreach($authors as $author): ?>
        <tr>
            <td><?php echo $author->author_name; ?></td>
            <td><?php echo CHtml::link('Редактирование', Yii::app()->createUrl('/author/edit/' . $author->author_id)); ?></td>
            <td><?php echo CHtml::link('Удаление', Yii::app()->createUrl('/author/deleteConfirm/' . $author->author_id)); ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <?php endforeach ?>
    </table>

    <h1>Добавление автора</h1>

    <div class="form">
    <?php $form=$this->beginWidget(
        'CActiveForm', [
            'action' => Yii::app()->createUrl('/author/insert'),
            'id'=>'create-author-form',
            'enableClientValidation'=>true,
            'clientOptions'=>[
                'validateOnSubmit'=>true,
            ]
        ]
    ); ?>

        <p class="note"><span class="required">*</span> Обязательное поле</p>

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
            <?php echo CHtml::resetButton('Очистить'); ?>
            <?php echo CHtml::submitButton('Сохранить'); ?>
        </div>

    <?php $this->endWidget(); ?>
    </div><!-- form -->
<?php } else { ?>
    <h2>Страница не найдена</h2>
<?php }?>
