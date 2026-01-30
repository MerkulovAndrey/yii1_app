<?php

class User extends CActiveRecord {
    public $user_passw;
    private $_salt;

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return array(
            array('username, password, email', 'required'),
            array('password', 'length', 'min' => 6),
            array('email', 'email'),
            array('role', 'in', 'range' => array('guest', 'user')),
        );
    }

    protected function afterValidate()
    {
        if ($this->isNewRecord) {
            $this->_salt = $this->generateSalt();
            $this->user_passw = $this->hashPassword($this->user_passw, $this->_salt);
        }
        return true;
    }

    public function validatePassword($password)
    {
        return $this->hashPassword($password, $this->_salt) === $this->user_passw;
    }

    private function hashPassword($password, $salt)
    {
        return md5($salt . $password);
    }

    private function generateSalt($length = 10)
    {
        $chars = "abcdefghijkmnopqrstuvwxyz023456789";
        srand((double)microtime()*1000000);
        $i = 1;
        $salt = '';
        while ($i <= $length) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $salt .= $tmp;
            $i++;
        }
        return $salt;
    }
}
