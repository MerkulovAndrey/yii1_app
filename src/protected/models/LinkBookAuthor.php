<?php

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

    // Записать новые связи
    public function createLinks(int $bookId, array $authorsIds) : bool
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

    // Удалить старые связи
    public function deleteLinks(int $bookId) : int
    {
        return $this->deleteAll("book_id=:book_id", ['book_id'=> $bookId]);
    }
}