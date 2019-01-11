<?php

namespace app\models\tables;

use Yii;
use app\events\TaskEvent as TaskEvent;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord as ActiveRecord;
use yii\db\AfterSaveEvent;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $name
 * @property string $date
 * @property string $description
 * @property int $responsible_id
 * 
 * @property Users $user
 */
class Tasks extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'date'], 'required'],
            [['date', 'updated_at', 'created_at'], 'safe'],
            [['description'], 'string'],
            [['responsible_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'date' => 'Date',
            'description' => 'Description',
            'responsible_id' => 'Responsible User ID',
            'created_at' => 'Created time',
            'update_at' => 'Updated time'
        ];
    }

    public function getUser() {
        return $this->hasOne(Users::class, ['id' => 'responsible_id']);
    }

    public function getStatus() {
        return $this->hasOne(Status::class, ['id' => 'id_status']);
    }

    private function descriptionForSend() {
        $description = '';

        if ($this->name) {
            $description .= '<b>Название задачи: </b>';
            $description .= $this->name;
        }

        if ($this->date) {
            $description .= '<br>';
            $description .= '<b>Срок исполнения задачи: </b>';
            $description .= $this->date;
        }

        if ($this->description) {
            $description .= '<br>';
            $description .= '<b>Описание задачи: </b>';
            $description .= $this->description;
        }

        return $description;
    }

    public function afterSave($insert, $changedAttributes) {
        if ($insert) {
            $this->trigger(self::EVENT_AFTER_INSERT, new TaskEvent([
                'mail' => $this->user->email,
                'description' => $this->descriptionForSend()
            ]));
        } else {
            $this->trigger(self::EVENT_AFTER_UPDATE, new AfterSaveEvent([
                'changedAttributes' => $changedAttributes,
            ]));
        }
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_at'],
                    ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}
