<?php

class Subscribe extends CActiveRecord {

    public $guest_phone;
    public $author_id;
    public $author_ids;
    public $author_menu;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function tableName()
    {
        return 'subscribes';
    }

    public function subscribeInsert($model)
    {
        $transaction = Subscribe::model()->dbConnection->beginTransaction();
        try {
            foreach($model['selectedIds'] as $authorId) {
                if (!$model->save()) {
                    throw new Exception('Ошибка при оформлении подписки');
                }
                unset($model);
            }
        } catch (Exception $e) {
            $transaction->rollback();
            throw $e;
        }
        $transaction->commit();
        return true;
    }


    public function validatePhone($attribute, $params)
    {
        if (!preg_match('/^\+?[0-9]{10,15}$/', $this->$attribute)) {
            $this->addError($attribute, 'Неверный формат телефона.');
        }
    }

    public function atLeastOneChecked($attribute, $params)
{
    if (empty($this->$attribute)) {
        $this->addError($attribute, 'Необходимо выбрать хотя бы один вариант.');
    }
}

    public function rules()
    {
        return [
            ['guest_phone', 'required'],
            ['guest_phone', 'validatePhone'],
            ['author_ids', 'atLeastOneChecked'],
        ];
    }
}