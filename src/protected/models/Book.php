<?php

class Book extends CActiveRecord {
    public function relations() {
        return array(
            'authors' => array(self::MANY_MANY, 'Author', 'book_author(book_id, author_id)'),
        );
    }
}

class Author extends CActiveRecord {}

class User extends CActiveRecord {
    public function relations() {
        return array(
            'users' => array(self::MANY_MANY, 'Users', 'users(user_id, user_name, user_password)'),
        );
    }
}
