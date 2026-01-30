<?php

class Subscribe extends CActiveRecord {

    public $guest_phone;
    public $author_id;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function tableName()
    {
        return 'subscribes';
    }
}