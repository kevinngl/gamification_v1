<?php
include "./layout/header.php";

?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Create Module</h1>
                        
                    </div>
                    <section class="py-5 bg-light shadow-sm">
                        <div class="container">
                            <div class="row">
                              <div class="msg w-100 py-3">

    
                              </div>
                                <div class="col-10">
                                    
                                    <!--form-->
                                    <form class="row g-3" id="moduleupload" >
                                        <div class="col-12">
                                          <label for="inputEmail4" class="form-label">Module Title</label>
                                          <input type="text" class="form-control" id="title" name ="title">
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label for="inputState" class="form-label" onload="courselist()">Select Course</label>
                                                <select id="course" class="form-control" name = "course">
                                                  
                                                </select>
                                            </div>
                                          
                                          </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">Module Content</label>
                                                <textarea class="form-control" id="content" name="content"rows="5"></textarea>
                                            </div>
                                        </div>
                                      
                                        
                                        <div class="col-12">
                                          <button type="submit" class="btn btn-primary w-100 rounded-0 submitmodule">submit</button>
                                        </div>
                                      </form>
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
    
    
    $("#moduleupload").on('submit', function(e){
         e.preventDefault();
        
          const title = $('#title').val();
          const content = $('#content').val();
          const course = $('#course').val();
         if(title ==="" || course ===""){
            $('.msg').html('<span class="alert alert-danger alert-dismissible my-2"> Fields can not be empty</span>');
          return false
         }
         //ajax

         $.ajax({
             type:'POST',
             url: 'api/module/createmodule.php',
             data: new FormData(this), 
            dataType:'json',
             contentType:false,
             cache: false,
             processData:false,
             beforeSend: function(){
                 $('.submitmodule').attr("disabled","disabled");
                 $('.submitmodule').html(" Please wait....");
                 $('#moduleupload').css("opacity",".5");
             },
             success:function(response){
                 $('.msg').html('');

                 if(response.status === "success" || response.message === "successful"){
                     $('#moduleupload')[0].reset();
                     $('.msg').html("<p class='alert alert-success'>Module created successfully!</p>");
                     $('.submitmodule').html("submit");
                 } else {
                     $('.msg').html("<p class='alert alert-danger'>"+response.message+"</p>");
                     $('.submitmodule').html("Try Again");
                 }

                 $('#moduleupload').css("opacity","");
                 $(".submitmodule").removeAttr("disabled");
             }
         });
         //
     });
    
  });
</script>