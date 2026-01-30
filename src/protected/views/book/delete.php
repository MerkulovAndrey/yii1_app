<?php
/* @var $this BookController */
if (!Yii::app()->user->isGuest) {

    $this->pageTitle=Yii::app()->name. ' - Удаление книги';
    ?>

    <h1>Подтвердить удаление книги</h1>
    <h2><?php echo $model->book_title; ?></h2>
    <p><?php echo $model->book_authors; ?></p>
    <p><?php echo $model->book_year; ?> год</p>
    <p>Описание: <?php echo $model->book_desc; ?></p>
    <p><img src="<?php echo Yii::app()->request->baseUrl . '/' . $model->book_pic; ?>" style="width: 100px;" alt="Обложка" /></p>
    <p>
        <?php
            echo CHtml::htmlButton('Назад', ['onclick' => 'history.back();']);

            echo "&nbsp;&nbsp;";

            echo CHtml::htmlButton('Удалить', [
                'onclick' => "window.location.replace('" . Yii::app()->createUrl('/book/delete/' . $model->book_id) . "');"
            ]);
        ?>
    </p>

<?php } else { ?>
    <h2>Страница не найдена</h2>
<?php }?>