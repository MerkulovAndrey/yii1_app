<?php

class AuthorController extends Controller
{

    public function actionIndex()
    {
        $this->render('index', ['authors' => Author::model()->getList()]);
    }

    // подписка на новые книги автора
    public function actionSubscribe()
    {
        Author::model()->subscribeInsert($_REQUEST['subscribeForm']);
        $this->render('index', ['authors' => Author::model()->getList()]);
    }
}