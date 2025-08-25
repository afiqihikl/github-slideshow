<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Edit Item</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
	<div class="container" style="max-width: 720px;">
		<h2 class="mb-4">Edit Item</h2>
		<form method="post">
			<div class="mb-3">
				<label class="form-label">Title</label>
				<input type="text" name="title" class="form-control" value="<?php echo set_value('title', $item->title); ?>">
				<div class="text-danger small"><?php echo form_error('title'); ?></div>
			</div>
			<div class="mb-3">
				<label class="form-label">Description</label>
				<textarea name="description" rows="6" class="form-control"><?php echo set_value('description', $item->description); ?></textarea>
				<div class="text-danger small"><?php echo form_error('description'); ?></div>
			</div>
			<button type="submit" class="btn btn-primary">Update</button>
			<a href="<?php echo site_url('items'); ?>" class="btn btn-link">Back</a>
		</form>
	</div>
</body>
</html>