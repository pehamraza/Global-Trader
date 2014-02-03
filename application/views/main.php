<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Trader</title>
	<?php $this->load->view('headscripts');?>
</head>
<body>

	<div class="container">
		
		<div class="page-header">
			<h1><a href="">Global Trader</a> <small>Best Time Kill Game</small></h1>
		</div>
		<div class="nav navbar-nav navbar-default nav-justified ">
			<ul class="navbar-nav nav">
				<li><a href="<?php echo site_url()?>">Home</a></li>
				<li><a href="">What's the Game</a></li>
				<li><a href="">How to Play</a></li>
				<li><a href="">Reviews</a></li>
				<li><a href="">Developers</a></li>
			</ul>
		</div>

		<div class="jumbotron">
			<br>
			<h1>Fun Trading! <small>Trade Globaly!</small></h1>
			<!-- <h2>Travel to new Areas! <small>Earn Money</small></h2> -->
			<p>Travel to New Continents to grow your business</p>
			<button class="btn btn-inverse btn-lg">&raquo; Explore it!</button>
		</div>
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="row">
					<div class="col-md-6 col-lg-6"> 
						<div class="signup_box">
							<h2>Quick Signup</h2>
							<div>
								<form action="<?php echo site_url() ?>/console/signup" method="post">
									<div class="form-control">
										<label for="Name">Name  </label>
										<input type="text" name="name" placeholder="i.e David Becham" class="block"/>
									</div>
									<div class="form-control">
										<label for="Name">Email  </label>
										<input type="text" name="email" placeholder="i.e me@david.com" class="block"/>
									</div>
									<div class="form-control">
										<label for="Name">Password  </label>
										<input type="password" name="password" placeholder="*******" class="block"/>
									</div>
									<div class="form-control">
										<label for="Name">Confirm Password </label>
										<input type="password" name="cpassword" placeholder="*******" class="block"/>
									</div>
									<div class="">
										<input type="submit" name="signup" value="Signup" class="btn btn-default btn-md" />
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-lg-6">
						<div class="signup_box">
							<h2>Already a member? Login</h2>
							<div>
								<form action="<?php echo site_url() ?>/console/login" method="post">
									<div class="form-control">
										<label for="Name">Email  </label>
										<input type="text" name="email" placeholder="i.e user@demo.com" class="block"/>
									</div>
									<div class="form-control">
										<label for="Name">password  </label>
										<input type="password" name="password" placeholder="*******" class="block"/>
									</div>
									<div class="">
										<input type="submit" name="login" value="Login" class="btn btn-default btn-md" />
										<a class="pull-right" href="">Forgot Password?</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row footer">
			<div class="col-md-12 col-lg-12">
				<p>Copyright &copy; Global Trader 2014</p>
			</div>
		</div>

	</div>

</body>
</html>