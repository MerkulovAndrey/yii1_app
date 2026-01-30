<?php

class BookController extends Controller {

    /**
     * Список книг
     */
    public function actionIndex()
    {
		$this->render('index', ['books' => Book::model()->getList()]);
    }

    /**
     * Просмотр книги
     * @param int $id - код книги
     */
    // Просмотр книги
    public function actionView(int $id)
    {
        $this->render('view', ['model' => Book::model()->getItem($id)]);
    }

    /**
     * Создание книги - вывод формы (доступно юзерам)
     */
    public function actionCreate()
    {
        $this->handleUnauthorizedUser();
        $this->render('create', [
            'model' => Book::model(),
            'author_list' => Author::model()->getList()
        ]);
    }

    /**
     * Создание книги - запись в БД (доступно юзерам)
     */
    public function actionInsert()
    {
        $this->handleUnauthorizedUser();
        if (isset($_REQUEST['Book'])) {
            Book::model()->create($_REQUEST['Book']);
        }
        $this->render('index', ['books' => Book::model()->getList()]);
    }

    /**
     * Редактирование книги - вывод формы (доступно юзерам)
     * @param int $id - код книги
     */
    public function actionEdit(int $id)
    {
        $this->handleUnauthorizedUser();
        $this->render('edit', [
            'model' => Book::model()->getItem($id),
            'author_list' => Author::model()->getList()
        ]);
    }

    /**
     * Редактирование книги - запись в БД (доступно юзерам)
     */
    public function actionUpdate()
    {
        $this->handleUnauthorizedUser();
        if (isset($_REQUEST['Book'])) {
            Book::model()->updateItem($_REQUEST['Book']);
        }
        $this->render('index', ['books' => Book::model()->getList()]);
    }

    /**
     * Удаление книги (доступно юзерам)
     * @param int $id - код книги
     */
    public function actionDelete(int $id)
    {
        $this->handleUnauthorizedUser();
        Book::model()->findByPk($id)->delete();
        $this->render('index', ['books' => Book::model()->getList()]);
    }

    /**
     * Подтверждение удаления книги (доступно юзерам)
     * @param int $id - код книги
     *  */
    public function actionDeleteConfirm(int $id)
    {
        $this->handleUnauthorizedUser();
        $this->render('delete', ['model' => Book::model()->getItem($id)]);
    }

}
