<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>My Items</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
	<div class="container">
		<div class="d-flex justify-content-between align-items-center mb-3">
			<h2>My Items</h2>
			<div>
				<a href="<?php echo site_url('items/create'); ?>" class="btn btn-primary">New Item</a>
				<a href="<?php echo site_url('logout'); ?>" class="btn btn-outline-secondary">Logout</a>
			</div>
		</div>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Description</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($items as $item): ?>
				<tr>
					<td><?php echo (int)$item->id; ?></td>
					<td><?php echo htmlentities($item->title); ?></td>
					<td><?php echo nl2br(htmlentities($item->description)); ?></td>
					<td>
						<a href="<?php echo site_url('items/edit/'.$item->id); ?>" class="btn btn-sm btn-warning">Edit</a>
						<a href="<?php echo site_url('items/delete/'.$item->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this item?');">Delete</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php if (empty($items)): ?>
			<div class="alert alert-info">No items yet. Create your first one.</div>
		<?php endif; ?>
	</div>
</body>
</html>