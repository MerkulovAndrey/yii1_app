<?php

class BookController extends Controller {
    public function actionIndex()
    {
        // Список книг
    }

    // Просмотр книги
    public function actionView($id)
    {
        $this->render('view', array('model' => Book::model()->getItem($id)));
    }

    public function actionCreate()
    {
        // Создание книги (доступно юзерам)
        $this->render('create', array(
            'model' => Book::model(),
            'author_list' => Author::model()->getList()
        ));
    }

    public function actionInsert()
    {
        Book::model()->create($_REQUEST['Book']);
    }

    public function actionUpdate($model)
    {
        // Обновление книги (доступно юзерам)
    }

    public function actionDelete($id)
    {
        // Удаление книги (доступно юзерам)
    }

    public function actionSubscribe()
    {
        // Подписка на авторов (доступно только гостям)
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('view', 'subscribe'),
                'roles' => array('guest')
            )
        );
    }
}
