<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login </title>
	<?php $this->load->view('headscripts');?>
</head>
<body>

	<div class="container">
		
		<div class="page-header">
			<div class="row">
				<div class="col-md-6 col-lg-6">
					<h1><a href="">Global Trader</a> <small>Best Time Kill Game</small></h1>
				</div>

				<div class="col-md-6 col-lg-6 text-right">
					<!-- <h5 class="padding-top-10 padding-right-5">Howdy User

					<h5 class="padding-right-5"><a href="../console/logout">[Logout]</a></h5> -->
					


				</div>
			</div>
		</div>
		<div class="nav navbar-nav navbar-default nav-justified ">
			<ul class="navbar-nav nav">
				<li><a href="<?php echo site_url()?>">Home</a></li>
				<li><a href="">What's the Game</a></li>
				<li><a href="">How to Play</a></li>
				<li><a href="">Reviews</a></li>
				<li><a href="">Developers</a></li>
			</ul>
<!-- 
			<ul class="navbar-nav nav pull-right">
				<li><a href=""><em>Your Ranking: 178</em></a></li>
			</ul> -->
		</div>

		<div class="jumbotron-no-bg">
			<br>
			<div class="row">
				<div class="col-md-12 col-lg-12">

					<div class="signup_box width-50">
							<h2 class="text-center">Already a member? Login</h2>
							<div>
								<form action="<?php echo site_url()?>/console/login" method="post">
									<div class="form-control">
										<label for="Name">Email  </label>
										<input type="text" name="email" placeholder="Write Email Here" class="block"/>
									</div>
									<div class="form-control">
										<label for="Name">Password  </label>
										<input type="password" name="password" placeholder="*******" class="block"/>
									</div>
									<div class="">
										<input type="submit" name="login" value="Login" class="btn btn-default btn-md" />

										<a href="<?php echo site_url() ?>/console/signup" class="pull-right padding-top-5">Don't have an Account? Signup</a>
									</div>
								</form>
							</div>
						</div>
					
				</div>
				
			</div>
			<!-- <h1>Fun Trading! <small>Trade Globaly!</small></h1> -->
			<!-- <h2>Travel to new Areas! <small>Earn Money</small></h2> -->
			<!-- <p>Travel to New Continents to grow your business</p>
			<button class="btn btn-inverse btn-lg">&raquo; Explore it!</button> -->
		</div>
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="row">
					<div class="col-md-6 col-lg-6"> 
<!-- 						<div class="signup_box">
							<h2>Quick Signup</h2>
							<div>
								<form action="">
									<div class="form-control">
										<label for="Name">Name  </label>
										<input type="text" name="name" placeholder="i.e David Becham" class="block"/>
									</div>
									<div class="form-control">
										<label for="Name">Email  </label>
										<input type="text" name="name" placeholder="i.e me@david.com" class="block"/>
									</div>
									<div class="form-control">
										<label for="Name">Password  </label>
										<input type="password" name="name" placeholder="*******" class="block"/>
									</div>
									<div class="form-control">
										<label for="Name">Confirm Password </label>
										<input type="password" name="name" placeholder="*******" class="block"/>
									</div>
									<div class="">
										<input type="submit" name="submit" value="Signup" class="btn btn-default btn-md" />
									</div>
								</form>
							</div>
						</div> -->
					</div>
					<div class="col-md-6 col-lg-6">
						<!-- <div class="signup_box">
							<h2>Already a member? Login</h2>
							<div>
								<form action="/trader/index.php/console/login" method="post">
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
									</div>
								</form>
							</div>
						</div> -->
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