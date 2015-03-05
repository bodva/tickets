<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $this yii\Helpers\Html */
$this->title = 'Tickets List App';
?>
<style>
	.glyphicon-arrow-up {
		cursor: pointer;
	}
	.glyphicon-arrow-down {
		cursor: pointer;
	}
</style>
<div class="site-index">
	<h1>Ticket sytem</h1>
	<div class="row">
		<div class="col-md-1">
			<a href="/ticket/add" class="btn btn-primary">Add ticket</a>
		</div>
	</div>

	<br/>

	<div class="row">
		<div class="col-md-8 col-lg-offset-2">
			<table class="table table-bordered table-condensed table-striped table-hover">
				<tr>
					<th style="width: 45px;">&nbsp;</th>
					<th>id</th>
					<th>name</th>
					<th>author</th>
					<th>votes</th>
				</tr>
				<?php foreach($list as $model): ?>
				<tr>
					<td><i class="glyphicon glyphicon-arrow-up" onclick="upvote(<?= $model->id; ?>);"></i><i class="glyphicon glyphicon-arrow-down" onclick="downvote(<?= $model->id; ?>);"></i></td>
					<td><?= Html::a($model->id,['ticket/','id'=>$model->id]);?></td>
					<td><?= Html::a($model->title,['ticket/','id'=>$model->id]);?></td>
					<td><?= $model->author; ?></td>
					<td id="col-rating-<?= $model->id ?>"><?= $model->votes; ?></td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>

</div>
