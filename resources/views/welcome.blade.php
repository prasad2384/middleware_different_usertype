<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Styles -->
        <style>
            .nav-link {
                color: black;
                font-weight: bold;
                background-color: rgb(255, 217, 0)
            }

            .nav-tabs .nav-link.active {
                background-color: rgb(255, 217, 0) !important;
                color: black !important;
                font-weight: bold !important;
                box-shadow: 0px 4px 8px 4px rgba(184, 19, 19, 0.822);
            }

            .errors {
                color: red;
                font-weight: bold;
            }

            .form-group {
                position: relative;
            }

            .form-group .toggle-password {
                position: absolute;
                top: 70%;
                right: 10px;
                transform: translateY(-50%);
                cursor: pointer;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="row mt-3">
                <div class="col-md-5 m-auto">
                    <nav class="">
                        <div class="nav nav-tabs rounded-top border-bottom-0 d-flex justify-content-between mx-5"
                            id="nav-tab" role="tablist">
                            <button class="nav-link active " id="nav-home-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                aria-selected="true">Register</button>
                            <hr>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                                aria-selected="false">Login</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active px-5 rounded-5" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab" tabindex="0">
                            <form action="" id="form-register">
                                @csrf
                                <div class="form-group mb-3 mt-3">
                                    <label for="">Name</label>
                                    <input type="text" name="name" class="form-control" id="name">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Email</label>
                                    <input type="email" name="register_email" class="form-control"
                                        id="register_email">
                                    <span class="text-danger fw-bold" id='error_register_email'></span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Password</label>
                                    <input type="password" name="register_password" class="form-control"
                                        id="register_password">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control"
                                        id="confirm_password">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Select User Type</label>
                                    <select name="usertype" id="usertype" class="form-control">
                                        <option value="">-------- Select User Type ------</option>
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-warning fw-bold ">Register</button>
                                </div>
                            </form>

                        </div>
                        <div class="tab-pane fade px-5" id="nav-profile" role="tabpanel"
                            aria-labelledby="nav-profile-tab" tabindex="0">
                            <form action="" id="form-login">
                                @csrf
                                <div class="form-group mb-3 mt-3">
                                    <label for="">Email</label>
                                    <input type="email" name="email" class="form-control" id="email">

                                </div>
                                <div class="form-group mb-3 ">
                                    <label for="">Password</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-warning fw-bold">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#form-register').validate({
                errorClass: 'errors',
                ignore: [],
                rules: {
                    name: {
                        required: true,
                    },
                    register_email: {
                        required: true,
                        email: true
                    },
                    register_password: {
                        required: true
                    },
                    confirm_password: {
                        required: true,
                        equalTo: '#register_password'
                    },
                    usertype: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter your name",
                    },
                    register_email: {
                        required: "Please enter your email",
                        email: "Invalid email address"
                    },
                    register_password: {
                        required: "Please enter your password"
                    },
                    confirm_password: {
                        required: "Please confirm your password",
                        equalTo: "Passwords do not match"
                    },
                    usertype: {
                        required: "Please enter your usertype"
                    },
                },
                submitHandler: function(form, event) {
                    $('#error_register_email').text('');
                    $('#error_username').text('');
                    event.preventDefault();
                    $.ajax({
                        type: "Post",
                        url: '/register',
                        data: $(form).serialize(),
                        success: function(response) {
                            console.log(response);
                            if (response.errors) {
                                if (response.errors && response.errors.register_email && response.errors
                                    .register_email[
                                        0]) {
                                    $('#error_register_email').text(response.errors.register_email[0]);
                                }
                            } else {
                                form.reset();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.message,
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 4000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal
                                            .stopTimer)
                                        toast.addEventListener('mouseleave', Swal
                                            .resumeTimer)
                                    }
                                });

                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    })

                }
            });
            $('#form-login').validate({
                errorClass: 'errors',
                ignore: [],
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                },
                messages: {
                    email: {
                        required: "Please enter your email",
                        email: "Invalid email address"
                    },
                    password: {
                        required: "Please enter your password"
                    }
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    $.ajax({
                        type: "Post",
                        url: '/login',
                        data: $(form).serialize(),
                        success: function(response) {
                            console.log(response);
                            if (response.success && response.usertype == 'admin') {
                                form.reset();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.message,
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 4000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal
                                            .resumeTimer)
                                    }
                                });
                                setTimeout(() => {
                                    window.location.href = '/admin_dashboard';
                                }, 4000);

                            } else if (response.success && response.usertype == 'user') {
                                form.reset();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.message,
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 4000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal
                                            .resumeTimer)
                                    }
                                });
                                setTimeout(() => {
                                    window.location.href = '/user_dashboard';
                                }, 4000);

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.message,
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 4000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal
                                            .stopTimer)
                                        toast.addEventListener('mouseleave', Swal
                                            .resumeTimer)
                                    }
                                });

                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    })

                }
            });
        </script>
    </body>

</html>
