<?php

namespace app\models\tables;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $name
 * 
 * @property Roles $role;
 */
class Users extends \yii\db\ActiveRecord
{
    const SCENARIO_AUTH = 'auth';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'password', 'name'], 'required'],
            [['login'], 'string', 'max' => 25],
            [['password', 'name'], 'string', 'max' => 50],
            [['role_id'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'name' => 'Name',
            'role_id' => 'Role'
        ];
    }

    public function fields() {
        if ($this->scenario == self::SCENARIO_AUTH) {
            return [
                'id',
                'username' => 'login',
                'password'
            ];
        }

        return parent::fields();
    }

    public function getRole() {
        return $this->hasOne(Roles::class, ["id" => "role_id"]);
    }
}
