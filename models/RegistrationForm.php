<?php

namespace app\models;

use yii\base\Model;

class RegistrationForm extends Model
{
    public $name;
    public $email;
    public $password;
    public $repeat_password;

    public function rules()
    {
        return [
            [['name', 'email', 'password', 'repeat_password'], 'required', 'message'=>'Поле не должно быть пустым.'],
            ['email', 'email', 'message'=>'E-mail адрес указан некорректно'],
           ['password', 'compare', 'compareAttribute' => 'repeat_password', 'message'=>'Введенные пароли не совпадают.'],
            [['password'], 'string', 'min'=>6, 'tooShort'=>'Пароль слишком короткий, минимальная длина пароля 6 символов.'],
        
        ];
    }
}