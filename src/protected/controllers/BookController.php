<?php

class BookController extends Controller {
    public function actionIndex()
    {
        // Список книг
    }

    // Просмотр книги
    public function actionView($id)
    {
        $this->render('view', ['model' => Book::model()->getItem($id)]);
    }

    public function actionCreate()
    {
        // Создание книги (доступно юзерам)
        $this->render('create', [
            'model' => Book::model(),
            'author_list' => Author::model()->getList()
        ]);
    }

    public function actionInsert()
    {
        Book::model()->create($_REQUEST['Book']);
        $this->render('/site/books', ['books' => Book::model()->getList()]);
    }

    public function actionUpdate($model)
    {
        // Обновление книги (доступно юзерам)
    }

    public function actionDelete($id)
    {
        // Удаление книги (доступно юзерам)
        Book::model()->findByPk($id)->delete();
        $this->render('/site/books', ['books' => Book::model()->getList()]);
    }

    public function actionDeleteConfirm($id)
    {
        // Подтверждение удаления книги (доступно юзерам)
        $this->render('delete', ['model' => Book::model()->getItem($id)]);
    }

    public function actionSubscribe()
    {
        // Подписка на авторов (доступно только гостям)
    }

    public function accessRules()
    {
        return [
            ['allow',
                'actions' => array('view', 'subscribe'),
                'roles' => array('guest')
            ]
        ];
    }
}
