<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\Event;
use app\models\tables\Tasks as Tasks;

class StartApp extends Component {
    public $emailApp = 'my@mail.ru';

    public function init() {
        $handlerMail = function($event) {
            Yii::$app->mailer->compose()
                ->setTo($event->mail)
                ->setFrom($this->emailApp)
                ->setSubject('TaskTracker: На Вас назначена новая задача')
                ->setHtmlBody($event->description)
                ->send();
        };

        Event::on(Tasks::class, Tasks::EVENT_AFTER_INSERT, $handlerMail);
    }
}
