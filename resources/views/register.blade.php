@extends('layouts/header')
@section('content')
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="login-wrap p-0">
                    <h3 class="text-center">Register</h3>
                    <form class="signin-form" action="{{route('register.post')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="name" class="form-control" placeholder="Username" name="username" value="" id="username" aria-describedby="usernameHelp">
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email" name="email" value="" id="email" aria-describedby="emailHelp">
                        </div>

                        <div class="form-group">
                            <input id="password-field" type="password" name="password" class="form-control" placeholder="Password" required>
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>

                        <div class="form-group">
                            <input type="tel" class="form-control" placeholder="Phone Number" name="phone" value="" id="PhoneNumber">
                        </div>

                        <div class="form-group">
                            <button type="submit" name="submit" class="form-control btn btn-primary submit px-3">Submit</button>
                        </div>
                    </form>                       
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@extends('layouts/footer')