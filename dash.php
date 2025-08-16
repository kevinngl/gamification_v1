<?php
include "./function.php";
include "./header.php";
if(!isLoggedIn())
{
    header('location:login.php');
    exit();
}

?>
<style>
    .hover-element {
   
   
    transition: background-color 0.3s ease;
  }


  .hover-element:hover {
    background-color: rgba(4, 4, 233, 0.6) !important; /* Background color when hovered */
    color:white;
  }
</style>
<main class="bg-light py-2">
<section class=" py-4 bg-transparent">
  <div class="container-fluid">
      <div class="row  py-4">
        <div class="col-lg-6 col-md-6 col-sm-12 ">
            <div class="card rounded-0 border border-0 shadow-sm w-100 py-5 bg-primary-subtle"> 
              <div class="card-body mx-auto">
                  <div class="gam__profile-image text-center mx-auto d-flex justify-content-center align-items-center">
                                    <h3 class="fw-bold display-3">  <?php echo isset($_SESSION['username']) ? ucfirst($_SESSION['username'][0]) : ""; ?>
                   </h3>
                  </div>
                  <div class="lh-sm pt-2 text-center">
                    <h3 class="fw-bold">
                    <?php echo isset($_SESSION['username']) ? ucfirst($_SESSION['username']) : ""; ?>
                    </h3>
                  </div>
                 
                  <div class="badges d-flex justify-content-between my-1 gap-2">
                  <div class="ranks border border-0 border-right-1 text-center p-2">
                              <span class="fs-5 fw-bolder" id="user-rank"></span>
                              <span class="d-block small">Rank</span>
                      </div>
                      <div class="ranks border border-top-0 text-center border-black border-bottom-0 border-left-2 border-black border-right-2 py-2 px-3 lh-base text-center">
                              <span class="fs-5 fw-bolder" id="user-level">A</span>
                              <span class="d-block small">Level</span>
                      </div>
                      <div class="ranks border border-0 py-2 px-3 text-center">
                              <span class="fs-5 fw-bolder" id ="user-earning">43</span>
                              <span class="d-block small">Reward</span>
                      </div>
                      <div class="ranks border border-top-0 border-bottom-0 border-left-0 border-3 border-black   py-2 px-3 text-center">
                              <span class="fs-5 fw-bolder" id ="user-xps"></span>
                              <span class="d-block small">Exp points</span>
                      </div>
                      
                  </div>
                  <input type="hidden"id="usery"value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ""; ?>">
              </div>
            </div>
          
        
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12">
      <div class="card rounded-0 border-0 py-5 bg-transparent">
              <div class="card-body py-2">
                  <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                          <a href="./index.php" class="text-decoration-none">
                            <div class="w-100 lh-sm text-center p-5 shadow-sm mb-2 hover-element">
                            <i class="fa-solid fa-gauge-simple-high"></i>
                                <h6 class="small">Home</h6>
                            </div>
                          </a>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <a href="./course.php" class="text-decoration-none">
                        <div class="w-100 lh-sm text-center p-5 shadow-sm mb-2 hover-element">
                        <i class="fa-solid fa-book"></i>
                        <h6 class="small">Courses</h6>
                        </div>
                        </a>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
                      <a href="./challenge.php" class="text-decoration-none">
                          <div class="w-100 lh-sm text-center p-5 shadow-sm mb-2 hover-element">
                          <i class="fa-solid fa-gamepad"></i>
                             <h6 class="small">Trivia Games</h6>
                        </div>
                      </a>
                        
                      </div>
                      <div class="col-lg-4 col-sm-6 col-xs-12">
                        <a href="./logout.php" class="text-decoration-none">
                        <div class="w-100 lh-sm text-center p-5 shadow-sm mb-2 hover-element">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <h6 class="small">Sign Out</h6>
                          </div>
                        </a>
                      </div>
                      <div class="col-lg-4 col-sm-6 col-xs-12">
                      <a href="./leaderboard.php" class="text-decoration-none">
                        <div class="w-100 lh-sm text-center p-5 shadow-sm hover-element">
                          <i class="fa-solid fa-ranking-star"></i>
                          <h6 class="small">Leaderboard</h6>
                        </div>
                      </a>
                       
                      </div>
                      <div class="col-lg-4 col-sm-6 col-xs-12">
                        <a href="./feedback.php" class="text-decoration-none">
                            <div class="w-100 lh-sm text-center p-5 shadow-sm hover-element">
                              <i class="fa-solid fa-message"></i>
                              <h6 class="small">Feedback</h6>
                            </div>
                        </a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
         
      </div>
  </div>
</section>
<section class="py-4">
  <div class="container">
    <div class="row py-2" id="participate">
      <div class="lh-sm">
        <h3 class="fw-bold my-3">
         Qizzed  Courses you selected:
        </h3>
        <hr/>

      </div>
        
    </div>
  </div>
</section>
</main>

<?php

include "./footer.php";
?>
<script>
$(document).ready(function(){
  const usr = localStorage.getItem('user');

  const usr2 = $('#usery').val();


  const realuser = usr ?? usr2;
  
    $.ajax({
        url: 'admin/api/user/alluser.php', 
        method: 'GET',
        dataType: 'json',
        success: function (jsonData) {
            // Find the user with set variable
            var user = jsonData.data.find(function (user) {
                return user.user === realuser;
            });

            if (user) {
                // Sort the data based on earning and xps_coin
                jsonData.data.sort(function (a, b) {
                    // Compare by earning first
                    if (a.earning !== b.earning) {
                        return b.earning - a.earning; // Descending order by earning
                    } else {
                        return b.xps_coin - a.xps_coin; // If earning is the same, compare by xps_coin
                    }
                });

                // Assign ranks to each user
                $.each(jsonData.data, function (index, user) {
                    user.rank = index + 1; 
                    user.level = getUserLevel(user); // Assign user level
                });


               
                $('#user-rank').html(user.rank)  
                $('#user-xps').html(user.xps_coin) 
                $('#user-earning').html(user.earning) 
                $('#user-level').html(user.level) 
                fetchData(realuser)

     
            } else {
                console.log('User with ID 1 not found');
            }
        },
        error: function () {
            console.log('Error fetching data');
        }
    });

    function getUserLevel(user) {
        // Define level ranges
        var levelRanges = [
            { level: "Basic", earning: 0, xps_coin: 0 },
            { level: "Pro", earning: 200, xps_coin: 1000 },
            { level: "Master", earning: 500, xps_coin: 2000 }
        ];

        // Function to determine user level
        for (let i = levelRanges.length - 1; i >= 0; i--) {
        if (user.earning >= levelRanges[i].earning && user.xps_coin >= levelRanges[i].xps_coin) {
            return levelRanges[i].level;
        }
    }
        return "Unknown"; // Default level if not found in any range
    }



    function fetchData(user_data) {
            $.ajax({
                url: 'admin/api/user/record.php', // path to view resource
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    // Handle the data returned from the server
                   let result = data.data.filter((value,index)=>{
                    return value.user ===user_data
                   }).map((v,i)=>(
                    `<div class="col-lg-3 col-md-6 col-sm-6" ">
                         <a href="coursework.php?course=${v.course_id}&name=${v.title}&cn=${v.coin}" class="text-decoration-none">
                         <div class="card rounded-0 border-0 shadow-sm mb-2 overflow-hidden" >
                           <img src="./admin/uploads/${v.image}" class="card-img-top " style="height:150px" alt="...">
                           <div class="card-body ">
                               <div class="lh-sm ">
                                 <h6 class=" fw-bold text-dark m-0 overflow-hidden" style ="text-overflow:ellipsis;white-space:nowrap;">${v.title}</h6>
                                 <span class="small fw-bold text-muted">
                                 
                                 </span>
                                 <div class="text-end small text-muted overflow-hidden mt-1" >
                                  <div class="reward-score">
                                  <span class="small fw-bold">score : ${v.score}</span>
                                  </div>
  
                                   </div>
                                   <span class="small fw-bold"><i></i>you were awarded a <strong>${v.win}</strong> in this course</i></span>
                                  
                                   
                               </div>
                           </div>
                         </div>
                         </a>
                     </div>`
                   ))
                   $('#participate').append(result.slice(0, 4).join(''));
                   
                },
                error: function (error) {
                    // Handle errors, e.g., display an error message
                    console.error('Error fetching data:', error);
                }
            });
        }

})
  
</script>

  </body>
   </html>