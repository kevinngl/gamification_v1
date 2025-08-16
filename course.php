<?php
include "./function.php";
include "./header.php";
if(!isLoggedIn())
{
    header('location:login.php');
    exit();
}
?>
          <!--nav fixed-->
          <header class="bg-warning-subtle py-5">
            <div class="container">
                <div class="row py-5">
                    <div class="col-12">
                        <div class="lh-sm text-center">
                            <h2 class="fw-bold display-1 text-muted text-opacity-25">
                                Courses
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
          </header>
          <!--header -->
          <section class="bg-light-subtle py-5">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="lh-sm">
                                <h4 class="fw-bold  text-opacity-50">
                                    Recommended for you
                                </h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="lh-sm">
                               <form>
                                    <input type="text" id="searchInput" class="form-control rounded-0" aria-describedby="passwordHelpBlock">
                                    <div id="passwordHelpBlock" class="form-text rounded-0 text-muted">
                                    Search courses on our platform
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
                         8+  Courses
                      </h3>
                  </div>
                  <!--card-->
                 <div class="row resultsList" id="course">

                 </div>
              
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
   <?php 
include "./footer.php";
   ?>
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
            const searchText = item.title.toLowerCase()
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
        filteredData.forEach(value => {
          $('.resultsList').append(`
            <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="coursework.php?course=${value.course_id}&name=${value.title}&cn=${value.coin}" class="text-decoration-none">
                
                <div class="card rounded-0 border-0 shadow-sm mb-2 overflow-hidden">
                  <img src="./admin/uploads/${value.image}" class="card-img-top" style="height:150px" alt="...">
                  <div class="card-body">
                    <div class="lh-sm">
                      <h6 class="fw-bold text-dark m-0 overflow-hidden" style="text-overflow:ellipsis;white-space:nowrap;">${value.title}</h6>
                      <span class="small fw-bold text-muted"></span>
                      <div class="text-end small text-muted overflow-hidden mt-1">
                        <span class="small fw-bold">${value.module}</span> modules
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>`
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
               url: 'admin/api/course/courseView.php', //  endpoint
               method: 'GET',
               dataType: 'json',
               success: function(response) {
   
                 let result = response.data.map((value,index)=>(
   
                   `<div class="col-lg-3 col-md-6 col-sm-6" ">
                         <a href="coursework.php?course=${value.course_id}&name=${value.title}&cn=${value.coin}" class="text-decoration-none">
                         <div class="card rounded-0 border-0 shadow-sm mb-2 overflow-hidden" >
                           <img src="./admin/uploads/${value.image}" class="card-img-top " style="height:150px" alt="...">
                           <div class="card-body ">
                               <div class="lh-sm ">
                                 <h6 class=" fw-bold text-dark m-0 overflow-hidden" style ="text-overflow:ellipsis;white-space:nowrap;">${value.title}</h6>
                                 <span class="small fw-bold text-muted">
                                 
                                 </span>
                                 <div class="text-end small text-muted overflow-hidden mt-1" >
                                 
                                   <span class="small fw-bold">${value.module}</span> modules</div>
                               </div>
                           </div>
                         </div>
                         </a>
                     </div>`
                 ))
                 for( let i =0 ; i < result.length; i++){
                   $('#course').html(result);
                 }
            
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