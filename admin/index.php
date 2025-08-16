<?php include "./layout/header.php"?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        
                    </div>

                    <?php

$host = "db";
$username = "user";
$password = "password";
$database = "gamification";

try {
    $dsn = "mysql:host={$host};dbname={$database}";
    $connection = new PDO($dsn, $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$stmt = "SELECT COUNT(user_id) AS userCount FROM users";
$users = $connection->query($stmt);
$user = $users->fetch();
$stmta = "SELECT COUNT(course_id) AS courseCount FROM course";
$courses = $connection->query($stmta);
$course = $courses->fetch();
$stmtq = "SELECT COUNT(DISTINCT course_id) AS quizCount FROM quiz";
$quizes = $connection->query($stmtq);
$quiz = $quizes->fetch();

?>




                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Users </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $user['userCount'];?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                courses </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                echo $course['courseCount'];
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Quiz
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $quiz['quizCount'];?></div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                    <section class="py-2">
                        <div class="container">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Courses Uploaded</h1>
                            </div>
                            <div class="row" id="course">
                                
                            </div>
                        </div>
                    </section>
                    <section class="py-2">
                        <div class="container">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Quiz Uploaded</h1>
                            </div>
                            <div class="row" id="quiz">
                                
                            </div>
                        </div>
                    </section>
                   
   <?php include "./layout/footer.php" ?>
   <script>
    $(document).ready(function(){
          // jQuery AJAX request
          $.ajax({
            url: 'api/course/courseView.php', // Replace with your API endpoint
            method: 'GET',
            dataType: 'json',
            success: function(response) {
              let result = response.data.map((value, index) => (
      `<div class="col-lg-3 col-md-6 col-sm-6"?course=${value.course_id}">
                          
        <a href="../coursework.php?course=${value.course_id}&name=${value.title}&cn=${value.coin}" class="text-decoration-none">
          <div class="card rounded-0 border-0 shadow-sm mb-2">
            <img src="../admin/uploads/${value.image}" class="card-img-top " style="height:150px" alt="...">
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
    <a href="../quiz.php?course=${v.course_id}&name=${v.title}&cn=${v.coin}" class="text-decoration-none">
    <div class="card p-0 border-0 rounded-0 shadow-sm mb-3">
        <div class="d-flex justify-content-between align-items-center">
          <div class="float-start">
            <img src="../admin/uploads/${v.image}" alt="image" style="height:75px;width:75px">
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
            <div class="h-50 w-50" style="height:10px;width:10px;overflow:hidden">
                         </div>
            <span class="small px-2">
              ${v.coin} Coin
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