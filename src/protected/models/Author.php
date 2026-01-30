<?php

class Author extends CActiveRecord {

    public $author_id;
    public $author_name;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function tableName()
    {
        return 'authors';
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
}