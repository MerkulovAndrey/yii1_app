<?php
/**
 * AuthorController контроллер для работы с авторами
 */
class AuthorController extends Controller
{
    /**
     * Главная страница авторов:
     * - Список авторов
     * - Форма добавления автора
     */
    public function actionIndex()
    {
        $this->render('index', [
            'model' =>  Author::model(),
            'authors' => Author::model()->getList()
        ]);
    }

    /**
     * Запись автора в БД
     */
    public function actionInsert()
    {
        $this->handleUnauthorizedUser();
        Author::model()->create($_REQUEST['Author']);
        $this->render('index', [
            'model' =>  Author::model(),
            'authors' => Author::model()->getList()
        ]);
    }

    /**
     * Страница редактирования автора (доступно юзерам)
     * @param int $id - код автора
     */
    public function actionEdit(int $id)
    {
        $this->handleUnauthorizedUser();
        $this->render('edit', ['model' => Author::model()->getItemFull($id)]);
    }

    /**
     * Обновление автора в БД
     */
    public function actionUpdate()
    {
        $this->handleUnauthorizedUser();
        Author::model()->updateItem($_REQUEST['Author']);
        $this->render('index', [
            'model' =>  Author::model(),
            'authors' => Author::model()->getList()
        ]);
    }

    /**
     * Удаление автора из БД
     * @param mixed $id - код автора
     */
    public function actionDelete($id)
    {
        $this->handleUnauthorizedUser();
        Author::model()->findByPk($id)->delete();
        $this->render('index', [
            'model' =>  Author::model(),
            'authors' => Author::model()->getList()
        ]);
    }

    /**
     * Страница подтверждения удаления автора
     * @param mixed $id - код автора
     */
    public function actionDeleteConfirm($id)
    {
        $this->handleUnauthorizedUser();
        $this->render('delete', ['model' => Author::model()->getItem($id)]);
    }

    /**
     * Страница оформления подписки
     */
    public function actionSubscribeIndex()
    {
        if (Yii::app()->user->isGuest) {
            $model = new Subscribe;
            $menu = [];

            $data = Author::model()->getList();
            foreach ($data as $author) {
                $menu[$author->author_id] = $author->author_name;
            }

            $this->render('subscribe', [
                'author_menu' => $menu,
                'model' => $model,
            ]);
        } else {
            $this->redirect(Yii::app()->homeUrl);
        }
    }

    /**
     * Сохранение подписок в БД
     */
    public function actionSubscribeSave()
    {
        if (Yii::app()->user->isGuest) {
            if (isset($_REQUEST['Subscribe'])) {
                $formData = new Subscribe;
                $formData->guest_phone = $_REQUEST['Subscribe']['guest_phone'];
                $formData->author_ids = $_REQUEST['Subscribe']['author_ids'];
                if ($formData->validate()) {
                    Subscribe::model()->subscribeInsert($formData);
                }
            }
            $this->redirect(Yii::app()->createUrl('/author/subscribeIndex'));
        } else {
            $this->redirect(Yii::app()->homeUrl);
        }
    }
}