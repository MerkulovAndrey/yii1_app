<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    const ROLE_ADMIN = 'admin';

    private $_id;
    private $_login;
    private $_role;

    public function authenticate() {
        $user = User::model()->find('LOWER(user_login)=?', array(strtolower($this->username)));

        if ($user === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if (!$user->validatePassword($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->_id = $user->user_id;
            $this->_login = $user->user_login;
            $this->_role = self::ROLE_ADMIN;
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId() {
        return $this->_id;
    }

    public function getRole() {
        return $this->_role;
    }
}