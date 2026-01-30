<?php

class Author extends CActiveRecord {

    public $author_id;
    public $author_name;
    public $author_fname;
    public $author_lname;
    public $author_sname;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function tableName()
    {
        return 'authors';
    }

    public function getItem($authorId)
    {
        return $this->findBySql("
            SELECT
                a.author_id,
                CONCAT_WS(' ', a.author_lname, a.author_fname, a.author_sname) as author_name
            FROM authors a
            WHERE a.author_id = :id
        ", ['id' => $authorId]);
    }

    public function getItemFull($authorId)
    {
        return $this->findBySql("
            SELECT
                a.author_id,
                a.author_lname,
                a.author_fname,
                a.author_sname
            FROM authors a
            WHERE a.author_id = :id
        ", ['id' => $authorId]);
    }

    public function getList()
    {
        return $this->findAllBySql("
            SELECT
                a.author_id,
                CONCAT_WS(' ', a.author_lname, a.author_fname, a.author_sname) as author_name
            FROM authors a
            ORDER BY author_name
        ", []);
    }

    public function create($data)
    {
        $model = new Author;

        $transaction=$model->dbConnection->beginTransaction();
        try {
            $model->author_fname = $data['author_fname'];
            $model->author_lname = $data['author_lname'];
            $model->author_sname = $data['author_sname'];

            // Запись автора в БД
            if (!$model->save()) {
                throw new Exception('Ошибка при сохранении автора');
            }

            $transaction->commit();

        } catch (Exception $e) {
            $transaction->rollback();
            throw $e;
        }
    }

    public function updateItem($data)
    {
        $model = new Author;

        $transaction=$model->dbConnection->beginTransaction();
        try {
            $model = $this->findByPk($data['author_id']);
            if ($model === null) {
                throw new Exception(sprintf("Обновление автора: автор с id=%d не существует", $data->author_id));
            }

            $model->author_fname = $data['author_fname'];
            $model->author_lname = $data['author_lname'];
            $model->author_sname = $data['author_sname'];

            // Запись автора в БД
            if (!$model->update()) {
                throw new Exception('Ошибка при сохранении автора');
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
		Author::model()->deleteAll('author_id='.$this->author_id);
	}

    public function getReport($year) : array
    {
        return $this->dbConnection->createCommand("
            SELECT CONCAT_WS(' ', a.author_fname, a.author_sname, a.author_lname) author, count(l.book_id) cnt
            FROM link_book_author l
            JOIN authors a ON a.author_id = l.author_id
            JOIN books b ON b.book_id = l.book_id
            WHERE b.book_year = :year
            GROUP BY a.author_id
            ORDER BY cnt DESC
            LIMIT 10
        ")->queryAll(true, ['year' => $year]);
    }

    public function rules()
    {
        return [
            // обязательные поля
            ['author_lname, author_fname', 'required'],
            // длина полей
            ['author_lname', 'length', 'max' => 50],
            ['author_fname', 'length', 'max' => 50],
            ['author_sname', 'length', 'max' => 50],
        ];
    }
}