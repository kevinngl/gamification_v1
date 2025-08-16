<?php
    include "./layout/header.php";

?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Create Quiz</h1>
                        
                    </div>
                    <section class="py-5 ">
                        <div class="container">
                            <div class="row">

                            <div class="msg w-100 py-3">

                            </div>
                                <div class="col-lg-10 offset-1">
                                    
                                    <!--form-->
                                    <form class="row g-3" id="quizupload">
                                        <div class="bg-white shadow-sm w-100 mb-1 py-2">
                                            <div class="col-12">
                                                <label for="question" class="form-label">Question</label>
                                                <input type="text" class="form-control" id="question" name="question">
                                              </div>
                                              <div class="col-12">
                                                  <div class="mb-2">
                                                      <label for="inputState" class="form-label">Select Course</label>
                                                      <select  class="form-control" id="course" name ="course">
                                                        
                                                      </select>
                                                  </div>
                                                </div>
                                        </div>
                                        <hr class="border border-black border-2"/>
                                     <div class="bg-white shadow-sm w-100 py-4 mb-3">
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label for="optionA" class="form-label">Option A</label>
                                                <input type="text" class="form-control" id="optionA" name="optionA">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label for="optionB" class="form-label">Option B</label>
                                                <input type="text" class="form-control" id="optionB" name="optionB">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label for="optionC" class="form-label">Option C</label>
                                                <input type="text" class="form-control" id="optionC" name="optionC">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label for="optionD" class="form-label">Option D</label>
                                                <input type="text" class="form-control" id="optionD" name="optionD">
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="bg-white shadow-sm w-100 mb-2">
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label for="answer" class="form-label">Select Answer</label>
                                                <select id="answer" name="answer" class="form-control">
                                                  <option value="optionA">option A </option>
                                                  <option value="optionB">option B</option>
                                                  <option value="optionC">option C </option>
                                                  <option value="optionD">option D</option>
                                                </select>
                                            </div>
                                          </div>
                                         
                                    </div>
                                    <div class="shadow-sm w-100 py-2">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary w-100 rounded-0 submitquiz">submit</button>
                                        </div>
                                    </div>
                                      </form>
                                     </div>
                                    <!--form-->

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
                url: 'api/course/courseView.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                // Populate the select element with options
                var select = $('#course');
                $.each(response.data, function(index, value) {
                    select.append('<option value="' + value.course_id + '">' + value.title + '</option>');
                });
                },
                error: function() {
                console.error('Failed to fetch categories');
                }
            });


            //quiz
            $("#quizupload").on('submit', function(e){
         e.preventDefault();
        
         
          const question = $('#question').val();
          const course = $('#course').val();
          const optionA = $('#optionA').val();
          const optionB = $('#optionB').val();
          const optionC = $('#optionC').val();
          const optionD = $('#optionD').val();
          const answer = $('#answer').val();
              
          const formData = new FormData(this);
            formData.append('question', question);
            formData.append('course', course);
            formData.append('optionA', optionA);
            formData.append('optionB', optionB);
            formData.append('optionC', optionC);
            formData.append('optionD', optionD);
            formData.append('answer', answer);
         
         if(question ==="" || course ==="" || optionA ==="" || optionB ==="" || optionC ==="" || optionD ==="" || answer ==="" ){
            $('.msg').html('<span class="alert alert-danger alert-dismissible my-2"> Fields can not be empty</span>');
          return false
         }
         //ajax request to add quiz questions 

         $.ajax({
             type:'POST',
             url: 'api/quiz/createquiz.php',
             data: formData, 
            dataType:'json',
             contentType:false,
             cache: false,
             processData:false,
             beforeSend: function(){
                 $('.submitquiz').attr("disabled","disabled");
                 $('.submitquiz').html(" Please wait....");
                 $('#quizupload').css("opacity",".5");
             },
             success:function(response){ 
                 $('.msg').html('');
              
               if(response.message==="successful"){
                     $('#quizupload')[0].reset();
                     $('.msg').html("<p   class='alert alert-success'>MCQ added successfully!</p>");
                     $('.submitquiz').html("submit");
        
                 
                 }else{
                  $('#quizupload')[0].reset();
                     $('.msg').html("<p class='alert  alert-danger'>"+response.message+"</p>");
                     $('.submitquiz').html("Try Again");
                 }
                 
                 $('#quizupload').css("opacity","");
                 $(".submitquiz").removeAttr("disabled");

                
             }
         });
         //
     });

            //
    })
</script>