<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class RegisterForm extends Model
{
    public $full_name;
    public $login;
    public $password;
    public $email;
    public $phone;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['full_name', 'login', 'password', 'email', 'phone'], 'required'],
            [['full_name', 'login', 'password', 'email', 'phone'], 'string', 'max' => 255],

            ['email', 'email'],

            ['login', 'string', 'min' => 6, 'message' => 'латиница и цифры, не менее 6 символов'],
            ['login', 'match', 'pattern' => '/^[a-z\d]+$/i', 'message' => 'латиница и цифры, не менее 6 символов'],

            ['full_name', 'match', 'pattern' => '/^[а-я\s]+$/iu', 'message' => 'символы кириллицы и пробелы'],

            ['phone', 'match', 'pattern' => '/^\+7\([\d]{3}\)[\d]{3}\-[\d]{2}\-[\d]{2}$/', 'message' => 'формат: +7(XXX)XXX-XX-XX'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'full_name' => 'ФИО',
            'login' => 'Логин',
            'password' => 'Пароль',
            'email' => 'Адресс электронной почты',
            'phone' => 'Номер телефона',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function register(): User |false
    {
        if ($this->validate()) {
            $user = new User();
            $user->load($this->attributes, '');
            $user->password = Yii::$app->security->generatePasswordHash($this->password);
            $user->auth_key = Yii::$app->security->generateRandomString();
            $user->save();
        }
        return $user ?? false;
    }
}
