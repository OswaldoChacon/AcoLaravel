<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
		

<body>
	<div class="container">
		@if (session()->has('flash'))
			<div class="alert alert-info">{{session('flash')}}</div>
		@endif
		@yield('content')
		
	</div>

</body>
</html>