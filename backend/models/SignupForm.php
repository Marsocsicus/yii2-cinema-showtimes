<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use yii\web\NotFoundHttpException;
use yii\db\Expression;
use yii\db\ActiveRecord;

use common\models\User;

class SignupForm extends Model
{
    public $username;
    public $password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            [['username'], 'unique', 'targetClass' => User::class],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
    
    /**
     * Save user
     * @return User|null
     */
    public function save()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->created_at = $time = time();
            $user->updated_at = $time;
            $user->generateAuthKey();
            $user->setPassword($this->password);

            if ($user->save()) {
                return $user;
            }
        }
    }
}
