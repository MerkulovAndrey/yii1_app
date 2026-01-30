<?php

class ReportTopForm extends CFormModel
{
    public $year;

    public function rules()
    {
        return [
            ['year', 'required'],
            ['year', 'length', 'max' => 4],
            ['year', 'numerical', 'min' => 1, 'max' => getdate()['year'],'integerOnly' => true],
        ];
    }
}