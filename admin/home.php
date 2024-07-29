<style>
	nav#sidebar {
    height: calc(100%);
    position: fixed;
    z-index: 99;
    left: 0;
    width: 270px;
    background: url(https://wallpaperaccess.com/full/4088488.png);
	background-repeat: no-repeat;
    background-size: 300px 100% ;
}
.card {
	height: 90% !important;
	position: fixed !important;
	width: 90% !important;
}

.card-body {
    height: 100% !important;
    justify-content: center;
    align-content: center;
	display: grid !important;
	font-size: 50px;
	font-weight: bold;
	color: #000;
}
.card-body
{
   text-transform: uppercase;
  background-image: linear-gradient(
    -225deg,
    #231557 0%,
    #44107a 29%,
    #ff1361 67%,
    #fff800 100%
  );
  background-size: auto auto;
  background-clip: border-box;
  background-size: 200% auto;
  color: #fff;
  background-clip: text;
  text-fill-color: transparent;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  animation: textclip 2s linear infinite;
  display: inline-block;
      font-size: 50px;
}

@keyframes textclip {
  to {
    background-position: 200% center;
  }
}


</style>

<div class="containe-fluid">

	<div class="row">
		<div class="col-lg-12">
			
		</div>
	</div>

	<div class="row mt-3 ml-3 mr-3">
			<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
				<?php echo "Welcome back ".($_SESSION['login_type'] == 3 ? "Dr. ".$_SESSION['login_name'].','.$_SESSION['login_name_pref'] : $_SESSION['login_name'])."!"  ?>
									
				</div>
				<hr>
				<div class="row">
				
				</div>
			</div>
			
		</div>
		</div>
	</div>

</div>
<script>
	
</script>