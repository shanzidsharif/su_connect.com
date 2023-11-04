@extends('includes.style')
<div class="container-fluid">
    <div class="row clear">
        <div class="col-lg-12"></div>
        <div class="col-lg-8 offset-2 mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-center text-success">
                            <h3>Login</h3>
                        </div>
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="card-body">
                                @include('_message')
                                <div class="form-group row">
                                    <label for="" class="col-md-3">Email</label>
                                    <input type="text" name="email" class="col-md-9 form-control" placeholder="Email">
                                </div>
                                <div class="form-group row mt-2">
                                    <label for="" class="col-md-3">Password</label>
                                    <input type="password" name="password" class="col-md-9 form-control" placeholder="Password">
                                </div>
                                <div class="form-group row mt-2">
                                    <label for="" class="col-md-3"></label>
                                    <div class="col-md-9">
                                        <input type="checkbox" id="remember" name="remember">
                                        <span><label for="remember" class="">Remember me</label></span>
                                    </div>

                                </div>

                                <div class="mt-3 col-md-6 offset-3">
                                    <input type="submit" class="btn btn-outline-success form-control" value="Login">
                                </div>
                            </div>
                        </form>

                        <div class="col-md-6 mb-3 offset-3">
                            <a href="{{ route('forget.password') }}" class="text-info">Forgot Password?</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12"></div>
    </div>
</div>

@extends('includes.script')

