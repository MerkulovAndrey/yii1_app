<?php
/* @var $this BookController */
/* @var $model Book */
/* @var $form CActiveForm  */

if (!Yii::app()->user->isGuest) {

    $this->pageTitle=Yii::app()->name . ' - Добавление книги';
    ?>

    <h1>Добавление книги</h1>

    <div class="form">
    <?php $form=$this->beginWidget(
        'CActiveForm', [
            'action' => Yii::app()->createUrl('/book/insert'),
            'id'=>'create-book-form',
            'enableClientValidation'=>true,
            'clientOptions'=>[
                'validateOnSubmit'=>true,
            ]
        ]
    ); ?>

        <p class="note"><span class="required">*</span> Обязательное поле</p>

        <div class="row">
            <?php echo $form->labelEx($model,'Название книги *'); ?>
            <?php echo $form->textField($model,'book_title', ['required'=>true]); ?>
            <?php echo $form->error($model,'book_title'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'Авторы книги *'); ?>
            <?php echo $form->listBox(
                $model,'book_authors_ids_arr',
                CHtml::listData(
                    $author_list,
                    'author_id',
                    'author_name'),
                    ['size' => '4', 'prompt'=>'-- можно выбрать нескольких --', 'multiple'=>true, 'required'=>true]
            ); ?>
            <?php echo $form->error($model,'book_title'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'Год выхода *'); ?>
            <?php echo $form->textField($model,'book_year', ['required'=>true]); ?>
            <?php echo $form->error($model,'book_year'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'Описание'); ?>
            <?php echo $form->textArea($model,'book_desc', ['rows' => 3, 'cols' => 70]); ?>
            <?php echo $form->error($model,'book_desc'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'ISBN *'); ?>
            <?php echo $form->textField($model,'book_isbn', ['required'=>true]); ?>
            <?php echo $form->error($model,'book_isbn'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'Ссылка на изображение обложки'); ?>
            <?php echo $form->textField($model,'book_pic'); ?>
            <?php echo $form->error($model,'book_pic'); ?>
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