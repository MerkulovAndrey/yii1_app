<?php

class AuthorController extends Controller
{
    public function actionIndex()
    {
        $this->render('index', [
            'model' =>  Author::model(),
            'authors' => Author::model()->getList()
        ]);
    }

    public function actionInsert()
    {
        Author::model()->create($_REQUEST['Author']);
        $this->render('index', [
            'model' =>  Author::model(),
            'authors' => Author::model()->getList()
        ]);
    }

    public function actionEdit($id)
    {
        // Редактирование автора (доступно юзерам)
        $this->render('edit', ['model' => Author::model()->getItemFull($id)]);
    }

    public function actionUpdate()
    {
        Author::model()->updateItem($_REQUEST['Author']);
        $this->render('index', [
            'model' =>  Author::model(),
            'authors' => Author::model()->getList()
        ]);
    }

    public function actionDelete($id)
    {
        // Удаление автора (доступно юзерам)
        Author::model()->findByPk($id)->delete();
        $this->render('index', [
            'model' =>  Author::model(),
            'authors' => Author::model()->getList()
        ]);
    }

    public function actionDeleteConfirm($id)
    {
        // Подтверждение удаления автора (доступно юзерам)
        $this->render('delete', ['model' => Author::model()->getItem($id)]);
    }

    public function actionSubscribeIndex()
    {
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
    }

    // подписка на новые книги автора
    public function actionSubscribeSave()
    {
        if (isset($_REQUEST['Subscribe'])) {
            $model = new Subscribe;
            $model->guest_phone = $_REQUEST['Subscribe']['guest_phone'];
            $model->author_ids = $_REQUEST['Subscribe']['author_ids'];
        }
        if ($model->validate()) {
            Subscribe::model()->subscribeInsert($model);
        }
        $this->render('subscribe', [
            'authors' => Author::model()->getList(),
            'model' => $model,
        ]);
    }
}