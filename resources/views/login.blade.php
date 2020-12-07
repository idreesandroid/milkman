
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <title>Login - MilkManApp</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicon.png')}}">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}} ">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">


        <!--font style-->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600&display=swap" rel="stylesheet">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
		
		
    </head>
    <body class="account-page">
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				
				<div class="container">
				
					<!-- Account Logo -->
					<div class="account-logo">
						<a href="/"><img src="assets/img/logo.png" alt="Dreamguy's Technologies"></a>
					</div>
					<!-- /Account Logo -->
 

					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Login</h3>
							<p class="account-subtitle">Access to our dashboard</p>
							
							<!-- Account Form -->
							<form method="post"  action="/login" >
               				 @csrf 
								<div class="form-group">

									<label>Mobile/CNIC</label>
									<input class="form-control" type="text" name="username" required="" autocomplete="off" >

								</div>
								<div class="form-group">
									<div class="row">
										<div class="col">
											<label>Password</label>
										</div>
										<div class="col-auto">
											
										</div>
									</div>

									<input class="form-control" name="password" type="password" placeholder="Password" autocomplete="off">

								</div>
								<div class="form-group text-center">
									<input class="btn btn-primary account-btn" type="submit" value="Login">
							 
							</form>
							<!-- /Account Form -->
							
						</div>
					</div>
				</div>
			</div>

        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="{{asset('assets/js/jquery-3.5.0.min.js')}}"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="{{asset('assets/js/popper.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('assets/js/app.js')}}"></script>
		
    </body>
</html>