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
          <header class="bg-info-subtle py-5">
            <div class="container">
                <div class="row py-5">
                    <div class="col-12">
                        <div class="lh-sm text-center">
                            <h2 class="fw-bold display-1 text-muted text-opacity-25">
                               Feedback
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
          </header>
          <section class="py-4">
            <div class="container">
                    <div class="row py-5">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="lh-sm">
                                <h3 class="fw-bold" id="response">
                                    We'd like to hear from you!
                                </h3>
                            </div>
                            <form id="submitForm">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control border border-2" id="email" name="email" placeholder="name@example.com" value="">
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control border border-2" id="subject" name="subject" placeholder="e.g issue with the questions" value="">
                            </div>
                                <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control border border-2" id="message" name="message" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <button class="w-100 rounded-0 btn btn-md btn-dark">submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
          </section>
          <main/>



      <?php include "./footer.php";
   ?>
   <script>
$(document).ready(function () {
    $("#submitForm").on('submit', function (event) {
        // Prevent the default form submission
        event.preventDefault();

        // Submit form data using AJAX
        $.ajax({
            type: "POST",
            url: "mail.php",
            data: new FormData(this),
            contentType: false,
            processData: false, // Important to prevent jQuery from automatically transforming the data into a query string
            success: function (data) {
                $("#response").html(data);
            },
            error: function () {
                $("#response").html("Error submitting the form.");
            }
        });
    });
});
</script>
