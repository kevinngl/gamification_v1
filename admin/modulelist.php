<?php
include "./layout/header.php";

?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"> Module Listings</h1>
                        
                    </div>
                    <section class="py-5 bg-light shadow-sm">
                        <div class="container">
                            <div class="row">
                                <div class="col-10">
                                <table class="table" id="courseTable">
                                    <thead>
                                      <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Module Title</th>
                                        
                                      </tr>
                                    </thead>
                                    <tbody>
                                    
                                    
                                    </tbody>
                                  </table>

                                </div>
                            </div>
                        </div>
                    </section>
   <?php
      include "./layout/footer.php";
   ?>
   
<script>
$(document).ready(function(){
    
    $.ajax({
        url: 'api/module/list.php', 
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          console.log(data)
            
            $.each(data.data, function(index, course) {
                $('#courseTable tbody').append(`
                    <tr>
                        <th scope="row">${index+1}</th>
                        <td>${course.title}</td>
                     
                        <td>
                        <button class="btn btn-danger btn-sm deleteBtn" data-course-id="${course.module_id}">Delete</button>

                        </td>
                    </tr>`);
            });

            
            $('.deleteBtn').on('click', function() {
                
                var courseId = $(this).data('course-id');
                if(confirm('Are you sure about this?')){
                  deleteCourse(courseId);
                }
                
            });
        },
        error: function(error) {
            console.log('Error: ' + error.responseText);
        }
    });

    // Function to handle course deletion
    function deleteCourse(courseId) {
  
        $.ajax({
            url: 'api/module/deletemodule.php', 
            type: 'POST', 
             data: { module_id: courseId },
            success: function(response) {
             
                console.log('Course deleted successfully');

                setTimeout(function(){
                    window.location.href='modulelist.php'
                },3000)
               
                
            },
            error: function(error) {
                console.log('Error: ' + error.responseText);
            }
        });
    }
});

</script>