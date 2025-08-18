<?php
include "./layout/header.php";

?>

<!--modal box-->

<!-- Add this modal box with input field -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title msger" id="updateModalLabel">Update Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your form elements for updating the course here -->
                <form class="bg-light" enctype="multipart/form-data" id="updateForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Course Title</label>
                        <input type="text" class="form-control rounded-0" id="name" name="name"
                               aria-describedby="emailHelp" value="">
                        <div id="emailHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control rounded-0" id="description" rows="3"
                                  name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Choose Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" value="">
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
                        <input type="url" class="form-control" id="link" name="link"
                               placeholder="e.g https://you.tube/qw23w" value="">
                    </div>
                    <div class="col-12">
                        <div class="mb-2">
                            <label for="material" class="form-label">material</label>
                            <input type="file" class="form-control" id="material" name="material" value="">
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="challenge" name="challenge">
                        <label class="form-check-label" for="challenge">Set as Challenge</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="hidden" class="form-check-input" id="customid" name="customid" value="">

                    </div>
                    <button type="submit" class="btn btn-primary w-100 rounded-0 submitcourse">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!--end--->

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
                            <th scope="col">Course Title</th>
                            <th scope="col">Reward Coin</th>
                            <th scope="col">challenge</th>
                            <th scope="col" colspan="2" class="text-center">Action</th>
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
        $(document).ready(function () {

            $.ajax({
                url: 'api/course/list.php',
                type: 'GET',
                dataType: 'json',
                success: function (data) {

                    let resultdata = data.data
                    console.log(resultdata)
                    $.each(data.data, function (index, course) {
                        $('#courseTable tbody').append(`
                    <tr>
                        <th scope="row">${index + 1}</th>
                        <td>${course.title}</td>
                        <td>${course.coin}</td>
                        <td>${course.challenge}</td>
                        <td>
                        <button class="btn btn-primary btn-sm updateBtn" data-updcourse-id="${course.course_id}">update</button>

                        </td>
                        <td>
                        <button class="btn btn-danger btn-sm deleteBtn" data-course-id="${course.course_id}">Delete</button>

                        </td>
                    </tr>`);
                    });

                    //function update
                    // Handle update button click to open the modal
                    $('#courseTable tbody').on('click', '.updateBtn', function () {
                        $('#updateModal').modal('show');

                        // Get the course ID from the button's data attribute
                        let courseIdToUpdate = $(this).data('updcourse-id');

                        // Convert courseIdToUpdate to a string
                        courseIdToUpdate = courseIdToUpdate.toString();

                        // Filter the resultdata to get the specific course details
                        let updateresult = resultdata.find((value, index) => value.course_id === courseIdToUpdate);
                        $("#name").val(updateresult.title)
                        $("#description").val(updateresult.content)
                        $('#link').attr('placeholder', updateresult.link)
                        $('#material').attr('placeholder', updateresult.material)
                        $('#customid').val(updateresult.course_id)
                        // Fetch course details based on the courseId and populate the modal
                        // You can use updateresult to populate your modal fields
                    });

                    //end function


                    $('.deleteBtn').on('click', function () {

                        let courseId = $(this).data('course-id');
                        if (confirm('Are you sure about this?')) {
                            deleteCourse(courseId);
                        }

                    });
                },
                error: function (error) {
                    console.log('Error: ' + error.responseText);
                }
            });

            // Function to handle course deletion
            function deleteCourse(courseId) {

                $.ajax({
                    url: 'api/course/deletecourse.php',
                    type: 'POST',
                    data: {course_id: courseId},
                    success: function (response) {

                        console.log('Course deleted successfully');

                    },
                    error: function (error) {
                        console.log('Error: ' + error.responseText);
                    }
                });
            }


            //update form functionality


            // Handle form submission for updating the course
            $('#updateForm').on('submit', function (e) {
                e.preventDefault();
                //let id = $('#customid').val();
                //alert(id)
                // Perform the update operation using AJAX
                $.ajax({
                    url: 'api/course/updatecourse.php', // Adjust the URL for updating the course
                    type: 'POST',
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {

                        $('.msger').html('<span class="alert alert-success w-100 fw-bold small">Record updated successfully</span>')

                        // Close the modal after successful update
                        setTimeout(function () {
                            $('#updateModal').modal('hide');
                        }, 5000)

                    },
                    error: function (error) {
                        console.log('Error: ' + error.responseText);
                    }
                });
            });


            //end
        });

    </script>