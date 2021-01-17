<div class="page-header clear-filter">
	<div class="page-header-image" style="background-color:navy;"></div>
	<div class="content">
		<div class="container">
			<div class="col-md-4 ml-auto mr-auto">
				<div class="card card-login card-plain">
					<form id="login-form" class="register-form" method="POST" action="">
						<div class="card-header text-center">
							<div class="logo-container">
								<img src="https://raw.githack.com/creativetimofficial/now-ui-kit/master/assets/img/now-logo.png" alt="">
							</div>
						</div>
						<div class="card-body">
							<?php if ($this->session->flashdata('message')) : ?>
								<?= $this->session->flashdata('message') ?>
							<?php endif; ?>
							<form action="<?= base_url('Auth') ?>" method="post">
								<div class="input-group no-border input-lg">
									<div class="input-group-prepend">
										<span class="input-group-text">
											<i class="fa fa-user"></i>
										</span>
									</div>
									<input type="text" name="username" required autocomplete="off" class="form-control" placeholder="Username...">
								</div>
								<div class="input-group no-border input-lg">
									<div class="input-group-prepend">
										<span class="input-group-text">
											<i class="fa fa-lock"></i>
										</span>
									</div>
									<input type="password" name="password" required autocomplete="off" placeholder="Password..." class="form-control" />
								</div>
								<br>
								<button class="btn btn-primary btn-block btn-round"><i class="fa fa-sign-in-alt"></i> Login</button>
								<a href="<?= base_url('Welcome') ?>">back to home</a>

							</form>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>