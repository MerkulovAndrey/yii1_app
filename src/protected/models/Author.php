<?php
/**
 * Author Класс модели авторов
 * @property int $author_id - код автора
 * @property string $author_name - составное имя автора (ФИО)
 * @property string $author_fname - имя
 * @property string $author_lname - фамилия
 * @property string $author_sname - отчество
 */
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

    /**
     * Получение данных автора в виде: код, ФИО
     * @param int $authorId - код автора
     */
    public function getItem(int $authorId)
    {
        return $this->findBySql("
            SELECT
                a.author_id,
                CONCAT_WS(' ', a.author_lname, a.author_fname, a.author_sname) as author_name
            FROM authors a
            WHERE a.author_id = :id
        ", ['id' => $authorId]);
    }

    /**
     * Получение ланных автора в виде: код, фамилия, имя, отчество
     * @param int $authorId - код автора
     */
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

    /**
     * Получение списка авторов
     */
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

    /**
     * Запись автора в БД
     * @param array $data
     * @throws Exception
     */
    public function create(array $data)
    {
        $model = new Author;

        $transaction=$model->dbConnection->beginTransaction();
        try {
            $model->author_fname = $data['author_fname'];
            $model->author_lname = $data['author_lname'];
            $model->author_sname = $data['author_sname'];

            if (!$model->save()) {
                throw new Exception('Ошибка при сохранении автора');
            }

            $transaction->commit();

        } catch (Exception $e) {
            $transaction->rollback();
            throw $e;
        }
    }

    /**
     * Обновление автора в БД
     * @param array $data
     * @throws Exception
     */
    public function updateItem(array $data)
    {
        $model = new Author;

        $transaction=$model->dbConnection->beginTransaction();
        try {
            $model = $this->findByPk($data['author_id']);
            if ($model === null) {
                throw new Exception(sprintf("Обновление автора: автор с id=%d не существует", $data['author_id']));
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

    /**
     * Получение отчёта Топ-10 авторов за указанный год
     * @param int $year год
     */
    public function getReport(int $year) : array
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