<?php 
include "./function.php";
include "./header.php";
if(!isLoggedIn())
{
    header('location:login.php');
    exit();
}

?>
      <header class="bg-primary-subtle py-5">
        <div class="container">
            <div class="row py-5">
                <div class="col-12">
                    <div class="lh-sm text-center">
                        <h2 class="fw-bold display-1 text-muted text-opacity-25">
                          Knowledge Test
                        </h2>
                    </div>
                </div>
            </div>
        </div>
      </header>
      <!--header -->
      <section class="py-3">
        <div class="container">
        <div class="row align-items-center">
                        <div class="col-6">
                            <div class="lh-sm">
                                <h4 class="fw-bold  text-opacity-50">
                                     Earn points
                                </h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="lh-sm">
                               <form>
                                    <input type="text" id="searchInput" class="form-control rounded-0" aria-describedby="passwordHelpBlock">
                                    <div id="searchInput" class="form-text rounded-0 text-muted">
                                    Search for quiz 
                                    </div>
                               </form>
                            </div>
                        </div>
                    </div>
        </div>
      </section>
      <section class="bg-body-tertiary ">
        <div class="container">
            <div class="row align-items-center position-relative">
              <div class="mt-5  mb-0 mb-0 text-center">
                  <h3 class="fw-bolder text-dark opacity-25 display-2">
                     8+  Quiz
                  </h3>
                  <span class="text-muted">
                    Get quizzed from 8+ courses
                  </span>
              </div>
              <!--card-->
             <!--challenge-->
                <div class="row my-3 resultsList" id="quiz">
  
                  </div>

             <!--challenge-->
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
    </main>
<?php include "./footer.php"; ?>

<script>
    $(document).ready(function(){


      search()

function search() {
  // Event listener for input changes
  $('#searchInput').on('input', function() {
    // Get the search input value
    const searchTerm = $(this).val().toLowerCase();

    // Fetch data from the endpoint
    $.ajax({
      url: 'admin/api/course/courseView.php',
      method: 'GET',
      dataType: 'json',
      success: function(response) {
        // Filter data based on the search term
        
        const filteredData = response.data.filter(item => {
            const searchText = item.challenge === "on" && item.title.toLowerCase()
          // Check if item.name is defined before trying to split
          if (searchText) {
            // Split item data using whitespace as delimiter
            const itemWords = searchText.split(/\s+/);
            return itemWords.some(word => word.includes(searchTerm));
          } else {
            return false; // Skip items without a name property
          }
        });

        // Clear previous results
        $('.resultsList').empty();

        // Append filtered results to the DOM
        filteredData.forEach(v => {
          $('.resultsList').append( `
                <div class="col-lg-6 col-md-6 col-sm-12">
                  <a href="coursework.php?course=${v.course_id}&name=${v.title}&cn=${v.coin}" class="text-decoration-none">
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
          );
        });
      },
      error: function(error) {
        console.error('Error fetching data:', error);
      }
    });
  });
}



          // jQuery AJAX request
          $.ajax({
            url: 'admin/api/course/courseView.php', // Replace with your API endpoint
            method: 'GET',
            dataType: 'json',
            success: function(response) {

             
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

              
            
                $('#quiz').html(quiz);
              
              
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