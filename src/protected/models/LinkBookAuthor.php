<?php
/**
 * LinkBookAuthor модель связки книг с авторами
 * @property int $book_id
 * @property int $author_id
 */
class LinkBookAuthor extends CActiveRecord {

    public $book_id;
    public $author_id;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function tableName()
    {
        return 'link_book_author';
    }

    /**
     * Записать новые связи
     *
     * @param int $bookId
     * @param array $authorsIds
     * @return bool - true в случае успешной связки
     */
    public function createLinks(int $bookId, array $authorsIds): bool
    {
        foreach($authorsIds as $item) {
            $linkModel = new LinkBookAuthor;
            $linkModel->book_id = $bookId;
            $linkModel->author_id = $item;
            if (!$linkModel->save()) {
                return false;
            }
            unset($linkModel);
        }
        return true;
    }

    /**
     * Удаление связей
     * @param int $bookId
     * @return int
     */
    public function deleteLinks(int $bookId): int
    {
        return $this->deleteAll("book_id=:book_id", ['book_id'=> $bookId]);
    }
}