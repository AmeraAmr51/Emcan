@extends('layouts/header')
@section('content')
    
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="login-wrap p-0">
                    <h3 class="text-center">Login</h3>
                    <form action="{{route('login.post')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="username" class="form-control" name="username" value="" id="Username" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" value="" id="password">
                        </div>
                        <input type="submit" class="form-control" name="submit" value="submit" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@extends('layouts/footer')
