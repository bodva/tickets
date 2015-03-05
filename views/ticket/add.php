<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Add ticket';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-add">
	<h1><?= Html::encode($this->title) ?></h1>
	<?php if (!empty($errors)): ?>
		<?php foreach ($errors as $error): ?>
			<div class="alert alert-danger">
				<?= nl2br(Html::encode($error[0])) ?>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
	<div class="row">
		<div class="col-md-6">
			<div class="">
				<form action="" method="post">
					<div class="form-group">
						<label for="title">Ticket name:</label>
						<input type="text" name="title" id="title" class="form-control"/>
					</div>
					<div class="form-group">
						<label for="descr">Description:</label>
						<textarea class="form-control" name="descr" id="descr" cols="30" rows="10"></textarea>
					</div>
					<div class="form-group">
						<label for="author">Author:</label>
						<input type="text" name="author" id="author" class="form-control"/>
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Submit">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
