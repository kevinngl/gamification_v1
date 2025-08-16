<?php
include "./function.php";

include "./header.php";
if(!isLoggedIn())
{
    header('location:login.php');
    exit();
}
?>
      <section class="bg-body-tertiary">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="border border-1 w-100" style="height:460px" id="poster-container">
                      <img src="" alt="image" class="gam__img-preview" id="img-content">
                    </div>
                    <div class="w-100">
                        <div class="text-start mb-3 ">
                            <ul class="nav nav-pills d-flex justify-content-start py-2 mb-3 border border-top-0 border-bottom-1 border-start-0 border-end-0 border-2" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active bg-light rounded-0 border border-0 text-dark fw-bold" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Module</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link text-muted bg-light fw-bold" id="pills-review-tab" data-bs-toggle="pill" data-bs-target="#pills-video" type="button" role="tab" aria-controls="pills-video" aria-selected="false">Media</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link text-muted bg-light fw-bold" id="pills-material-tab" data-bs-toggle="pill" data-bs-target="#pills-material" type="button" role="tab" aria-controls="pills-review" aria-selected="false">Ebook</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link text-muted bg-light fw-bold" id="pills-quiz-tab" data-bs-toggle="pill" data-bs-target="#pills-quiz" type="button" role="tab" aria-controls="pills-quiz" aria-selected="false">Quiz</button>
                                </li>
                               
                            </ul>   
                            <div class="tab-content border border-0 p-3 " id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                                   <div class="ps-1 lh-sm text-start ps-2">
                                        <h5 class="fw-bold text-dark fs-3 mb-0" id="topic">
                                           Loading....
                                        </h5>
                                        <span class="fw-bold small text-muted " >
                                           
                                              
                                          </i>
                                        </span>
                                        <p class="text-start text-muted small py-3" id="content" style="max-height:520px;overflow:auto;">
                                           
                                        </p>
                                        <div class="py-2">
                                            

                                            <!-- begin wwww.htmlcommentbox.com -->
                                                  <div id="HCB_comment_box"><a href="http://www.htmlcommentbox.com">Comment Box</a> is loading comments...</div>
                                                  <link rel="stylesheet" type="text/css" href="https://www.htmlcommentbox.com/static/skins/bootstrap/twitter-bootstrap.css?v=0" />
                                                  <script type="text/javascript" id="hcb"> /*<!--*/ if(!window.hcb_user){hcb_user={};} (function(){var s=document.createElement("script"), l=hcb_user.PAGE || (""+window.location).replace(/'/g,"%27"), h="https://www.htmlcommentbox.com";s.setAttribute("type","text/javascript");s.setAttribute("src", h+"/jread?page="+encodeURIComponent(l).replace("+","%2B")+"&mod=%241%24wq1rdBcg%24qBgB9LEcTF7ydj99DZ2ba."+"&opts=16798&num=10&ts=1702122567407");if (typeof s!="undefined") document.getElementsByTagName("head")[0].appendChild(s);})();  </script>
                                                  <!-- end www.htmlcommentbox.com -->

                                                  <input type="hidden" id="userd" name="userd" value=" <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ""; ?>
">
                                          
                                        </div>
                                       
                                   </div>
                                   
                                </div>
                                <div class="tab-pane fade" id="pills-material" role="tabpanel" aria-labelledby="pills-material-tab" tabindex="0">
                                <div class="container">
                                      <div class="row">
                                          <div class="col-12">
                                              <div class="lh-sm text-center">
                                                  <h3 class="fw-bold"> Download Ebook for this course</h3>
                                                  <span class="small"> </span>
                                               
                                                  <a href="#" class="btn btn-primary rounded-pill  btn-md small" id="materialcourse" download>Download Ebook</a>
                                                </div>
                                          </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-video" role="tabpanel" aria-labelledby="pills-video-tab" tabindex="0">
                                  <div class="container">
                                    <div class="row py-4">
                                      <div class="col-12">
                                      <iframe width="560" height="315"  id="gam_video" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                   
                                <div class="tab-pane fade" id="pills-quiz" role="tabpanel" aria-labelledby="pills-quiz-tab" tabindex="0">
                                    <div class="container">
                                      <div class="row">
                                          <div class="col-12">
                                              <div class="lh-sm text-center">
                                                  <h3 class="fw-bold"> Ready for quiz</h3>
                                                  <span class="small"> Test yourself on the skills in this course and earn mastery points for what you already know!</span>
                                                  <p class="pt-4 fw-bold">10 questions in 15secs each</p>
                                                  <a href="#" class="btn btn-primary rounded-pill  btn-md small" id="startquizcourse">Start Quiz</a>
                                                </div>
                                          </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                
                  
                    <div class="accordion rounded-0 w-100" id="accordionExample">
                        
                        
                       
                      </div>
                       
                    

                </div>
            </div>
        </div>
      </section>



      <!--course-content-->
    </main>
<?php 

include "./footer.php";

?> 
<script>
$(document).ready(function () {
 
  const usr = localStorage.getItem('user');

  const usr2 = $('#userd').val();
  const realuser = usr ?? usr2;

  function updateUserExperiencePoints(user, xps) {
    const endpointUrl = 'admin/api/user/xps.php';

    const requestData = {
      user: user,
      xps: xps
    };

    $.post(endpointUrl, requestData, function (response) {
      // Handle the response from the backend
     
    });
  }


  function getUrlParameters() {
    const urlParams = new URLSearchParams(window.location.search);
    const params = {};

    for (const [key, value] of urlParams.entries()) {
      params[key] = value;
    }

    return params;
  }

  const parameters = getUrlParameters();

  const courseId = parameters.course;
  const courseName = parameters.name;
  const cn = parameters.cn;

  function getYouTubeVideoId(url) {
            var urlParams = new URLSearchParams(new URL(url).search);
            return urlParams.get("v");
        }

        // Call the function and log the result
      
  //hide elements

  $('#pills-video-tab').hide();
  $('#pills-quiz-tab').hide();
  $('#pills-material-tab').hide();

  $.ajax({
    url: 'admin/api/module/moduleView.php', 
    method: 'GET',
    dataType: 'json',
    data: { course: courseId }, // Pastikan courseId sudah didefinisikan sebelumnya (misal dari URL parameter)
    success: function (response) {
        // Log respons untuk debugging
        console.log("API Response:", response);

        // Periksa status dan apakah ada detail kursus
        if (response.status === 'success' && response.course_details) {
            const courseData = response.course_details; // Detail kursus utama ada di course_details
            console.log("courseData",courseData);
            const modules = response.data; // Daftar modul ada di data[]

            // Tampilkan detail kursus utama (deskripsi, poster, link, material)
            $('#pills-video-tab').show();
            $('#pills-material-tab').show();
            $('#pills-quiz-tab').show();

            $('#topic').html(courseData.course_name || ''); // Judul kursus
            $('#content').html(courseData.course_description || ''); // Deskripsi kursus

            // Tampilkan poster
            if (courseData.poster) {
                $('#img-content').attr('src', 'admin/uploads/' + courseData.poster); // Tambahkan 'images/' jika itu subfolder di uploads
                $('#poster-container').show(); // Pastikan container poster ditampilkan
            } else {
                $('#poster-container').hide();
            }

            // Tampilkan link video
            if (courseData.course_link) {
                $('#gam_video').attr('src', courseData.course_link); // Mengambil dari courseData.course_link
                $('#pills-video-tab').show(); // Pastikan tab video ditampilkan
            } else {
                $('#pills-video-tab').hide();
            }

            // Tampilkan material PDF
            if (courseData.course_material) {
                $('#materialcourse').attr('href', 'admin/Material/' + courseData.course_material); // Mengambil dari courseData.course_material
                $('#pills-material-tab').show(); // Pastikan tab material ditampilkan
            } else {
                $('#pills-material-tab').hide();
            }

            // Link ke Quiz
            // Pastikan courseName dan cn sudah didefinisikan di atas kode AJAX ini
            $('#startquizcourse').attr('href', 'quiz.php?course=' + courseId + '&name=' + (courseName || '') + '&cn=' + (cn || ''));
            
            // ============== Bagian untuk menampilkan daftar modul ==============
            let modHtml = '';
            if (modules.length > 0) {
                modules.forEach((value, index) => {
                    modHtml += `
                        <div class="accordion-item rounded-0" data-module="${value.module_id}">
                            <h2 class="accordion-header rounded-0">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${index}" aria-expanded="true" aria-controls="collapse${index}">
                                    Module # ${index + 1}: ${value.module_name || 'No Title'} </button>
                            </h2>
                            <div id="collapse${index}" class="accordion-collapse collapse show" data-bs-parent="#accordionExample" style="max-height: 40px; overflow:hidden; white-space:nowrap; text-overflow:ellipsis">
                                <div class="accordion-body overflow-hidden" style="text-overflow:ellipsis;white-space:nowrap">
                                    <h6 class="fw-bold text-start">${value.module_name || ''}</h6> <span class="small">${value.module_description || ''}</span> </div>
                            </div>
                        </div>
                    `;
                });
            } else {
                modHtml = `
                    <div class="alert alert-info text-center" role="alert">
                        No modules available for this course yet.
                    </div>
                `;
            }
            $('#accordionExample').html(modHtml);

            // Re-bind click event for accordion buttons
            $('.accordion-button').off('click').on('click', function () {
                const module_id = $(this).closest('.accordion-item').data('module');
                
                // Cari modul yang diklik dari array 'modules'
                const clickedModule = modules.find(mod => mod.module_id == module_id); // Gunakan find untuk satu objek, dan == untuk perbandingan string/number
            
                if (clickedModule) {
                    $('#topic').html(clickedModule.module_name || ''); // Gunakan module_name
                    $('#content').html(clickedModule.module_description || ''); // Gunakan module_description
                }

                // Bagian experience points
                const startTime = new Date().getTime();
                let experiencePoints = 0;
                // Clear any existing interval to prevent multiple timers running
                if (window.moduleTimerInterval) clearInterval(window.moduleTimerInterval);
                window.moduleTimerInterval = setInterval(function () {
                    const currentTime = new Date().getTime();
                    const elapsedTime = (currentTime - startTime) / 1000; 

                    experiencePoints = Math.floor(elapsedTime / 10) * 1; 
                    console.log(experiencePoints);
                    // Pastikan updateUserExperiencePoints dan realuser terdefinisi
                    // if (typeof updateUserExperiencePoints !== 'undefined' && typeof realuser !== 'undefined') {
                    //     updateUserExperiencePoints(realuser, experiencePoints);
                    // }
                    // $('#experienceContainer').html(`Experience Points: ${experiencePoints}`); // Pastikan #experienceContainer ada
                }, 5000); 
            });

        } else {
            // Jika API status bukan success atau tidak ada course_details (misal {"data":[]})
            $('#topic').html(courseName || 'Course Title');
            $('#content').html("<strong>The author is yet to upload contents for this course.</strong>");
            $('#poster-container').hide();
            $('#pills-video-tab').hide();
            $('#pills-material-tab').hide();
            $('#pills-quiz-tab').hide();
            $('#accordionExample').html(`<div class="alert alert-info text-center" role="alert">${response.message || 'No modules found or error from API.'}</div>`);
        }
    },
    error: function (xhr, status, error) {
        console.error('Error fetching modules:', status, error, xhr.responseText);
        $('#topic').html(courseName || 'Course Title');
        $('#content').html("<strong>Failed to load course details. There was an error communicating with the server. Please try again later.</strong>");
        $('#poster-container').hide();
        $('#pills-video-tab').hide();
        $('#pills-material-tab').hide();
        $('#pills-quiz-tab').hide();
        $('#accordionExample').html(`<div class="alert alert-danger text-center" role="alert">Error loading modules.</div>`);
    }
});

});

</script>

   </body>
   </html>