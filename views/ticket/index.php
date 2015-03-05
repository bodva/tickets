<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = 'Some Ticket';
$this->params['breadcrumbs'][1] = 'Tickets';
$this->params['breadcrumbs'][2]['label'] = $model->title;
$this->params['breadcrumbs'][2]['url'] = '/ticket/?id='.$ticket_id;
?>
<div class="ticket-add">
	<h1><?= Html::encode($this->title) ?></h1>
	<div class="row">
		<div class="col-md-8 col-lg-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title"><?= $model->title?> <i title="Votes" class="badge"><?= $model->votes; ?></i></div>
				</div>
				<div class="panel-body">
					<?= $model->descr; ?>
				</div>

				<div class="panel-footer"><?= $model->author; ?></div>

			</div>
		</div>
	</div>
</div>
