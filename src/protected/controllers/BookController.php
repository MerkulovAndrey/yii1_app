<?php

class BookController extends Controller {
    public function actionIndex() {
        // Список книг
    }

    // Просмотр книги
    public function actionView($id) {
        $this->render('book_edit', array('book' => Book::model()->findByPk($id)));
    }

    public function actionCreate($model) {
        // Создание книги (доступно юзерам)
    }

    public function actionUpdate($model) {
        // Создание книги (доступно юзерам)
    }

    public function actionDelete($id) {
        // Создание книги (доступно юзерам)
    }

    public function actionSubscribe() {
        // Создание книги (доступно только гостям)
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('view', 'subscribe'),
                'roles' => array('guest')
            )
        );
    }

}
