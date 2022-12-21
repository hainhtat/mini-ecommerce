<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md4 offset-md-4">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        Admin Login
                    </div>

                    <div class="card-body">
                        <form action="{{url('/admin/login')}}" method="post">
                            @csrf
                            @if(session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session()->get('error') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="email">Enter Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="password">Enter Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <input type="submit" class="btn btn-danger" value="login">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>