<?php

namespace app\models\tables;

use Yii;
use app\events\TaskEvent as TaskEvent;

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
class Tasks extends \yii\db\ActiveRecord
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
            [['date'], 'safe'],
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
        ];
    }

    public function getUser() {
        return $this->hasOne(Users::class, ['id' => 'responsible_id']);
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
}
