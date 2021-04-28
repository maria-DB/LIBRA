<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600%7CUbuntu:300,400,500,700" rel="stylesheet"> 

    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="css/nouislider.min.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/plyr.css">
    <link rel="stylesheet" href="css/photoswipe.css">
    <link rel="stylesheet" href="css/default-skin.css">
    <link rel="stylesheet" href="css/main.css">

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="icon/favicon-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="icon/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="72x72" href="icon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="icon/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="144x144" href="icon/apple-touch-icon-144x144.png">

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Dmitry Volkov">
    <title>LIBRA – Library Information & Book Keeping Record Access</title>

</head>
<body class="body">

    <div class="sign section--bg" data-bg="img/section/section.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        <!-- registration form -->
                        <form action="#" class="sign__form">
                            <a href="index.html" class="sign__logo">
                                <img src="img/logo.svg" alt="">
                            </a>

                            <div class="sign__group">
                                <input id="name" type="text" class="sign__input" placeholder="Name" required autocomplete="name" autofocus>
                                    <span style="color:red; font-style: italic;" id="validateNameErr" class="validateNameErr"></span>
                                            <span class="validateNameOk" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validateNameOk" class=""></span></i>
                                        </span>
                            </div>

                            <div class="sign__group">
                                <input id="username"type="text" class="sign__input" placeholder="Username" required autocomplete="username">
                                    <span style="color:red; font-style: italic;" id="validateUsernameErr" class="validateUsernameErr"></span>
                                <span class="validateUsernameOk" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validateUsernameOk" class=""></span></i></span>
                                
                            </div>

                            <div class="sign__group">
                                <input id="email" type="text" class="sign__input" placeholder="Email" required autocomplete="email">
                                    <span style="color:red; font-style: italic;" id="validateEmailErr" class="validateEmailErr"></span>
                                        <span class="validateEmailOk" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validateEmailOk" class=""></span></i>
                                    </span>
                            </div>

                            <div class="sign__group">
                                <input id="password" type="password" class="sign__input" placeholder="Password" required autocomplete="new-password">
                                <span style="color:red; font-style: italic;" id="validatePasswordErr" class="validatePasswordErr"></span>
                                    <span class="validatePasswordOk" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validatePasswordOk" class=""></span></i>
                                </span>
                            </div>

                            <div class="sign__group sign__group--checkbox">
                                <input id="remember" name="remember" type="checkbox" checked="checked">
                                <label for="remember">I agree to the <a href="#">Privacy Policy</a></label>
                            </div>

                            <div id="errors"></div>
                            
                            <button id="register" class="sign__btn" type="button">Sign up</button>

                            <span class="sign__text">Already have an account? <a href="#">Sign in!</a></span>
                        </form>
                        <!-- registration form -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.mousewheel.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.min.js"></script>
    <script src="js/wNumb.js"></script>
    <script src="js/nouislider.min.js"></script>
    <script src="js/plyr.min.js"></script>
    <script src="js/jquery.morelines.min.js"></script>
    <script src="js/photoswipe.min.js"></script>
    <script src="js/photoswipe-ui-default.min.js"></script>
    <script src="js/main.js"></script>

    <script>
$(document).ready(function() {
    $('#name').keyup(function(e) {
        e.preventDefault();
        var name = $(this).val();
        var minLength = 4;
        if(e.keyCode == 27 || name == '') {
            //if esc is pressed we want to clear the value of search box
            $('.validateNameOk').css('display', 'none');
            $('.validateNameErr').css('display', 'none');
        } else if($(this).val().length < minLength) {
            $('#validateNameErr').css('display', 'block');
            $('#validateNameErr').text('Please enter at least '+ minLength + ' characters')
            $('.validateNameOk').css('display', 'none');
        } else {
            $('.validateNameOk').css('display', 'block');
            $('#validateNameOk').text('Ok')
            $('#validateNameErr').css('display', 'none');
        }
    });
    $('#username').keyup(function(e) {
        e.preventDefault();
        var username = $(this).val();
        var minLength = 4;
        if(e.keyCode == 27 || username == '') {
            $('.validateUsernameOk').css('display', 'none');
            $('.validateUsernameErr').css('display', 'none');
        } else if($(this).val().length < minLength) {
            $('#validateUsernameErr').css('display', 'block');
            $('#validateUsernameErr').text('Please enter at least '+ minLength + ' characters')
            $('.validateUsernameOk').css('display', 'none');
        } else {
            $('.validateUsernameOk').css('display', 'block');
            $('#validateUsernameOk').text('Ok')
            $('#validateUsernameErr').css('display', 'none');
        }
    });
    $('#email').keyup(function(e) {
        e.preventDefault();
        var email = $(this).val();
        validateEmail(email)
    });

    $('#password').keyup(function(e) {
        e.preventDefault();
        var password = $(this).val();
        var minLength = 8;
        if(e.keyCode == 27 || password == '') {
            $('.validatePasswordOk').css('display', 'none');
            $('.validatePasswordErr').css('display', 'none');
        } else if($(this).val().length < minLength) {
            $('#validatePasswordErr').css('display', 'block');
            $('#validatePasswordErr').text('Please enter at least 6 characters')
            $('.validatePasswordOk').css('display', 'none');
        } else {
            $('.validatePasswordOk').css('display', 'block');
            $('#validatePasswordOk').text('Ok')
            $('#validatePasswordErr').css('display', 'none');
        }
    });


    function validateEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(email == '') {
            $('.validateEmailOk').css('display', 'none');
            $('.validateEmailErr').css('display', 'none');
        } else if(re.test(String(email).toLowerCase())) {
            $('.validateEmailOk').css('display', 'block');
            $('#validateEmailOk').text(email+' is valid')
            $('#validateEmailErr').css('display', 'none');
        } else {
            $('#validateEmailErr').css('display', 'block');
            $('#validateEmailErr').text(email+ ' is not valid')
            $('.validateEmailOk').css('display', 'none');
        }
    }

    $('#register').on('click', function() {
        var name = $('#name').val();
        var username = $('#username').val();
        var email = $('#email').val();
        var password = $('#password').val();


        if(name == "") {
            alert('Name cannot be empty!');
            return;
        }

        if(username == "") {
            alert('Username cannot be empty!');
            return;
        }

        if(email == "") {
            alert('Email cannot be empty!');
            return;
        }

        if(password == "") {
            alert('Password cannot be empty!');
            return;
        }

        else
        {
            $.ajax({
                url: "{{ route('register') }}",
                headers: {
                          'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    name: name,
                    username: username,
                    email: email,
                    password: password
                  
                },
                method:"post",
                dataType:"json",
                success:function(e){
                    console.log(e.msg);
                    if(e.msg=="OK"){
                        window.location = '/login';
                    }

                },
                error:function(e){
                   console.log(e.responseJSON);
                   
                   $.each(e.responseJSON.errors, function(key,value){
                    $('#errors').append('<li style="color:red">'+value+'</li>');    
                   });
                }
            });
        }
    });
 });
</script>
</body>

</html>