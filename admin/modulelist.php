<?php
include "./layout/header.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Module Listings</h1>
    </div>

    <section class="py-5 bg-light shadow-sm">
        <div class="container">

            <!-- Search Filter Row -->
            <div class="row mb-3">
                <div class="col-4">
                    <input type="text" id="moduleSearch" class="form-control" placeholder="Search module title...">
                </div>
            </div>

            <div class="row">
                <div class="col-10">
                    <table class="table" id="courseTable">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Module Title</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- filled dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <?php include "./layout/footer.php"; ?>

    <script>
        $(document).ready(function () {

            // Load module list
            $.ajax({
                url: 'api/module/list.php',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data.data && data.data.length > 0) {
                        $.each(data.data, function (index, course) {
                            $('#courseTable tbody').append(`
                            <tr>
                                <th scope="row">${index + 1}</th>
                                <td class="module-title">${course.title}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm deleteBtn" data-course-id="${course.module_id}">Delete</button>
                                </td>
                            </tr>
                        `);
                        });
                    } else {
                        $('#courseTable tbody').append(`<tr><td colspan="3">No modules found</td></tr>`);
                    }

                    // Handle delete button
                    $('.deleteBtn').on('click', function () {
                        var courseId = $(this).data('course-id');
                        if (confirm('Are you sure about this?')) {
                            deleteCourse(courseId);
                        }
                    });
                },
                error: function (error) {
                    console.log('Error: ' + error.responseText);
                }
            });

            // Function to delete module
            function deleteCourse(courseId) {
                $.ajax({
                    url: 'api/module/deletemodule.php',
                    type: 'POST',
                    data: { module_id: courseId },
                    success: function (response) {
                        console.log('Course deleted successfully');
                        setTimeout(function () {
                            window.location.href = 'modulelist.php'
                        }, 1000);
                    },
                    error: function (error) {
                        console.log('Error: ' + error.responseText);
                    }
                });
            }

            // Search filter
            $('#moduleSearch').on('keyup', function () {
                var value = $(this).val().toLowerCase();
                $("#courseTable tbody tr").filter(function () {
                    $(this).toggle($(this).find(".module-title").text().toLowerCase().indexOf(value) > -1);
                });
            });

        });
    </script>
