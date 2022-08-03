<?php

namespace app\models;

use yii\base\Model;

class EntryForm extends Model
{
    public $name;
    public $email;
    public $password;

    public function password($attribute, $params)
    {

    }

    public function rules()
    {
        return [
            [['password', 'email'], 'required'],
            ['email', 'email', 'message'=>'E-mail адрес указан некорректно'],
            [['password'], 'string', 'min'=>6, 'tooShort'=>'Пароль слишком короткий, минимальная длина пароля 6 символов.'],
        ];
    }
}

?>