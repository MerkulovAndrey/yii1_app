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
}