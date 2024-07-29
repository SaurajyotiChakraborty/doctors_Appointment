<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin | Doctor's Appointment System</title>
 	

<?php include('./header.php'); ?>
<?php include('./db_connect.php'); ?>
<?php 
session_start();
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>

</head>
<style>
	body{
		width: 100%;
	    height: calc(100%);
	    /*background: #007bff;*/
	}
	main#main{
		width:100%;
		height: calc(100%);
		/* background:white; */
	}
	#login-right{
		position: absolute;
		right:0;
		width:40%;
		height: calc(100%);
		background:white;
		display: flex;
		align-items: center;
		background: url(https://wallpaperaccess.com/full/3275630.jpg);
	    background-repeat: no-repeat;
		background-size: cover;
		width:100%;
	}
	
	#login-right .card{
		margin: auto
	}
	.logo {
    margin: auto;
    font-size: 8rem;
    background: #90ffff87;
    padding: .5em 0.7em;
    border-radius: 50% 50%;
    color: #000000b3;
	}

.card {
 
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  height: 250px !important;
  word-wrap: break-word;
  background-color: #fff;
  background-clip: border-box;
  border: 1px solid rgba(0, 0, 0, 0.125);
  border-radius: 0.25rem;

}
.btn-sm, .btn-group-sm > .btn {
  padding: 0.35rem 0.10rem;
  font-size: 0.875rem;
  line-height: 1.5;
  border-radius: 0.2rem;

}
/* .btn-block + .btn-block {
  margin-top: 20px!important;
} */
.card {
 background: #f5f5f5;
 border-radius: 23px;
background:#e8f8fe;
box-shadow:  42px 42px 84px #e8f8fe,
             -42px -42px 84px #ffffff;
 transition: box-shadow .3s ease, transform .2s ease;
}

.card-body {
 align-items: center;
 transition: transform .2s ease, opacity .2s ease;
}
.card:hover {
 box-shadow: 0 8px 50px #23232333;
}

.card:hover .card-info {
 transform: translateY(-5%);
}






</style>

<body>


  <main id="main" class=" bg-dark">
  		<!-- <div id="login-left">
  			<div class="logo">
  				<span class="fa fa-laptop-medical"></span>
  			</div> -->
  		</div>
  		<div id="login-right">
  			<div class="card col-md-4">
  				<div class="card-body">
  					<form id="login-form" >
  						<div class="form-group">
  							<label for="username" class="control-label">Username</label>
  							<input type="text" id="username" name="username" class="form-control">
  						</div>
  						<div class="form-group">
  							<label for="password" class="control-label">Password</label>
  							<input type="password" id="password" name="password" class="form-control">
  						</div>
  						<center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button></center>
  					</form>
  				</div>
  			</div>
  		</div>
   

  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php?page=home';
				}else if(resp == 2){
					location.href ='voting.php';
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>	
</html>