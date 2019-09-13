<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

<body>
	<div class="container">
		@if (session()->has('flash'))
			<div class="alert alert-info">{{session('flash')}}</div>
		@endif
		@yield('content')
		
	</div>

</body>
</html>