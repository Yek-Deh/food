<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <title>Reset Password Page</title>
</head>
<body class="container">
<h1>Reset Password</h1>
<form action="{{route('admin.reset_password_submit')}}" method="post">
    @csrf
    <input type="hidden" name="token" value="{{$token}}">
    <input type="hidden" name="email" value="{{$email}}">
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">New Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        @error('password')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Confirm new Password</label>
        <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1">
        @error('password_confirmation')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>
