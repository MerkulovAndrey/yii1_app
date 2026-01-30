<?php

class Book extends CActiveRecord {

    const AUTOR_IDS_SEPARATOR = ';';
    public $book_id;
    public $book_title;
    public $book_authors;
    public $book_authors_ids; // для значений из результатов sql-запроса
    public $book_authors_ids_arr; // для передачи из/в формы
    public $book_year;
    public $book_desc;
    public $book_pic;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function tableName()
    {
        return 'books';
    }

    public function getItem($id)
    {
        $model = $this->findBySql("
            SELECT
                b.*,
                GROUP_CONCAT(
                    CONCAT_WS(' ', a.author_fname, a.author_sname, a.author_lname)
                    SEPARATOR ', '
                ) as book_authors,
                GROUP_CONCAT(
                    a.author_id
                    SEPARATOR '" . self::AUTOR_IDS_SEPARATOR . "'
                ) as book_authors_ids
            FROM books b
            JOIN link_book_author l ON l.book_id = b.book_id
            JOIN authors a ON a.author_id = l.author_id
            WHERE b.book_id = :id
            GROUP BY b.book_id
        ", [':id' => $id]);

        $model->book_authors_ids_arr = explode(self::AUTOR_IDS_SEPARATOR, $model->book_authors_ids);

        return $model;
    }

    public function getList()
    {
        return $this->findAllBySql("
            SELECT
                b.*,
                GROUP_CONCAT(
                    CONCAT_WS(' ', a.author_fname, a.author_sname, a.author_lname)
                    SEPARATOR ', '
                ) as book_authors
            FROM books b
            JOIN link_book_author l ON l.book_id = b.book_id
            JOIN authors a ON a.author_id = l.author_id
            GROUP BY b.book_id
        ", []);
    }

    public function create($data)
    {
        $model = new Book;

        $transaction=$model->dbConnection->beginTransaction();
        try {
            $model->book_title = $data['book_title'];
            $model->book_year = $data['book_year'];
            $model->book_desc = $data['book_desc'];
            $model->book_isbn = $data['book_isbn'];
            $model->book_pic = $data['book_pic'];

            // Запись книги в БД
            if (!$model->save()) {
                throw new Exception('Ошибка при сохранении книги');
            }

            // Получить id книги
            $newBookId = $model->dbConnection->lastInsertID;
            if ($newBookId <= 0) {
                throw new Exception('Не удалось найти последнюю сохраненённую книгу');
            }

            // Записать связи с авторами
            if (!LinkBookAuthor::model()->createLinks(
                $newBookId,
                $data['book_authors_ids_arr']
            )) {
                throw new Exception('Ошибка при связывании книги с авторами');
            }

            $transaction->commit();

        } catch (Exception $e) {
            $transaction->rollback();
            throw $e;
        }
    }

    public function updateItem($data)
    {
        $model = new Book;

        $transaction=$model->dbConnection->beginTransaction();
        try {
            $model = $this->findByPk($data['book_id']);
            if ($model === null) {
                throw new Exception(sprintf("Обновление книги: книга с id=%d не существует", $data->book_id));
            }

            $model->book_title = $data['book_title'];
            $model->book_year = $data['book_year'];
            $model->book_desc = $data['book_desc'];
            $model->book_isbn = $data['book_isbn'];
            $model->book_pic = $data['book_pic'];

            // Запись книги в БД
            if (!$model->update()) {
                throw new Exception('Ошибка при сохранении книги');
            }

            // Обновить связи с авторами
            LinkBookAuthor::model()->deleteLinks($model->book_id); // Удалить старые связи

            // записать новые связи
            if (!LinkBookAuthor::model()->createLinks(
                $model->book_id,
                $data['book_authors_ids_arr']
            )) {
                throw new Exception('Ошибка при связывании книги с авторами');
            }

            $transaction->commit();

        } catch (Exception $e) {
            $transaction->rollback();
            throw $e;
        }

    }

    protected function afterDelete()
	{
		parent::afterDelete();
		Book::model()->deleteAll('book_id='.$this->book_id);
	}
}
