<?php
include "./function.php";
if (!isLoggedIn()) {
    header('location:login.php');
    exit();
}
include "./header.php";
?>
<section class="bg-body-tertiary">
    <div class="container-fluid">
        <div class="row">
            <!-- Course main content -->
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="border border-1 w-100" style="height:460px" id="poster-container">
                    <img src="" alt="image" class="gam__img-preview" id="img-content">
                </div>

                <div class="w-100">
                    <div class="text-start mb-3 ">
                        <ul class="nav nav-pills d-flex justify-content-start py-2 mb-3 border border-2 border-top-0 border-start-0 border-end-0"
                            id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active bg-light rounded-0 border-0 text-dark fw-bold"
                                        id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                                        type="button" role="tab">Module
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-muted bg-light fw-bold" id="pills-video-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-video" type="button" role="tab">
                                    Media
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-muted bg-light fw-bold" id="pills-material-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-material" type="button" role="tab">
                                    Ebook
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-muted bg-light fw-bold" id="pills-quiz-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-quiz" type="button" role="tab">Quiz
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content border-0 p-3 " id="pills-tabContent">
                            <!-- Module tab -->
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel">
                                <div class="ps-1 lh-sm text-start ps-2">
                                    <h5 class="fw-bold text-dark fs-3 mb-0" id="topic">Loading....</h5>
                                    <p class="text-start text-muted small py-3" id="content"
                                       style="max-height:520px;overflow:auto;"></p>

                                    <!-- Comment box -->
                                    <div class="py-2">
                                        <div id="HCB_comment_box">Comment Box is loading...</div>
                                        <link rel="stylesheet" type="text/css"
                                              href="https://www.htmlcommentbox.com/static/skins/bootstrap/twitter-bootstrap.css?v=0"/>
                                        <script type="text/javascript" id="hcb">
                                            if (!window.hcb_user) hcb_user = {};
                                            (function () {
                                                var s = document.createElement("script"),
                                                    l = hcb_user.PAGE || ("" + window.location).replace(/'/g, "%27"),
                                                    h = "https://www.htmlcommentbox.com";
                                                s.setAttribute("type", "text/javascript");
                                                s.setAttribute("src", h + "/jread?page=" + encodeURIComponent(l) + "&opts=16798&num=10");
                                                document.head.appendChild(s);
                                            })();
                                        </script>
                                        <input type="hidden" id="userd" name="userd"
                                               value="<?php echo $_SESSION['user_id'] ?? ""; ?>">
                                    </div>
                                </div>
                            </div>

                            <!-- Ebook tab -->
                            <div class="tab-pane fade" id="pills-material" role="tabpanel">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <h3 class="fw-bold">Download Ebook</h3>
                                            <a href="#" class="btn btn-primary rounded-pill btn-md small"
                                               id="materialcourse" download>Download Ebook</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Video tab -->
                            <div class="tab-pane fade" id="pills-video" role="tabpanel">
                                <div class="container py-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <iframe width="560" height="315" id="gam_video"
                                                    title="YouTube video player"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                    allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quiz tab -->
                            <div class="tab-pane fade" id="pills-quiz" role="tabpanel">
                                <div class="container text-center">
                                    <h3 class="fw-bold">Ready for quiz</h3>
                                    <span class="small">Test yourself on this course!</span>
                                    <p class="pt-4 fw-bold">10 questions, 15s each</p>
                                    <a href="#" class="btn btn-primary rounded-pill btn-md small"
                                       id="startquizcourse">Start Quiz</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Side accordion -->
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="accordion rounded-0 w-100" id="accordionExample"></div>
            </div>
        </div>
    </div>
</section>

</main>
<?php include "./footer.php"; ?>

<script>
    $(document).ready(function () {
        const usr = localStorage.getItem('user');
        const usr2 = $('#userd').val().trim();
        const realuser = usr || usr2;

        function getUrlParameters() {
            const urlParams = new URLSearchParams(window.location.search);
            return Object.fromEntries(urlParams.entries());
        }

        const {course: courseId, name: courseName, cn} = getUrlParameters();

        // Hide optional tabs by default
        $('#pills-video-tab, #pills-quiz-tab, #pills-material-tab').hide();

        // Fetch course + modules
        $.ajax({
            url: 'admin/api/module/moduleView.php',
            method: 'GET',
            dataType: 'json',
            data: {course: courseId},
            success: function (response) {
                if (response.status === 'success' && response.course_details) {
                    const courseData = response.course_details;
                    const modules = response.data || [];

                    $('#topic').html(courseData.course_name || '');
                    $('#content').html(courseData.course_description || '');

                    // Poster
                    if (courseData.poster) {
                        $('#img-content').attr('src', 'admin/uploads/' + courseData.poster);
                        $('#poster-container').show();
                    } else {
                        $('#poster-container').hide();
                    }

                    // Video
                    if (courseData.course_link) {
                        $('#gam_video').attr('src', courseData.course_link);
                        $('#pills-video-tab').show();
                    }

                    // Material
                    if (courseData.course_material) {
                        $('#materialcourse').attr('href', 'admin/Material/' + courseData.course_material);
                        $('#pills-material-tab').show();
                    }

                    // Quiz
                    $('#startquizcourse').attr('href',
                        'quiz.php?course=' + courseId + '&name=' + (courseName || '') + '&cn=' + (cn || ''));
                    $('#pills-quiz-tab').show();

                    // Build modules accordion
                    let modHtml = '';
                    if (modules.length > 0) {
                        modules.forEach((m, i) => {
                            modHtml += `
                          <div class="accordion-item rounded-0" data-module="${m.module_id}">
                            <h2 class="accordion-header">
                              <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapse${i}">
                                Module #${i + 1}: ${m.module_name || 'Untitled'}
                              </button>
                            </h2>
                            <div id="collapse${i}" class="accordion-collapse collapse"
                                 data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                                <h6 class="fw-bold">${m.module_name || ''}</h6>
                                <span class="small">${m.module_description || ''}</span>
                              </div>
                            </div>
                          </div>`;
                        });
                    } else {
                        modHtml = `<div class="alert alert-info text-center">No modules available.</div>`;
                    }
                    $('#accordionExample').html(modHtml);

                    // Bind click events
                    $('.accordion-button').on('click', function () {
                        const module_id = $(this).closest('.accordion-item').data('module');
                        const clickedModule = modules.find(mod => mod.module_id == module_id);
                        if (clickedModule) {
                            $('#topic').html(clickedModule.module_name || '');
                            $('#content').html(clickedModule.module_description || '');
                        }
                    });

                    $('#accordionExample').on('click', '.accordion-button', function () {
                        const $target = $($(this).data('bs-target'));
                        if ($target.hasClass('show')) {
                            $target.collapse('hide');
                        }
                    });
                    $('#pills-home-tab').on('click', function (e) {
                        location.reload();
                    });
                } else {
                    $('#topic').html(courseName || 'Course Title');
                    $('#content').html("<strong>No content uploaded yet.</strong>");
                }
            },
            error: function () {
                $('#topic').html(courseName || 'Course Title');
                $('#content').html("<strong>Error loading course details.</strong>");
            }
        });

        // Check quiz attempt
        $.ajax({
            url: 'admin/api/quiz/checkAttempt.php',
            method: 'GET',
            dataType: 'json',
            data: {user: realuser, course: courseId},
            success: function (res) {
                if (res.status === "done") {
                    $('#startquizcourse').replaceWith(
                        `<div class="alert alert-success fw-bold">
                ✅ Quiz already done<br>
                Score: ${res.score}<br>
                Result: ${res.result}<br>
                Coins earned: ${res.coin_earned}
             </div>`
                    );
                }
            },
            error: function () {
                console.error("Error checking quiz status");
            }
        });
    });
</script>
</body>
</html>
