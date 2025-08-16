<?php
include "./layout/header.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quiz Listings</h1>
    </div>

    <!-- Filters -->
    <div class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <label for="courseFilter">Select Course:</label>
                <select id="courseFilter" class="form-control">
                    <option value="">-- All Courses --</option>
                    <!-- Dynamically load course options -->
                </select>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button id="filterBtn" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </div>

    <section class="py-5 bg-light shadow-sm">
        <div class="container">
            <div class="row">
                <div class="col-10">
                    <table class="table" id="courseTable">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Question</th>
                            <th scope="col" colspan="4" class="text-center">Choices</th>
                            <th scope="col">Answer</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
include "./layout/footer.php";
?>

<script>
    $(document).ready(function () {
        // Load courses into dropdown
        $.ajax({
            url: 'api/course/list.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.data && data.data.length > 0) {
                    $.each(data.data, function(index, course) {
                        $('#courseFilter').append(
                            `<option value="${course.course_id}">${course.title}</option>`
                        );
                    });
                }
            },
            error: function(error) {
                console.log('Error loading courses:', error.responseText);
            }
        });

        // Function to load quizzes
        function loadQuizzes(course_id = '', module_id = '') {
            $('#courseTable tbody').empty();

            $.ajax({
                url: 'api/quiz/quizview.php',
                type: 'GET',
                data: { course_id: course_id, module_id: module_id },
                dataType: 'json',
                success: function(data) {
                    if (data.data && data.data.length > 0) {
                        $.each(data.data, function(index, course) {
                            $('#courseTable tbody').append(`
                            <tr>
                                <th scope="row">${index + 1}</th>
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
        }

        // Load quizzes initially
        loadQuizzes();

        // Filter button click
        $('#filterBtn').click(function () {
            let course_id = $('#courseFilter').val();
            let module_id = $('#moduleFilter').val();
            loadQuizzes(course_id, module_id);
        });

        // Handle delete click
        $(document).on('click', '.deleteBtn', function () {
            var quizId = $(this).data('quiz-id');
            if (confirm('Are you sure you want to delete this quiz?')) {
                deleteCourse(quizId, $(this));
            }
        });

        function deleteCourse(quizId, btn) {
            $.ajax({
                url: 'api/quiz/deletequiz.php',
                type: 'POST',
                dataType: 'json',
                data: { quiz_id: quizId },
                success: function (response) {
                    if (response.success) {
                        alert(response.message);
                        btn.closest('tr').remove();
                    } else {
                        alert("Delete failed: " + response.message);
                    }
                },
                error: function (error) {
                    console.log('Error: ' + error.responseText);
                }
            });
        }
    });
</script>
