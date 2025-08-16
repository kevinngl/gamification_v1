<?php
include "./layout/header.php";
?>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Create Course</h1>
                        
                    </div>
                    <section class="py-5 bg-light shadow-sm">
                        <div class="container">
                            <div class="row">
                            <div class="msg w-100 my-3">
                              </div>
                                <div class="col-10 .offset-1">
                                 
                                    <form class="bg-light" enctype="multipart/form-data" id="courseupload">
                                        <div class="mb-3">
                                          <label for="name" class="form-label">Course Title</label>
                                          <input type="text" class="form-control rounded-0" id="name" name="name" aria-describedby="emailHelp">
                                          <div id="emailHelp" class="form-text"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control rounded-0" id="description" rows="3" name="description"></textarea>
                                          </div>
                                        <div class="mb-3">
                                          <label for="image" class="form-label">Choose Image</label>
                                          <input type="file"  class="form-control" id="image" name="image" accept="image/*">
                                        </div>
                                        
                                            <div class="mb-2">
                                                <label for="coin" class="form-label">Reward Coin</label>
                                                <select id="coin" name="coin" class="form-control">

                                                  <option value="20">20pt</option>
                                                  <option value="25">25pt</option>
                                                  <option value="40">40pt</option>
                                                  <option value="80">80pt</option>
                                                  <option value="100">100pt</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                          <label for="inputAddress2" class="form-label">link</label>
                                          <input type="url" class="form-control" id="link" name="link"placeholder="e.g https://you.tube/qw23w">
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label for="material" class="form-label">material</label>
                                                <input type="file" class="form-control" id="material" name="material">
                                            </div>
                                        </div>
                                            <div class="mb-3 form-check">
                                                <input type="checkbox" class="form-check-input" id="challenge" name="challenge">
                                                <label class="form-check-label" for="challenge">Set as Challenge</label>
                                              </div>
                                        <button type="submit" class="btn btn-primary w-100 rounded-0 submitcourse">Submit</button>
                                      </form>

                                </div>
                            </div>
                        </div>
                    </section>
  <?php 
  
  include "./layout/footer.php";
  ?>

  <script >
    $(document).ready(function(){
    
      $("#courseupload").on('submit', function(e){
           e.preventDefault();
          
            const name = $('#name').val();
            const description = $('#description').val();
           if(name ==="" || description ===""){
              $('.msg').html('<span class="alert alert-danger alert-dismissible my-2"> Fields can not be empty</span>');
            return false
           }
           //ajax

           $.ajax({
               type:'POST',
               url: 'api/course/createcourse.php',
               data: new FormData(this), 
              dataType:'json',
               contentType:false,
               cache: false,
               processData:false,
               beforeSend: function(){
                   $('.submitcourse').attr("disabled","disabled");
                   $('.submitcourse').html(" Please wait....");
                   $('#courseupload').css("opacity",".5");
               },
               success:function(response){ 
                   $('.msg').html('');
                
                 if(response.message==="successful"){
                       $('#courseupload')[0].reset();
                       $('.msg').html("<p   class='alert alert-success'>Course created successfully!</p>");
                       $('.submitcourse').html("submit");
					
                   
                   }else{
                    $('#courseupload')[0].reset();
                       $('.msg').html("<p class='alert  alert-danger'>"+response.message+"</p>");
                       $('.submitcourse').html("Try Again");
                   }
                   
                   $('#courseupload').css("opacity","");
                   $(".submitcourse").removeAttr("disabled");

                  
               }
           });
           //
       });
      
    });
  </script>