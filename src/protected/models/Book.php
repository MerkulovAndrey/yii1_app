<?php

class Book extends CActiveRecord {

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function tableName() {
        return 'books';
    }
/* **
    public function relations() {
        return array(
            'authors' => array(self::MANY_MANY, 'Author', 'book_author(book_id, author_id)'),
        );
    }
*/
}
