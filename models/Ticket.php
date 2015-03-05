<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\db\ActiveRecord;

class Ticket extends ActiveRecord {

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
//			 title, descr, author are required
			[['title', 'descr', 'author'], 'required'],
		];
	}

	public function add ($post) {
		$this->setAttributes($post);
		session_start();
		$this->session_id = session_id();
		try {
			$this->save();
		} catch (Exception $ex) {
			$this->addErrors([$ex->getCode() => $ex->getMessage()]);
			return false;
		}
		return $this->id;
	}

	public function vote($type) {
		session_start();
		$session_id = session_id();
		$list = self::find(['session_id' => $session_id])->all();
		if (count($list) < 10) {
			$vote = new Votes();
			$vote->session_id = $session_id;
			$vote->ticket_id = $this->id;
			switch ($type) {
				case 'up':
					$vote->action = 'up';
					$this->votes++;
					break;
				case 'down':
					$vote->action = 'down';
					$this->vote--;
					break;
			}
			try{
				$vote->save();
			} catch (Exception $ex) {
				$this->addErrors([$ex->getCode() => $ex->getMessage()]);
				return false;
			}
			$this->save();
		}
		return $this;
	}

}