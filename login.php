

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home::Learn</title>
        <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="./assets/css/style.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    
    </head>
<body>
    <main class="bg-secondary-subtle py-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 col-md-7 d-none d-lg-block d-md-block">
                    <div class="row justify-content-center align-items-center mt-3">
                        <div class="py-3 text-center py-5">
                            <img src="./assets/images/illustration/loginxc.png" alt="" srcset="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5">
                    <div class="rounded-2 bg-light border py-5">
                        <div class="row">
                            <div class="col-12 lh-sm text-center py-4">
                                <h3 class="fw-bold">
                                    LOGO
                                </h3>
                            </div>
                            <div class="col-12">
                                <div class="lh-sm py-3 text-center">
                                    <h3 class="fw-bold msg">
                                        Welcome Back!
                                    </h3>
                                    <span class="small">Please enter your details</span>
                                </div>
                            </div>
                            <div class="col-10 offset-1">
                                <form class="py-3 mb-3" id="loginForm">
                                    <div class="form-floating mb-2">
                                        <input type="email" class="form-control form-control-md gam__form "name="email" id="email" placeholder="name@example.com">
                                        <label for="floatingInput small fw-bold">Email</label>
                                      </div>
                                      <div class="form-floating mb-3">
                                        <input type="password" class="form-control form-control-md gam__form"name="password" id="password" placeholder="Password">
                                        <label for="password">Password</label>
                                      </div>
                                    <div class="mb-3">
                                        
                                        <span class=" small" for="exampleCheck1"></span>
                                    </div>
                                    <div class="mb-2">
                                        <button type="submit" class="btn btn-dark text-light w-100 rounded-5 small fw-bold submitlogin">submit</button>
                                    </div>
    
                                </form>
                            </div>
                            <div class="col-12">
                                <div class="mt-4 pt-3 text-center">
                                    <p class="small">
                                            Don't have an account?
                                            <a href="./signup.php" class="fw-bold text-decoration-none text-dark">
                                                sign up
                                            </a>
                                    </p>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<script src="./assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function () {
            // Handle form submission
            $("#loginForm").submit(function (event) {
                event.preventDefault();

                // Get user input
                var email = $("#email").val();
                var password = $("#password").val();
                if(email ==="" || password === ""){
                    $('.msg').html('<span class="fw-bold text-danger">Field can not be empty</span>')
                    return false
                }
                // Send data to the backend (replace with your backend URL)
                $.post("admin/api/auth/login.php",
                 { email: email, password: password },
                  function (response) {
                    // Handle the response from the backend
                    if (response.data.message === "successful") {
                        localStorage.setItem('user',response.data.user_id)
                        localStorage.setItem('username',response.data.username)
                        localStorage.setItem('email',response.data.email)
                        // Redirect based on user role
                        $('.msg').append(response.data.username)
                        if (response.data.role === "admin") {
                            window.location.href = "admin/index.php";
                        } else if (response.data.role === "user") {
                            window.location.href = "dash.php";
                        } else {
                            // Handle other roles or scenarios
                            $('.msg').text("Unknown role");
                        }
                    } else {
                        $('.msg').html(`<span class="fw-bold text-danger">${response.data.message}</span>`);
                    }
                });
            });
        });
    </script>
</body>
</html>