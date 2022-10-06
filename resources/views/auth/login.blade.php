<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8">
        <title>Marketplace - MitraJaya</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="© 2021 IT Development - Marketplace APP | MitraJaya" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets\images\favicon.ico')}}">

        <!-- Bootstrap Css -->
        <link href="{{ asset('assets\css\bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="{{ asset('assets\css\icons.min.css')}}" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="{{ asset('assets\css\app.min.css')}}" id="app-style" rel="stylesheet" type="text/css">

    </head>

    <body>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-soft-primary">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">Welcome Back !</h5>
                                            <p>Sign in to continue Marketplace Application.</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{ asset('assets\images\profile-img.png')}}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                
                                <div class="p-2">
                                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                       
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <!-- <input type="text" class="form-control" id="username" placeholder="Enter username"> -->
                                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autofocus>

                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                
                                        <div class="form-group">
                                            <label for="userpassword">Password</label>
                                            <!-- <input type="password" class="form-control" id="userpassword" placeholder="Enter password"> -->
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customControlInline">
                                            <label class="custom-control-label" for="customControlInline">Remember me</label>
                                        </div>
                                        
                                        <div class="mt-3">
                                            <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                                        </div>           
                                       
                                    </form>
                                </div>
            
                            </div>
                        </div>
                    </div>
                </div>
                <div align="center">                    
                    <p style="color: #c6c5c2">© 2021 IT Development - Marketplace APP | MitraJaya</p>
                </div>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        <script src="{{ asset('assets\libs\jquery\jquery.min.js')}}"></script>
        <script src="{{ asset('assets\libs\bootstrap\js\bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('assets\libs\metismenu\metisMenu.min.js')}}"></script>
        <script src="{{ asset('assets\libs\simplebar\simplebar.min.js')}}"></script>
        <script src="{{ asset('assets\libs\node-waves\waves.min.js')}}"></script>
        
        <!-- App js -->
        <script src="{{ asset('assets\js\app.js')}}"></script>
    </body>
</html>