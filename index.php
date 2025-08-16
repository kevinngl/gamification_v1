<?php
  include "./function.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home::Learn</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

</head>
<body>
    <main>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
              <a class="navbar-brand fw-bold " href="./index.php">Logo</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
              

              <?php

                    if(isLoggedIn()):
                ?>
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                 
                 
                <li class="nav-item px-2">
                    <a class="nav-link active fw-bold text-muted" aria-current="page" href="./index.php"><i class="fa-solid fa-house"></i>Home</a>
                  </li>
                  <li class="nav-item px-2">
                    <a class="nav-link active fw-bold text-muted" aria-current="page" href="./dash.php"><i class="fa-solid fa-gauge-simple-high"></i></i>Dashboard</a>
                  </li>
                  <li class="nav-item px-2">
                    <a class="nav-link fw-bold text-muted" href="./course.php"><i class="fa-solid fa-book-open"></i> Course</a>
                  </li>
                  <li class="nav-item px-2">
                    <a class="nav-link fw-bold text-muted" aria-disabled="true" href="./challenge.php"><i class="fa-solid fa-gamepad"> </i> Trivia Games</a>
                  </li>
                  <li class="nav-item px-2">
                    <a class="nav-link fw-bold text-muted" aria-disabled="true" href="./leaderboard.php"><i class="fa-solid fa-ranking-star"></i> Leaderboard</a>
                  </li>
                  <li class="nav-item px-2">
                    <a class="nav-link active fw-bold text-muted" aria-current="page" href="./feedback.php"><i class="fa-solid fa-comment"></i></i>Feedback</a>
                  </li>
                </ul>
                       
              <?php endif;

              ?>
                
                <div class="d-flex  ms-auto px-3" role="search">
                <?php

                    if(isLoggedIn()){
                        echo '<div class="text-center px-2">
                        <a href="./logout.php" class="fw-bold text-decoration-none text-dark"><i class="fa-solid fa-right-to-bracket"></i>&nbsp;Logout</a>
                    </div>';

                    }else{
                      echo '
              
                        <div class="text-center">
                            <a class="nav-link text-dark fw-bold text-muted" aria-current="page" href="./index.php">Home</a>
                          </div>
                          <div class="text-center text-dark px-2">
                            <a class="nav-link  fw-bold text-muted" aria-current="page" href="#">Feedback</a>
                          </div>
                      
                      
                      <div class="text-center">
                      <a href="./login.php" class="fw-bold text-decoration-none text-dark">&nbsp;Login</a>
                  </div>
                  
                  <div class="text-center px-2 ">
                      <a href="./signup.php" class="fw-bold text-decoration-none text-dark">&nbsp;Signup</a>
                  </div>';
                    }
                    ?>
                  

               
                </div>
              </div>
            </div>
          </nav>
          <!--nav fixed-->
          <!--header start-->
          <header class="gam__headerbg">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 px-0">
                        <div class="bg-light text-dark p-5 mb-3 gam__edge">
                            <div class="d-flex justify-content-start py-5">
                                <button class=" bg-info-subtle border-0 text-info px-3 me-3 fw-bold">
                                    Education
                                </button>
                                <button class="btn btn-sm bg-success-subtle border-0 rounded-0 text-success px-3 me-3 fw-bold">
                                  Learn
                              </button>
                            </div>
                            <div class="text-start ">
                                <h3 class="fw-bold display-4">
                                   Enhancing Learning And Education with <span class="gam__emphasis d-block"> Gamification:</span>
                                </h3>
                                <p class="my-4 fw-bold text-light-emphasis h5">
                                  Taking a look into learning with Gaming
                                </p>
                                <div class="d-flex justify-content-start  align-items-between mt-3">
                                  <!--card1-->
                                  <div class="card my-2 rounded-0 border-0 bg-info-subtle py-1 me-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                              <div class="me-2 ">
                                                <img src="./assets/images/icons/cup.png" alt="" class="" style="width:20px;height:20px">
                                              </div>
                                              <div class=" lh-sm">
                                                <h6 class="text-info fw-bold mb-0 small">
                                                  Championship
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                    <!--card2-->
                                    <div class="card my-2 rounded-0 border-0 bg-warning-subtle py-1">
                                      <div class="card-body ">
                                          <div class="d-flex align-items-center">
                                                <div class="me-2 ">
                                                  <img src="./assets/images/icons/user.png" alt="" class="" style="width:20px;height:20px">
                                                </div>
                                                <div class=" lh-sm">
                                                  <h6 class="text-muted fw-bold mb-0 small">
                                                    Rankings
                                                  </h6>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                    <!--card3-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 d-none d-lg-block d-md-block">
                      <div class="row justify-content-end align-items-center">
                          <div class="pt-5">
                            <img src="./assets/images/illustration/illustration-2.png" alt="" class="img-fluid object-fit-cover">
                          </div>
                          
                      </div>
                    </div>
                </div>
            </div>
          </header>
          <!--header fixed-->
          <section class="bg-body-tertiary pt-4">
              <div class="container">
                  <div class="row align-items-center position-relative">
                    <div class="mt-5  mb-0 mb-0 text-center">
                        <h3 class="fw-bolder text-dark opacity-25 display-2">
                           Featured Courses
                        </h3>
                    </div>
              </div>
              <div class="row" id="course">
                    <!--card-->
                    
              
                
              <!--more-->
              <div class="col">
                  <div class="float-end py-3">
                      <a href="" class="btn btn-md btn-link fw-bold text-decoration-none text-dark">
                        More
                        <img src="./assets/images/icons/arrow.png" alt="arrow-here" class="img-fluid">
                      </a>
                  </div>
              </div>
              <!--more-->
                  </div>
              </div>
          </section>
          <!--how it works-->
          <section class="bg-danger-subtle py-5 mb-0">
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="mt-5  mb-0 mb-0 text-center">
                        <h3 class="fw-bolder text-dark opacity-25 display-2">
                            How it works
                        </h3>
                     </div>
                  </div>
                  <div class="row justify-content-between align-items-center">
                        <div class="col-lg-3  col-md-3 col-sm-4 h-auto  lh-sm text-center">
                            <div class="py-2 ">
                                <img src="./assets/images/icons/learn.png" alt="" class="gam__image-circle shadow-sm">
                            </div>
                            <p class="lead fw-bold mb-0 text-danger opacity-75">
                              Take a Course
                            </p>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4 h-auto text-danger opacity-75 text-center">
                          <div class="py-2 ">
                              <img src="./assets/images/icons/quiz.png" alt="" class="gam__image-circle shadow-sm">
                          </div>
                          <p class="lead fw-bold mb-0">
                            Get Quizzed
                          </p>
                         
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-4 h-auto text-danger opacity-75 text-center">
                        <div class="py-2 ">
                            <img src="./assets/images/illustration/coin.png" alt="" class="gam__image-circle shadow-sm">
                        </div>
                        <p class="lead fw-bold mb-0">
                          Earn Rewards
                        </p>
                       
                    </div>
                      <div class="col-lg-3 col-md-3 col-sm-4 align-self-baseline h-auto text-danger  opacity-75 lh-sm text-center">
                        <div class="py-2">
                            <img src="./assets/images/icons/rank.png" alt="" class="gam__image-circle shadow-sm">
                        </div> 
                        <p class="lead fw-bold mb-0">
                          Get Ranked
                        </p>
                       

                    </div>
                  </div>
              </div>
          </section>
          <!--how it works-->
          <section class="bg-light pb-5">
            <div class="container">
                    <div class="row my-3">
                        <div class="mt-5  mb-0 mb-0 text-center">
                          <h3 class="fw-bolder text-dark opacity-25 display-1">
                              Quiz Challenge
                          </h3>
                      </div>
                    </div>
                    <div class="row my-3" id="quiz">
                      <!--card-->
                       
                </div>
            </div>
        </section>
        

        <!--end championship-->

        <!--testimonial-->
        <!--footer-->
          <footer class="bg-black text-light py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-4">
                        <div class="lh-sm">
                            <h3 class="fw-bold">
                                LOGO
                            </h3>
                        </div>
                    </div>
                    <div class="col-4">
                      <div class="lh-sm">
                        <h3 class="fw-bold ps-4">
                           Links
                        </h3>
                          <ul class="list-group-flush">
                              <li class="list-group-item border border-0 py-1">Home</li>
                              <li class="list-group-item border border-0 py-1">Courses</li>
                              <li class="list-group-item border border-0 py-1">Challenges</li>
                              <li class="list-group-item border border-0 py-1">Sign Up</li>
                          </ul>
                    </div>
                    </div>
                    <div class="col-4">
                      <div class="lh-sm">
                        <h3 class="fw-bold">
                            Courses
                        </h3>
                          <ul class="list-group-flush">
                              <li class="list-group-item border border-0 py-1">Science</li>
                              <li class="list-group-item border border-0 py-1">Mathematics</li>
                              <li class="list-group-item border border-0 py-1">General Knowledge</li>
                              <li class="list-group-item border border-0 py-1">Economics</li>
                          </ul>
                    </div>
                    </div>


                </div>
            </div>

          </footer>
        <!--footer-->
    </main>

 <?php 
 include "./footer.php";
 ?>
 <script>
    $(document).ready(function(){
          // jQuery AJAX request
          $.ajax({
            url: 'admin/api/course/courseView.php', // Replace with your API endpoint
            method: 'GET',
            dataType: 'json',
            success: function(response) {
              let result = response.data.map((value, index) => (
      `<div class="col-lg-3 col-md-6 col-sm-6"?course=${value.course_id}">
                          
        <a href="coursework.php?course=${value.course_id}&name=${value.title}&cn=${value.coin}" class="text-decoration-none">
          <div class="card rounded-0 border-0 shadow-sm mb-2">
            <img src="./admin/uploads/${value.image}" class="card-img-top " style="height:150px" alt="...">
            <div class="card-body">
              <div class="lh-sm">
                <h6 class=" fw-bold text-dark m-0">${value.title}</h6>
                <span class="small fw-bold text-muted"></span>
                <div class="text-end small">
                  <span class="small fw-bold"></span>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>`
    ));

    // Join the HTML strings and set the content of the #course element
    $('#course').html(result.slice(0, 4).join(''));
 let quiz = response.data.filter(q => q.challenge == "on") // Filter based on the original data
  .map((v, i) => (
    `
    <div class="col-lg-6 col-md-6 col-sm-12">
    <a href="quiz.php?course=${v.course_id}&name=${v.title}&cn=${v.coin}" class="text-decoration-none">
    <div class="card p-0 border-0 rounded-0 shadow-sm mb-3">
        <div class="d-flex justify-content-between align-items-center">
          <div class="float-start">
            <img src="./admin/uploads/${v.image}" alt="image" style="height:75px;width:75px">
          </div>
          <div class="lh-sm">
            <h6 class="fw-bold text-muted">
              ${v.title}
            </h6>
            <ul class="list-group list-group-horizontal border-0 mx-auto">
              <!-- ... (rest of your code) ... -->
            </ul>
          </div>
          <div class="reward">
            <div class="h-50 w-50">
              <img src="./assets/images/icons/coin.png" alt="coins" class="gam__coin img-fluid">
            </div>
            <span class="small px-2">
              ${v.coin} pts
            </span>
          </div>
        </div>
      </div>
    
    </a>
                         
     
    </div>
    <!--card-->
    `
  ));

              $('#quiz').html(quiz.slice(0, 4).join(''));
              
                // Handle the successful response here
               
            },
            error: function(xhr, status, error) {
                // Handle errors here
                console.error('Error:', status, error);
            }
        });
    })
    </script>
</body>
</html>