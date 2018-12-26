<?php

namespace app\models;

use \yii\base\Model as Model;
use \app\traits\ValidatorTask;

class Task extends Model
{
    public $id;
    public $name;
    public $description;
    public $creator;
    public $performer;
    public $status;
    public $priority;
    public $dateImplementation;
    public $dateBegin;    
    public $dateEnd;    

    public function rules()
    {
        return [
            'requiredAttr' => [['name', 'description'], 'required'],

            'trimAttr' => [['name', 'description', 'creator', 'performer', 'status', 'priority'],
                'trim'],
            
            'name' => ['name', 'string', 'min' => 5, 'message' => 
                'Минимальная длина названия задачи должна быть 5 символов'],

            'description' => [['description'], 'string', 'min' => 10, 'message' => 
                'Минимальная длина описания задачи должна быть 10 символов'],

            'creatorDefault' => ['creator', 'default', 'value' => 'admin'],

            'performerDefault' => ['performer', 'default', 'value' => 'admin'],

            'statusDefault' => ['status', 'default', 'value' => 'new'],

            'priorityDefault' => ['priority', 'default', 'value' => 'very low'],

            'dateBeginEndDefault' => [['dateBegin', 'dateEnd'], 'default', 'value' => null],

            'dateImplementationDefault' => ['dateImplementation', 'default', 'value' => date('Y-m-d', 
                strtotime('+1 week'))],

            'dateIsDate' =>  [['dateImplementation', 'dateBegin', 'dateEnd'], 'date', 'format' => 'php:Y-m-d',              'message' => "{attribute} должен быть датой"],

            'compareDateBeginEnd' => ['dateEnd', 'compare', 'compareAttribute' => 'dateBegin', 'operator' => '>=',],
            
            ['status', 'in', 'range' => ['new', 'in work', 'end'], 'message' => 
                'Статус может быть либо "new", либо "in work" или "end"'],
            ['priority', 'in', 'range' => ['very high', 'high', 'medium', 'low', 'very low'], 'message' => 
                'Приоритет может принимать значение из списка: "very high", "high", "medium", "low". "very low"']
        ];
    }
}