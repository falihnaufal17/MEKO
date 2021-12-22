<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/users/login-1.css" rel="stylesheet" type="text/css" />
    <link href="scss/validation.css" rel="stylesheet"/>
    <script src="plugins/sweetalerts/promise-polyfill.js"></script>
    <link href="plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
</head>
<body style="height: 100% !important;">
    <input type="hidden" value="{{env('APP_URL')}}" name="base_url">
    <form class="form-login" method="POST" autocomplete="off" aria-autocomplete="none" id="formLogin" onsubmit="login(event)">
        <div class="row">
            <div class="col-md-12 text-center mb-4">
                <img alt="logo" src="assets/img/logo-5.png" class="theme-logo">
            </div>

            <div class="col-md-12">
                <div class="form-validation form-group" id="login-phone">
                    <label>Phone</label>
                    <input type="tel" id="inputPhone" class="form-control" autocomplete="off" aria-autocomplete="none" placeholder="Phone" required name="phone">                
                </div>
                <div class="form-validation form-group" id="login-password">
                    <label>Password</label>
                    <input type="password" id="inputPassword" class="form-control" autocomplete="off" aria-autocomplete="none" placeholder="Password" required name="password">
                </div>
                <button class="btn btn-lg btn-gradient-danger btn-block btn-rounded mb-4 mt-5" type="submit">Login</button>
            </div>
        </div>
    </form>
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="assets/js/loader.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/helper.js"></script>
    <script>
        let base_url = $('input[name=base_url]').val()
        function login(e){
            e.preventDefault()
            let formData = $('#formLogin').serialize();

            $.ajax({
                type: 'POST',
                data: formData,
                dataType: 'json',
                url: base_url + '/api/auth/employee/login'
            }).then((res) => {
                localStorage.setItem('token', res.access_token)
                localStorage.setItem('profile', JSON.stringify(res.data))
                
                setTimeout(() => {
                    window.location.href= "/"
                }, 800)
            }).catch((err) => {
                checkValidFromResponse({el: "login-", source: {
                    phone: '',
                    password: ''
                }, errResponse: err.responseJSON.data})
            })
        }
    </script>
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
</body>
</html>