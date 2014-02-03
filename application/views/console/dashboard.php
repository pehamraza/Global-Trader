<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Trader</title>
	<?php $this->load->view('headscripts');?>
	<script type="text/javascript">
		
	</script>
</head>
<body>

	<div class="container">
		
		<div class="page-header">
			<div class="row">
				<div class="col-md-6 col-lg-6">
					<h1><a href="">Global Trader</a> <small>Best Time Kill Game</small></h1>
				</div>

				<div class="col-md-6 col-lg-6 text-right">
					<h5 class="padding-top-10 padding-right-5">Howdy <?php echo $this->session->userdata('userName'); ?></h5>

					<h5 class="padding-right-5"><a href="<?php echo site_url(); ?>/console/logout">[Logout]</a></h5>
					


				</div>
			</div>
		</div>
		<div class="nav navbar-nav navbar-default nav-justified ">
			<ul class="navbar-nav nav">
				<li><a href="<?php echo site_url();?>/console/dashboard"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="">What's the Game</a></li>
				<li><a href="">How to Play</a></li>
				<li><a href="">Reviews</a></li>
				<li><a href="">Developers</a></li>
			</ul>

			<ul class="navbar-nav nav pull-right">
				<li><a href=""><em>Your Ranking: 178 <i class="fa fa-star fa-sm"></i> </em></a></li>
			</ul>
		</div>

		<div class="jumbotron-no-bg">
			<br>
			<div class="row">
				<div class="col-md-6 col-lg-6">
					<!-- <img id="Image-Maps-Com-image-maps-2014-01-30-075429" src="http://www.image-maps.com/m/private/0/q5jsqqro8nqdd62m6tc5jagr01_g3.gif" border="0" width="300" height="185" usemap="#image-maps-2014-01-30-075429" alt="" />
<map name="image-maps-2014-01-30-075429" id="ImageMapsCom-image-maps-2014-01-30-075429">
<area id="1" shape="rect" coords="196,43,285,126" alt="Asia" title="Asia" target="_self" href="?con=asia"     />
<area id="Africa" shape="rect" coords="122,101,176,161" alt="Africa" title="Africa" target="_self" href="?cont=africa"     />
<area id="Australia" shape="rect" coords="221,132,281,176" alt="Australia" title="Australia" target="_self" href="?cont=Africa"     />
<area id="Europe" shape="rect" coords="131,50,194,93" alt="Europe" title="Europe" target="_self" href="?cont=europe"     />
<area id="NorthAmerica" shape="rect" coords="11,49,91,114" alt="North America" title="North America" target="_self" href="?cont=northamerica"     />
<area id="SouthAmerica" shape="rect" coords="56,117,117,181" alt="South America" title="South America" target="_self" href="?con=southamerica"     />
<area id="Antarctica" shape="rect" coords="30,9,200,45" alt="Antarctica" title="Antarctica" target="_self" href="?con=antarctica"     />
<area shape="rect" coords="298,183,300,185" alt="Image Map" title="Image Map" href="http://www.image-maps.com/index.php?aff=mapped_users_0" />
</map> -->
<!-- <img src="http://miss-hajeks-geography.wikispaces.com/file/view/world-map_1.png/137734873/world-map_1.png" alt=""> -->

<?php if(isset($countaries)){?>
	
	<h3>Markets in <strong><?php echo $cname; ?></strong></h3>
	 <ul>
	 <?php 

	 if(!empty($countaries)){
	 		
	 			 foreach($countaries as $country)
	 		 		{?>
						<h4><li><a href="<?php echo site_url()."/console/goods/".$country['countryId']; ?>"><?php echo $country['countryName']; ?></a></li></h4>
						<?php }
			}else{ echo "<h4>There are no markets open at this time in ".$cname.". <br /><small>Please visit back later</small>";

			 }?>
	</ul>
<div><br /><a href="<?php echo site_url(); ?>/console/dashboard"><strong>&raquo; Go Back</strong></a></div>

<?php }  
else if(isset($goods)){
function pinc()
			{$rand = rand(1,10);
						$r = rand(10,srand(time()));
						if($r==1)
						{
							$price_increment = $rand*$r;
						}
						else $price_increment = $rand*$r;

						$var  = rand(1,2);
						$inc = floor($price_increment);

						if($var==1)$inc = $inc - ($inc*2);
							return $inc;

					}

	?>

<h3>Goods in <strong><?php echo $coname; 
	$session_days = $this->session->userdata('no_of_days');
	if($session_days!=FALSE)
	{
		$day_no = $session_days+1;
		$this->session->set_userdata('no_of_days', $day_no);
		$loan = $this->session->userdata('loan');
		$new_loan = $this->session->userdata('new_loan');

		echo $loan_p = $loan*(15/100);
		$loan = floor($new_loan+$loan_p);
		$this->session->set_userdata('new_loan',$loan);
	}
	else {$day_no = 1; $nday['no_of_days'] = $day_no; $this->session->set_userdata($nday);}
?></strong>
	<small>(Trading Day <span id="no_of_days"><?php echo $day_no; ?></span>)</small>
</h3>
	 <?php // print_r($countaries)?>
	 <table class="table table-responsive table-striped">
		<?php foreach($goods as $good){ 
			

			// echo $var;
			$new_price = $good['goodPrice']+pinc(); 
			$new_price = abs($new_price); 
			if($new_price==0)$new_price = $new_price+1;
			$account_balance = $this->session->userdata('acc_blnc');
			if($account_balance<=$new_price){$class="disabled btn-default";}else $class=NULL;
			// if()

			$goods_owned = $this->session->userdata('goods_owned');
			if($goods_owned!=FALSE){
						foreach($goods_owned as $gowned)
						{
							if($good['goodId']==$gowned['goodId'])	
							{
								$goods_q = $gowned['quantity'];
							}
							else $goods_q = 0;
						}
						
					}else $goods_q = 0;
			?>



			<tr><td><strong><?php echo $good['goodName']; ?></strong></td><td>$<span id="price<?php echo $good['goodId'];?>" class="new_price"><?php echo $new_price;?></span></td>
				<td><button id="buy<?php echo $good['goodId']; ?>" price="<?php echo $new_price; ?>" value="<?php echo $good['goodName']; ?>" dbid="<?php echo $good['goodId']; ?>" name="btn-buy" class="btn btn-success btn-buy <?php echo $class;?>">Buy</button></td>
				<td><span class="form-control quantity" id="q<?php echo  $good['goodId']; ?>"><?php echo $goods_q; ?></span></td>
				<td><button id="sell<?php echo $good['goodId']; ?>" price="<?php echo $new_price; ?>" value="<?php echo $good['goodName']; ?>" dbid="<?php echo $good['goodId']; ?>" name="btn-sell" class="btn btn-primary btn-sell ">Sell</button></td>

			</tr>
		<?php }?>
	</table>
	
<div><br /><a href="<?php echo site_url(); ?>/console/dashboard"><strong>&raquo; Go Back</strong></a></div>
<?php } 
else{?>

<img id="Image-Maps-Com-image-maps-2014-01-30-081641" src="<?php echo base_url(); ?>resources/images/wmap.png" border="0" width="682" height="344" usemap="#image-maps-2014-01-30-081641" alt="" />
<map name="image-maps-2014-01-30-081641" id="ImageMapsCom-image-maps-2014-01-30-081641">
<area id="Asia" shape="rect" coords="417,5,620,229" alt="Asia" title="Asia" target="_self" href="<?php echo site_url(); ?>/console/continent/5"     />
<area id="Asia2" shape="rect" coords="386,97,423,167" alt="Asia2" title="Asia2" target="_self" href="<?php echo site_url(); ?>/console/continent/5"     />
<area id="Europe" shape="rect" coords="273,25,410,96" alt="Europe" title="Europe" target="_self" href="<?php echo site_url(); ?>/console/continent/3"     />
<area id="Africa" shape="rect" coords="268,114,392,290" alt="Africa" title="Africa" target="_self" href="<?php echo site_url(); ?>/console/continent/6"     />
<area id="Australia" shape="rect" coords="543,230,678,326" alt="Australia" title="Australia" target="_self" href="<?php echo site_url(); ?>/console/continent/4"     />
<area id="NAmerica" shape="rect" coords="0,0,269,173" alt="NAmerica" title="NAmerica" target="_self" href="<?php echo site_url(); ?>/console/continent/2"     />
<area id="SAmerica" shape="rect" coords="121,173,230,344" alt="SAmerica" title="SAmerica" target="_self" href="<?php echo site_url(); ?>/console/continent/1"     />
<area shape="rect" coords="680,342,682,344" alt="Image Map" title="Image Map" href="http://www.image-maps.com/index.php?aff=mapped_users_4610" />
<area  shape="poly" coords="403,114,403,114,403,114,403,114,403,114,403,114,403,114,403,114,403,114,403,114,403,114,403,114,403,114,403,114,403,114,403,114" alt="" title="" target="_self" href="http://www.image-maps.com/"     />
</map>
<?php } 	?>


				</div>
				<div class="col-md-6 col-lg-6 text-right">
				
		<?php if(isset($goods)){
			?>
					
					<div class="wagon"><h4 class="text-success">Wagon Capacity:
					 <span id="bought_items">
					 	<?php $g = $this->session->userdata('goods_owned');
					 	 if($g!=FALSE)
					 	 	{
					 	 		$sum =0; foreach($g as $gg){$sum = $sum + (int)$gg['quantity'];} 
					 	 		echo $sum;
					 	 	} else echo '0';?></span> / <span class="wagon_capacity">100</span></h4></div>
					<div id="notycontainer">
						
					 </div>
					<div class="row">
						<div class="col-md-8 pull-right">
								<div class="" id="bankdiv">
									<h4 class="text-center">Bank</h4>
									<hr>
									<div class="row">
										<div class="col-md-6"><p>On Hand: $150</p></div>
										<div class="col-md-6">
											<button class="btn btn-default deposit-all pull-right" id="deposit-all">Deposit All</button>
										</div>
									</div>
									<div class="row">
										<div class="col-md-8">
											<div class="input-group input-group-sm">
												<span class="input-group-addon">$</span>
											  <input type="text" class="form-control" />
											  
											</div>
										</div>
										<div class="col-md-4">
											<button class="btn btn-default deposit pull-right" id="deposit">Deposit</button>
										</div>
									</div>

									<hr>
									<div class="row">
										<div class="col-md-6"><p>Savings: $150</p></div>
										<div class="col-md-6">
											<button class="btn btn-default withdraw-all pull-right" id="withdraw-all">Withdraw All</button>
										</div>
									</div>
									<div class="row">
										<div class="col-md-8">
											<div class="input-group input-group-sm">
												<span class="input-group-addon">$</span>
											  <input type="text" class="form-control" />
											  
											</div>
										</div>
										<div class="col-md-4">
											<button class="btn btn-default withdraw pull-right" id="withdraw">Withdraw</button>
										</div>
									</div>
								</div>

								<div class="" id="loandiv">
									<h4 class="text-center">Loan</h4>
									<hr>
									<div class="row">
										<div class="col-md-6"><p>On Hand: $150</p></div>
										<div class="col-md-6">
											<button class="btn btn-default deposit-all pull-right" id="deposit-all">Deposit All</button>
										</div>
									</div>
									<div class="row">
										<div class="col-md-8">
											<div class="input-group input-group-sm">
												<span class="input-group-addon">$</span>
											  <input type="text" class="form-control" />
											  
											</div>
										</div>
										<div class="col-md-4">
											<button class="btn btn-default deposit pull-right" id="deposit">Deposit</button>
										</div>
									</div>

									<hr>
									<div class="row">
										<div class="col-md-6"><p>Savings: $150</p></div>
										<div class="col-md-6">
											<button class="btn btn-default withdraw-all pull-right" id="withdraw-all">Withdraw All</button>
										</div>
									</div>
									<div class="row">
										<div class="col-md-8">
											<div class="input-group input-group-sm">
												<span class="input-group-addon">$</span>
											  <input type="text" class="form-control" />
											  
											</div>
										</div>
										<div class="col-md-4">
											<button class="btn btn-default withdraw pull-right" id="withdraw">Withdraw</button>
										</div>
									</div>
								</div>
						</div>
						</div>
					<div class="buttons">
						<a class="btn btn-warning btn-lg" href="<?php echo site_url();?>/console/dashboard">
							<i class="fa fa-plane"></i> Travel</a>
						<!-- <button class="btn btn-info btn-lg" value="">
							<i class="fa fa-user"></i> Store</button> -->
						<button class="btn btn-info btn-lg btn-loan" id="btn-loan" value="0">
							<i class="fa fa-dollar"></i> Loan</button>
						<button class="btn btn-info btn-lg btn-bank" id="btn-bank" value="0">
							<i class="fa fa-dollar"></i> Bank</button>
					</div>
		<?php } ?>
					<div class="statistics">
						<?php 
							if($this->session->userdata('new_acc_blnc')!=FALSE) 
							$acc_blnc = $this->session->userdata('new_acc_blnc');
							else $acc_blnc =  $this->session->userdata('acc_blnc');
						?>
						<h5>Account Balance: $<span class="acc-blnc" id="acc-blnc"><?php echo $acc_blnc;  ?></span></h5>
						<h5>Savings: $<span class="acc-savings" id="acc-savings"><?php echo $this->session->userdata('savings'); ?></span></h5>
						<h5>Loan: $<span class="acc-loan" id="acc-loan"><?php echo $this->session->userdata('loan'); ?></span></h5>
					</div>

		<?php if(isset($goods)){?>
					<div class="buttons">
						<div class="btn-group pull-right">
						  <a href="<?php echo site_url(); ?>/console/continent/<?php echo $cId;?>" class="btn btn-primary  ">Travel within <?php echo $continentName; ?></a>
						  <button type="button" class="btn btn-primary  dropdown-toggle" data-toggle="dropdown">
						    <span class="caret"></span>
						    <span class="sr-only">Toggle Dropdown</span>
						  </button>
						  <ul class="dropdown-menu" role="menu">
						    <?php foreach($countries as $c){?>
						    <li><a href="<?php if($this->uri->segment(3)!=$c['countryId']){echo site_url();?>/console/goods/<?php echo $c['countryId'];} else echo '#';?>"><?php echo $c['countryName'];?></a></li>
						    <?php }?>
						  </ul>
						</div>
						<!-- <button class="btn btn-default btn-lg" value="">Travel within Continent</button> -->
					</div>
					<div id="notylog"></div>
		<?php } ?>
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

					</div>
					<div class="col-md-6 col-lg-6">
						
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