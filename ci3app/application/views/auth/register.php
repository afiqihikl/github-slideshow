<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Register</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
	<div class="container" style="max-width: 560px;">
		<h2 class="mb-4">Register</h2>
		<?php if ($this->session->flashdata('error')): ?>
			<div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
		<?php endif; ?>
		<form method="post">
			<div class="mb-3">
				<label class="form-label">Username</label>
				<input type="text" name="username" class="form-control" value="<?php echo set_value('username'); ?>">
				<div class="text-danger small"><?php echo form_error('username'); ?></div>
			</div>
			<div class="mb-3">
				<label class="form-label">Email</label>
				<input type="email" name="email" class="form-control" value="<?php echo set_value('email'); ?>">
				<div class="text-danger small"><?php echo form_error('email'); ?></div>
			</div>
			<div class="mb-3">
				<label class="form-label">Password</label>
				<input type="password" name="password" class="form-control">
				<div class="text-danger small"><?php echo form_error('password'); ?></div>
			</div>
			<div class="mb-3">
				<label class="form-label">Confirm Password</label>
				<input type="password" name="password_confirm" class="form-control">
				<div class="text-danger small"><?php echo form_error('password_confirm'); ?></div>
			</div>
			<button type="submit" class="btn btn-success">Create account</button>
			<a href="<?php echo site_url('login'); ?>" class="btn btn-link">Back to login</a>
		</form>
	</div>
</body>
</html>