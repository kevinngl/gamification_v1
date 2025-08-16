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
<script>
    $(document).ready(function(){

        $("#courseupload").on('submit', function(e){
            e.preventDefault();

            const name = $('#name').val().trim();
            const description = $('#description').val().trim();
            const url = $('#link').val().trim();
            const maxSize = 8 * 1024 * 1024; // 8 MB
            const allowedImageTypes = ["image/jpeg","image/jpg","image/png","image/webp"];

            // reset message
            $('.msg').html('');

            // Validation
            if(name === "" || description === ""){
                $('.msg').html('<div class="alert alert-danger my-2">Fields cannot be empty</div>');
                return false;
            }

            // URL validation (optional field, only check if provided)
            if(url !== ""){
                const urlPattern = /^(https?:\/\/)[\w\-]+(\.[\w\-]+)+[/#?]?.*$/;
                if(!urlPattern.test(url)){
                    $('.msg').html('<div class="alert alert-danger my-2">Please enter a valid URL.</div>');
                    return false;
                }
            }

            let imageFile = $('#image')[0].files[0];
            let materialFile = $('#material')[0].files[0];

            // Check image
            if (imageFile) {
                if (imageFile.size > maxSize) {
                    $('.msg').html('<div class="alert alert-danger my-2">Image file is too large! Max size is 8 MB.</div>');
                    return false;
                }
                if (!allowedImageTypes.includes(imageFile.type)) {
                    $('.msg').html('<div class="alert alert-danger my-2">Only JPG, JPEG, PNG, and WEBP images are allowed.</div>');
                    return false;
                }
            }

            // Check material
            const allowedMaterialExtensions = ["pdf","docx","doc","txt","zip","rar","md","ppt","pptx","odp"];
            if (materialFile) {
                let ext = materialFile.name.split('.').pop().toLowerCase();
                if (!allowedMaterialExtensions.includes(ext)) {
                    $('.msg').html('<div class="alert alert-danger my-2">Invalid material file type. Allowed: PDF, DOC, DOCX, TXT, ZIP, RAR, MD, PPT, PPTX, ODP.</div>');
                    return false;
                }
                if (materialFile.size > maxSize) {
                    $('.msg').html('<div class="alert alert-danger my-2">Material file is too large! Max size is 8 MB.</div>');
                    return false;
                }
            }

            // AJAX submit
            $.ajax({
                type:'POST',
                url: 'api/course/createcourse.php',
                data: new FormData(this),
                dataType:'json',
                contentType:false,
                cache: false,
                processData:false,
                beforeSend: function(){
                    $('.submitcourse').attr("disabled","disabled").html(" Please wait...");
                    $('#courseupload').css("opacity",".5");
                },
                success:function(response){
                    $('.msg').html('');

                    if(response.status === 200){
                        $('#courseupload')[0].reset();
                        $('.msg').html("<div class='alert alert-success'>"+ "Course Created" +"</div>");
                    }else{
                        $('.msg').html("<div class='alert alert-danger'>"+response.message+"</div>");
                    }

                    $('.submitcourse').html("Submit").removeAttr("disabled");
                    $('#courseupload').css("opacity","");
                },
                error: function(xhr, status, error){
                    $('.msg').html("<div class='alert alert-danger'>Server error: "+error+"</div>");
                    $('.submitcourse').html("Submit").removeAttr("disabled");
                    $('#courseupload').css("opacity","");
                }
            });
        });

        // Image preview
        $('#image').on('change', function(){
            if(this.files[0]){
                let reader = new FileReader();
                reader.onload = function(e){
                    $('.msg').html('<img src="'+e.target.result+'" class="img-thumbnail my-2" width="150"/>');
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        // Show selected material file name
        $('#material').on('change', function(){
            if(this.files[0]){
                $('.msg').append('<p class="text-info">Selected material: '+this.files[0].name+'</p>');
            }
        });

    });
</script>
