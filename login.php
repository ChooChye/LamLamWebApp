<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LAMLAM - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="core/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-4 col-lg-4 col-md-4">
            <div class="col-lg-12 my-5" align="center">
                <div class="col-lg-6">
                    <img src="img/logo.png" class="img-fluid"/>
                </div>
            </div>
            <div class="alert alert-danger" role="alert" id="errorMsg" style="display: none">
                ERROR
            </div>
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-4">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                </div>
                                <form action="" method="post" class="user">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" id="llEmail" aria-describedby="emailHelp" placeholder="Email Address...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="llPassword" placeholder="Password">
                                    </div>
                                    <!--<div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember Me</label>
                                        </div>
                                    </div>-->
                                    <input type="submit" class="btn btn-primary btn-user btn-block"  id="loginBtn" value="Login" onclick="return login()"/>
                                </form>
                                <!--<hr>
                                <div class="text-center">
                                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="core/js/sb-admin-2.min.js"></script>
<!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.1.2/firebase-app.js"></script>

<!-- Add Firebase products that you want to use -->
<script src="https://www.gstatic.com/firebasejs/8.1.2/firebase-auth.js"></script>
<script>
    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    var firebaseConfig = {
        apiKey: "AIzaSyA7PRvg5Dao3eGYoyAdPZmrRBz-FwI3Iow",
        authDomain: "lamlam-3818d.firebaseapp.com",
        databaseURL: "https://lamlam-3818d.firebaseio.com",
        projectId: "lamlam-3818d",
        storageBucket: "lamlam-3818d.appspot.com",
        messagingSenderId: "145452212040",
        appId: "1:145452212040:web:6cdaf7ce60bb27bedc1d7d",
        measurementId: "G-0BQNKGZ04Q"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    //firebase.analytics();

    const auth = firebase.auth();

    //GET DATA
    function get(id){
        return document.getElementById(id);
    }

    auth.onAuthStateChanged(function (user){
        if(user){
            var uid = auth.currentUser;
            //alert(email + password);
            var email = user.email;
            console.log(email);
        }
    })

    //Auth
    function login(){
        var email = get('llEmail');
        var password = get('llPassword');

        auth.signInWithEmailAndPassword(email.value, password.value)
            .then((userCredential) => {
                // Signed in
                get('loginBtn').disabled = true;
                var user = userCredential.user;
                window.location.href = "http://localhost/www/FYP/WebApp/qrcode.php";
            })
            .catch((error) => {
                var errorCode = error.code;
                var errorMessage = error.message;

                get('errorMsg').innerHTML = "Invalid email or password. Please try again";
                get('errorMsg').style.display = 'block';
            });

        return false;
    }




</script>
</body>

</html>
