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
<?php } else { ?>
    <h2>Страница не найдена</h2>
<?php }?>
