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
            <div class="row flex-row-reverse">
                <div class="col-lg-7 col-md-7 d-none d-lg-block d-md-block">
                    <div class="row justify-content-center align-items-center">
                        <div class=" text-center py-5">
                            <img src="./assets/images/illustration/signup.png" alt="" srcset="">
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
                                        Join the Family!
                                    </h3>
                                    <span class="small">Please enter your details</span>
                                </div>
                            </div>
                            <div class="col-10 offset-1">
                                <form class="py-3 mb-3" id ="registrationForm">
                                    <div class="form-floating mb-2">
                                        <input type="text" class="form-control form-control-md gam__form " id="username"name="username" placeholder="name@example.com">
                                        <label for="username" class ="small fw-bold">Username</label>
                                      </div>
                                    <div class="form-floating mb-2">
                                        <input type="email" class="form-control form-control-md gam__form " id="email" name="email" placeholder="name@example.com">
                                        <label for="email" class ="small fw-bold">Email</label>
                                      </div>
                                      <div class="form-floating mb-3">
                                        <input type="password" class="form-control form-control-md gam__form" id="password" name="password" placeholder="Password">
                                        <label for="password">Password</label>
                                      </div>
                                    
                                    <div class="mb-2">
                                        <button type="submit" class="btn btn-dark text-light w-100 rounded-5 small fw-bold">submit</button>
                                    </div>
    
                                </form>
                            </div>
                            <div class="col-12">
                                <div class="mt-4 pt-3 text-center">
                                    <p class="small">
                                            Already have an account?
                                            <a href="./login.php" class="fw-bold text-decoration-none text-dark">
                                                sign in
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
</body>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    console.log("masok bang")
        $(document).ready(function () {
            $("#registrationForm").submit(function (event) {
                event.preventDefault();

                // Get user input
                var username = $("#username").val();
                var email = $("#email").val();
                var password = $("#password").val();

                // Simple client-side validation
                if (!isValidUsername(username) || !isValidEmail(email) || !isValidPassword(password)) {
                    $('.msg').html("<span class='fw-bold text-danger'>Invalid input. Please check your information.</span>");
                    return;
                }

                // Send data to the backend (replace with your backend URL)
                $.post("admin/api/auth/register.php",
                 { 
                    username: username,
                     email: email,
                      password: password
                    },
                  function (response) {
                    // Handle the response from the backend
                    if (response.message === "successful") {
                        
                        $('.msg').html(`<span class='text-success fw-bold'>Hey, Happy to have you here</span>`)
                        setTimeout(function(){
                            window.location.href = "login.php";
                        },3000)
                           
                        
                    } else {
                        $('.msg').html(`<span class="fw-bold text-danger">${response.message}</span>`);
                   
                    }
                });
            });

            function isValidUsername(username) {
                // Add your username validation logic here
                return username.length > 0;
            }

            function isValidEmail(email) {
                // Add your email validation logic here (you can use a regular expression)
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            function isValidPassword(password) {
                // Add your password validation logic here
                return password.length >= 3;
            }
        });
    </script>
</html> 