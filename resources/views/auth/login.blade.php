<!doctype html>
<html lang="en">
  <head>
  	<title>Multi-Restaurant</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('vendor/image.png') }}" type="image/x-icon">
    <title>{{ config('app.name', 'Laravel') }}</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="{{asset('connexion/style.css')}}">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section"></h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5">
						<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
		      	<h3 class="text-center mb-4">Bienvenue</h3>
                  <form method="POST" action="{{ route('login') }}" class="login-form">
                    @csrf

                    @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" style="color: black">{{ $error }}</div>
                    @endforeach
                    @endif
		      		<div class="form-group">
		      			<input type="email" class="form-control rounded-left" placeholder="Email" @error('email') is-invalid @enderror name="email" value="{{ old('email') }}" autocomplete="email" autofocus required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

	            <div class="form-group d-flex">
	              <input type="password" class="form-control rounded-left" placeholder="Password" @error('password') is-invalid @enderror name="password"  autocomplete="current-password" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
	            </div>

                @php 
                $io= App\Http\Controllers\Auth\LoginController::countUsers();
                @endphp
                @if($io==0)
	            <div class="form-group d-md-flex">
	            	<div class="w-50">
                        <a style="text-decoration: none" href="{{route('register')}}">
	            		<label class="checkbox-wrap checkbox-primary">
                            Créer un compte
                        </label>
                        </a>
					</div>
                </div>
                @endif
	            
                <div class="form-group">
	            	<button type="submit" class="btn btn-primary rounded submit p-3 px-5">{{ __('Se connecter')}}</button>
	            </div>
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>

	</body>
</html>

