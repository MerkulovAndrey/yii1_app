<?php

class AuthorController extends Controller
{
    public function actionIndex()
    {
        $this->render('index', ['authors' => Author::model()->getList()]);
    }

    public function actionEdit($id)
    {
        // Редактирование автора (доступно юзерам)
        $this->render('edit', ['model' => Author::model()->getItemFull($id)]);
    }

    public function actionUpdate()
    {
        Author::model()->updateItem($_REQUEST['Author']);
        $this->render('index', ['authors' => Author::model()->getList()]);
    }

    public function actionDelete($id)
    {
        // Удаление автора (доступно юзерам)
        Author::model()->findByPk($id)->delete();
        $this->render('index', ['authors' => Author::model()->getList()]);
    }

    public function actionDeleteConfirm($id)
    {
        // Подтверждение удаления автора (доступно юзерам)
        $this->render('delete', ['model' => Author::model()->getItem($id)]);
    }

    public function actionSubscribeIndex()
    {
        $this->render('subscribe', ['authors' => Author::model()->getList()]);
    }

    // подписка на новые книги автора
    public function actionSubscribeSave()
    {
        Author::model()->subscribeInsert($_REQUEST['subscribeForm']);
        $this->render('subscribe', ['authors' => Author::model()->getList()]);
    }
}