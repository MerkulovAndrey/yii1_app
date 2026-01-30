<?php

class Book extends CActiveRecord {

    public $book_id;
    public $book_title;
    public $book_authors;
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
}
