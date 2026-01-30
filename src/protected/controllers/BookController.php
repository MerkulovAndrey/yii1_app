<?php

class BookController extends Controller {
    public function actionIndex() {
        // Список книг
    }

    // Просмотр книги
    public function actionView($id) {
        $this->render('view', array('model' => Book::model()->getItem($id)));
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
