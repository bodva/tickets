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
		if (!session_id())
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

	function up() {
		$this->rating++;
		return $this;
	}

	function down() {
		$this->rating--;
		return $this;
	}

	public function vote($type) {
		// session_start();
		// $session_id = session_id();
		// $this->session_id = $session_id;

		$vote = Votes::getVote($this->id, $type);
		try {
			if ($vote->vote($this->session_id)) {
				switch ($vote->action) {
					case 'up':
						$this->up();
						break;					
					case 'down':
						$this->down();
						break;					
				}
				$this->save();
			}
		} catch (Exception $e) {
			$this->addErrors([$e->getCode() => $e->getMessage()]);
		}
		return $this;
	}

}