<?php

namespace app\controllers;

use app\models\Ticket;
use Yii;
use yii\base\Exception;
use yii\web\Controller;

class TicketController extends Controller {
	public $ticket_id;
	public $enableCsrfValidation = false;

	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}

	public function actionAdd() {
		if (Yii::$app->request->post()){
			$model = new Ticket();
			$model->add(Yii::$app->request->post());
			if (empty($model->errors)) {
				$this->redirect('/ticket?id='.$model->id);
			}
		}
		return $this->render('add',
			['errors' => (isset($model->errors))?($model->errors):([])]
		);
	}

	public function actionIndex($id) {
		$this->ticket_id = $id;
		$model = Ticket::findOne($this->ticket_id);
		if (Yii::$app->request->isAjax) {
			$model->vote($_GET['type']);
			$ret = [
				'rating' => $model->rating , 
				'remaining' => \app\models\Votes::getRemaining() , 
				'errors' => $model->errors,
				];
			return json_encode($ret);
		}
		$comment = new \app\models\Comments();
		$comments = \app\models\Comments::find()->where(['ticket_id'=>$model->id])->all();
		if (Yii::$app->request->post()) {
			$comment->setAttributes(Yii::$app->request->post());
			$comment->ticket_id = $model->id;
			if ($comment->addComment()){
				return $this->refresh();
			} else {
				$this->errors = $comment->errors;
			}
		}
		return $this->render('index',[
			'ticket_id' => $this->ticket_id,
			'model' => $model,
			'comments' => $comments,
		]);
	}
}