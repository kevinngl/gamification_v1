<?php
include "./layout/header.php";

?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"> Course Listings</h1>
                        
                    </div>
                    <section class="py-5 bg-light shadow-sm">
                        <div class="container">
                            <div class="row">
                                <div class="col-10">
                                <table class="table" id="courseTable">
                                    <thead>
                                      <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" >Question</th>
                                        <th scope="col" colspan="4" class="text-center">Choices</th>
                                        
                                        <th scope="col">Answer</th>
                                        <th scope="col">Action</th>
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
        url: 'api/quiz/quizview.php', 
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          console.log(data)
            
            $.each(data.data, function(index, course) {
                $('#courseTable tbody').append(`
                    <tr>
                        <th scope="row">${index+1}</th>
                        <td>${course.question}</td>
                        <td>${course.optionA}</td>
                        <td>${course.optionB}</td>
                        <td>${course.optionC}</td>
                        <td>${course.optionD}</td>
                        <td>${course.answer}</td>
                        <td>
                        <button class="btn btn-danger btn-sm deleteBtn" data-course-id="${course.quiz_id}">Delete</button>

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
   alert(courseId)
        $.ajax({
            url: 'api/quiz/deletequiz.php', 
            type: 'POST', 
             data: { quiz_id: courseId },
            success: function(response) {
             
                console.log('Course deleted successfully');
                
            },
            error: function(error) {
                console.log('Error: ' + error.responseText);
            }
        });
    }
});

</script>