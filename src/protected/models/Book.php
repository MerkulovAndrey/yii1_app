<?php

class Book extends CActiveRecord {

    public $book_id;
    public $book_title;
    public $book_authors;
    public $book_authors_ids;
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
        return $this->findBySql("
            SELECT
                b.*,
                GROUP_CONCAT(
                    CONCAT_WS(' ', a.author_fname, a.author_sname, a.author_lname)
                    SEPARATOR ', '
                ) as book_authors
            FROM books b
            JOIN link_book_author l ON l.book_id = b.book_id
            JOIN authors a ON a.author_id = l.author_id
            WHERE b.book_id = :id
            GROUP BY b.book_id
        ", [':id' => $id]);
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
            $linkModel = new LinkBookAuthor;
            $linkModel->book_id = $newBookId;

            foreach($data['book_authors_ids'] as $item) {
                $linkModel->author_id = $item;
                if (!$linkModel->save()) {
                    throw new Exception('Ошибка при связывании книги с авторами');
                }
            }

            $transaction->commit();

        } catch (Exception $e) {
            $transaction->rollback();
            throw $e;
        }
    }
}
