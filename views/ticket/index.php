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
					<div class="panel-title"><?= $model->title?> <i title="Votes" class="badge"><?= $model->rating; ?></i></div>
				</div>
				<div class="panel-body">
					<?= $model->descr; ?>
				</div>

				<div class="panel-footer"><?= $model->author; ?></div>

			</div>
		</div>
			
		<div class="col-md-6 col-lg-offset-2">
			<div class="row">
				<div class="coll-md-2 col-lg-offset-1">
					<?php foreach ($comments as $comment) { ?>
						<div class="panel panel-default">
							<div class="panel-heading">
								<div class="panel-title"><?= $comment->author?></div>
							</div>
							<div class="panel-body">
								<?= $comment->comment; ?>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>

		<div class="col-md-8 col-lg-offset-2">
			<div class="row">
				<div class="col-md-6">
					<form method="post" action="">
						<div class="form-group">
							<label for"author">Author</label>
							<input type="text" name="author" class="form-control">
						</div>
						<div class="form-group">
							<label for"author">Comment</label>
							<textarea name="comment" class="form-control"></textarea>
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary" value="Submit">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
