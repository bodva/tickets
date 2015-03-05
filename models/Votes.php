<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class Votes extends ActiveRecord{

//	public $session_id;
//	public $ticket_id;
//	public $action;


    static function getVote($ticket_id = 0, $action = '') {
        $session_id = session_id () ;
        $vote = Votes::findOne(['session_id' => $session_id, 'ticket_id' => $ticket_id, 'action' => $action]);
        if (!$vote) {
            $vote = new Votes();
            $vote->session_id = $session_id;
            $vote->ticket_id  = $ticket_id;
            $vote->action = $action;    
        }
        return $vote;
    }

    public function vote ($ticket_session) {
        if ($ticket_session == $this->session_id) {
            die('self vote');
            return false;
        }
        if ($this->id) {
            $this->delete();
            switch ($this->action) {
                case 'up':
                    $this->action = 'down';
                    break;
                case 'down':
                    $this->action = 'up';
                    break;
            }
            return true;
        }
        $list = self::find()->where(['session_id' => $this->session_id])->all();
        if (count($list) < 11) {
            try {
                $this->save();
            } catch (Exception $e) {
                throw new Exception($ex->getMessage(), $ex->getCode());
                return false;
            }
        } else {
            return false;
        }
        return $this;
    }

    static public function getRemaining() {
        session_start(); 
        $session_id = session_id();
        $list = self::find()->where(['session_id' => $session_id])->all();
        return 10 - (int)count($list);
    }

    static function getVotedUp() {
        session_start();
        $session_id = session_id();
        $list = self::find()->where(['session_id' => $session_id,'action' => 'up'])->all();
        $ids = [];
        foreach ($list as $element) {
            $ids[] = $element->ticket_id;
        }
        return $ids;
    }

    static function getVotedDown() {
        session_start();
        $session_id = session_id();
        $list = self::find()->where(['session_id' => $session_id,'action' => 'down'])->all();
        $ids = [];
        foreach ($list as $element) {
            $ids[] = $element->ticket_id;
        }
        return $ids;
    }

}