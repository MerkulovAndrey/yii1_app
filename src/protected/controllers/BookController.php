<?php

class BookController extends Controller {
    public function actionIndex() {
        // Список книг
    }

    public function actionView($id) {
        // Просмотр книги
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
