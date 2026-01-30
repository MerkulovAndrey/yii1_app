<?php
if (Yii::app()->user->isGuest) {

    $this->pageTitle=Yii::app()->name . ' - Авторы';
    ?>

    <h1>Подписка на новые книги автров</h1>

    <form name="subscribeForm[]" action="<?php echo Yii::app()->createUrl('author/subscribe'); ?>" method="post">
        <table>
            <thead>
                <th style="width: 10%;">Подписаться</th>
                <th>Автор</th>
            </thead>
            <?php foreach($authors as $author): ?>
            <tr>
                <td><input type="checkbox" name="subscribeForm[selectedIds][]" value="<?php echo $author->author_id?>"></td>
                <td><?php echo $author->author_name; ?></td>
            </tr>
            <?php endforeach ?>
        </table>

        <p></p>

        <label for="text">Телефон для уведомлений:</label>
        <input type="text" name="subscribeForm[phone]" size="15" />
        <button type="submit">Подписаться</button>
    </form>
<?php } else { ?>
    <h2>Страница не найдена</h2>
<?php }?>