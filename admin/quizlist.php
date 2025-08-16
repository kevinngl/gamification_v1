<?php
include "./layout/header.php";

?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"> Quiz Listings</h1>

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

        // Load quizzes
        $.ajax({
            url: 'api/quiz/quizview.php',
            type: 'GET',
            data: { course_id: 1 }, // change 1 to dynamic course id if needed
            dataType: 'json',
            success: function(data) {
                console.log(data);
                if (data.data && data.data.length > 0) {
                    $.each(data.data, function(index, course) {
                        $('#courseTable tbody').append(`
                        <tr>
                            <th scope="row">${index+1}</th>
                            <td>${course.question}</td>
                            <td>${course.option_a}</td>
                            <td>${course.option_b}</td>
                            <td>${course.option_c}</td>
                            <td>${course.option_d}</td>
                            <td>${course.answer}</td>
                            <td>
                                <button class="btn btn-danger btn-sm deleteBtn" data-quiz-id="${course.id}">Delete</button>
                            </td>
                        </tr>`);
                    });
                } else {
                    $('#courseTable tbody').append(`<tr><td colspan="8">No quizzes found</td></tr>`);
                }
            },
            error: function(error) {
                console.log('Error: ' + error.responseText);
            }
        });

        // Handle delete click (use event delegation for dynamically added buttons)
        $(document).on('click', '.deleteBtn', function(){
            var quizId = $(this).data('quiz-id');
            if(confirm('Are you sure you want to delete this quiz?')){
                deleteCourse(quizId, $(this));
            }
        });

        // Function to handle quiz deletion
        function deleteCourse(quizId, btn) {
            $.ajax({
                url: 'api/quiz/deletequiz.php',
                type: 'POST',
                dataType: 'json',
                data: { quiz_id: quizId },
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        alert(response.message);
                        // remove row
                        btn.closest('tr').remove();
                    } else {
                        alert("Delete failed: " + response.message);
                    }
                },
                error: function(error) {
                    console.log('Error: ' + error.responseText);
                }
            });
        }

    });
</script>