<!doctype html>
<html lang="en">
  <head>
  	<title>Multi-Restaurant</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

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
		      	<h3 class="text-center mb-4">Créer un compte</h3>
                  <form method="POST" action="{{ route('register')}}" class="login-form">
                    @csrf

                    @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" style="color: black">{{ $error }}</div>
                    @endforeach
                    @endif

		      		<div class="form-group">
		      			<input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" required autocomplete="name" autofocus placeholder="nom">
                          @error('nom')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

		      		<div class="form-group">
		      			<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Adresse mail">
                          @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

	            <div class="form-group d-flex">
	              <input type="password" class="form-control rounded-left" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Mot de passe">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
	            </div>

	            <div class="form-group d-flex">
	              <input type="password" class="form-control rounded-left" type="password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmation du mot de passe">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
	            </div>

                <div class="form-group" style="display: none">
                    <input type="number" class="form-control @error('type') is-invalid @enderror" name="type" value="0" required autocomplete="type" autofocus readonly>
                    @error('type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

                <div class="form-group">
	            	<button type="submit" class="btn btn-primary rounded submit p-3 px-5">{{ __('Enregistrer')}}</button>
	            </div>
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>
	</body>
</html>
