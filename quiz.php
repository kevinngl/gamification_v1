<?php
include "./function.php";
include "./header.php";
if(!isLoggedIn())
{
    header('location:login.php');
    exit();
}

?>
          <section class="vh-100 bg-body-secondary bg-opacity-25">
            <div class="container-fluid">
                <div class="row gap-0">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="bg-light border p-3">
                            <div class="text-start lh-sm pt-5">
                                <h4 class="fw-bold " id ="course-title">Business Mathematics</h4>
                            </div>
                            <div class="py-2">
                                <span class="small fw-normal"></span>
                                <div class="progress" style="height: 3px;">
                                    <div class="progress-bar bg-success rounded-5" role="progressbar" style="width: 50%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                  <input type="hidden" id="usery" value=" <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ""; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12" id="question-section">
                        <div class="mx-auto py-2 text-center bg-light shadow-sm ">
                            <div class="lh-sm">
                                <small class="fw-bold">Quiz</small>
                            </div>
                        </div>
                        <div id="answers-list" style="display: none;" class="py-5 ">
                                      <h2 class="fw-bold display-3">All Answers Feedback</h2>
                                      <ul class="list-group-flush d-flex flex-column">
                                        <!-- Answer items will be dynamically added here -->
                                      </ul>
                                    </div>
                        <div class="mt-3 d-flex justify-content-center align-items-center " id="question-menu">
                            <div class="bg-light border w-100 p-3" id="question-forms">
                                <div class="p-4">
                                   <div class="py-1 w-100 d-flex justify-content-between align-items-start ">
                                   <div class=" px-2 rounded-pill border "> <small>Multiple Quiz</small></div>
                                    <div id="timer" class="text-end float-end rounded-pill p-2 shadow-sm border">countdown: <span id="time-left" class="small"></span></div>
                                    
                                   </div>
                                    <div class="fw-bold my-3">
                                        <h3 id="question">Loading...</h3>
                                    </div>
                                    <hr class="py-2"/>
                                    <div class="option py-4">
                                        <ul class="list-group list-group-flush" id="choices-list">
                                            <li class="list-group-item border border-0 py-3 bg-light shadow-sm mb-1">
                                                <input class="form-check-input me-3" type="radio" name="radioNoLabel" id="radioNoLabel1" value="" aria-label="...">
                                                <label for="btn-check-3 ps-3">Loading...</label>
                                            </li>
                                            <li class="list-group-item border border-0 py-3 bg-light shadow-sm mb-1">
                                                <input class="form-check-input me-3" type="radio" name="radioNoLabel" id="radioNoLabel1" value="" aria-label="...">
                                                <label for="btn-check-3 ps-3">Loading...</label>
                                            </li>
                                            <li class="list-group-item border border-0 py-3 bg-light shadow-sm mb-1">
                                                <input class="form-check-input me-3" type="radio" name="radioNoLabel" id="radioNoLabel1" value="" aria-label="...">
                                                <label for="btn-check-3 ps-3">Loading...</label>
                                            </li>
                                            <li class="list-group-item border border-0 py-3 bg-light shadow-sm mb-1">
                                                <input class="form-check-input me-3" type="radio" name="radioNoLabel" id="radioNoLabel1" value="" aria-label="...">
                                                <label for="btn-check-3 ps-3">Loading...</label>
                                            </li>
                            
                                        </ul>
                                    </div>
                                   

                                    <div class="pt-3 float-end">
                                        <button type="button" class="btn btn-outline-secondary small btn-md  text-dark" id="next-btn">Next</button>
                                    </div>
                                </div>
                            </div>
                          
                        </div>

                    </div>
                </div>
            </div>
          </section>
          
          <section>
            <div class="container">
              <div class="row">
                <div class="col-12">
                <!-- Bootstrap Modal -->
                  <div class="modal fade rounded-0" id="badgeModal" tabindex="-1" aria-labelledby="badgeModalLabel" aria-hidden="true">
                    <div class="modal-dialog rounded-0">
                      <div class="modal-content">
                        <div class="modal-header border border-0 rounded-0">
                          <h5 class="modal-title" id="badgeModalLabel">Score: <span id="scoreboard"></span></h5>
                          <button type="button" class="btn-close bg-light rounded-0" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body border border-0 text-center">
                          <p id="badge-earned">No badges earned yet.</p>
                          <img id="badge-image" src="" alt="image awrd here" class="img-fluid" style="width:100px;height:100px;">
                          <div id="earned-point" class="text-center"></div>
                        </div>
                        <div class="modal-footer">
                        <button id="show-answers-btn" class="btn btn-primary rounded-0 border border-0">Continue</button>

                        </div>
                      </div>
                    </div>
                  </div>
              
              </div>
              </div>
            </div>
          </section>
    </main>
    
    <?php include "./footer.php";    ?>


    

<script>
    console.log("posisi kita disini");
$(document).ready(function() {
    //get user experience id
    const usr = localStorage.getItem('user');
  
  const usr2 = $('#userd').val();
  const realuser = usr ?? usr2;
  let currentQuestion = 0;
  let score = 0;
  let questions;
  let timer;
  let badges;
  let timeTaken = 0;
  
  //function to get url parameters
  function getUrlParameters() {
    const urlParams = new URLSearchParams(window.location.search);
    const params = {};

    for (const [key, value] of urlParams.entries()) {
      params[key] = value;
    }
    console.log("params", params);
    return params;
  }

  const parameters = getUrlParameters();
  console.log("parameters",parameters);
  // Access specific parameter values:
  // const courseId = parameters.course_id;
    const courseId = parameters.course; // matches ?course= in URL
  const nameCourse = parameters.name;
  const coin = parameters.cn
    $('#course-title').html(nameCourse)
    console.log(courseId);
  //fetching data using ajax request  
  function fetchQuizData() {
    $.ajax({
      url: 'admin/api/quiz/quizView.php',
      method: 'GET',
      // KIRIM COURSE ID KE BACKEND
      data: { course_id: courseId },
      success: function(response) {
        questions = response.data; // Ambil langsung data yang sudah difilter dari backend
          console.log("questions", questions);
        
        // Hapus logika filtering di frontend karena sudah dilakukan di backend
        if(questions && questions.length >= 1){
          showQuestion();
        }else{
          $('#question-forms').hide()
          $('#question-menu').append("<div class='text-center p-4 rounded-0 border'>MCQ is unavailable for this course</div>")
        }
        
      },
      error: function() {
        alert('Failed to load quiz questions.');
      }
    });
  }
// display question
  function showQuestion() {
    if (currentQuestion < questions.length) {
      resetTimer();
      $('#question').text(questions[currentQuestion].question);

      const choices = [
        questions[currentQuestion].option_a,
        questions[currentQuestion].option_b,
        questions[currentQuestion].option_c,
        questions[currentQuestion].option_d
      ];

      const $choicesList = $('#choices-list');
      $choicesList.empty();

      choices.forEach(function(choice, index) {
        const choiceId = `radioNoLabel${index}`;
        $choicesList.append(`
          <li class="list-group-item border border-0 py-3 bg-light shadow-sm mb-1" data-index="${index}">
            <input class="form-check-input me-3" type="radio" name="radioNoLabel" id="${choiceId}" value="${index}" aria-label="...">
            <label for="${choiceId}">${choice}</label>
          </li>
        `);
      });

      $choicesList.find('li').on('click', function() {
        const selectedChoice = $(this).data('index');
        checkAnswer(selectedChoice);
      });

      startTimer();
      $('#next-btn').off('click').on('click', function() {
        const selectedChoice = $('input[name="radioNoLabel"]:checked');
        if (selectedChoice.length > 0) {
          checkAnswer(selectedChoice.val());
        } else {
          alert('Please select an answer.');
        }
      });
    } else {
      // Quiz is complete
      revealAnswers();
    }
  }

  function checkAnswer(selectedChoice) {
    const correctIndex = getCorrectIndex(questions[currentQuestion].answer);

    if (selectedChoice == correctIndex) {
      score += calculateScore();
    }

    // Apply the background color to the selected choice
    $(`li[data-index="${selectedChoice}"]`).addClass('bg-success');

    // Move to the next question
    currentQuestion++;
    // Update the score display
    $('#score').text(`Score: ${score}`);
    // Remove the background color and uncheck the radio buttons
    $('li').removeClass('bg-success');
    $('input[name="radioNoLabel"]').prop('checked', false);
    // Show the next question
    showQuestion();
  }

  //logic for calculating score

  function calculateScore() {
    // Calculate the score based on the time taken
    const maxPoints = 10; // Maximum points for a correct answer
    const maxTime = 15; // Maximum time allowed per question (in seconds)
    const timeFactor = 1; // Adjust this factor to control the impact of time on the score

    const remainingTime = maxTime - timeTaken;
    const timeScore = Math.max(0, (remainingTime / maxTime) * timeFactor);
    return Math.round(maxPoints - timeScore);
  }

  // Function to get the index of the correct answer
  function getCorrectIndex(answer) {
    const options = ['option_a', 'option_b', 'option_c', 'option_d'];
    return options.indexOf(answer);
  }

  function revealAnswers() {
    $('#reveal-answer').show();
      $('#correct-answer').text(questions.map(q => q.answer).join(', '));
      awardBadges();
  }

  function startTimer() {
    let timeLeft = 60; // Set the initial time for each question (in seconds)
    updateTimerDisplay(timeLeft);

    timer = setInterval(function() {
      timeLeft--;
      timeTaken++;

      if (timeLeft >= 0) {
        updateTimerDisplay(timeLeft);
      } else {
        clearInterval(timer);
        // Time's up, move to the next question
        currentQuestion++
        showQuestion();
      }
    }, 1000);
  }

  function resetTimer() {
    clearInterval(timer);
    timeTaken = 0;
    $('#time-left').text('');
  }

  function updateTimerDisplay(timeLeft) {
    $('#time-left').text(timeLeft);
  }


  // awards and coin earned 
  function awardBadges() {
  let badgeEarned = '';
  let pointsEarned = '';
  let win = '';
  let wincoin;
    console.log("score",score);
  if ( score >= questions.length * 10 - (questions.length + 10) ) {
    badgeEarned = 'Congratulations! You are now a master of' + ' ' + nameCourse;
    pointsEarned = 'You earned ' + coin + ' coin';
    win = 'gold'
    wincoin = coin
  
    $('#badge-image').attr('src', 'assets/images/icons/medal.gif');
  } else if (score >= questions.length * 10 - (questions.length + 15) ) {
    badgeEarned = `Uhm,That's great, But, you can do better`;
    win = 'diamond'
    wincoin = 0
    $('#badge-image').attr('src', 'assets/images/icons/medal2.gif');
  } else if (score >= questions.length * 10 - (questions.length + 20)) {
    badgeEarned = 'Uhm, I believe you can do better!';
    win = 'bronze'
    $('#badge-image').attr('src', 'assets/images/icons/crazy.gif');
    wincoin = 0
  }else{
    badgeEarned = 'Oh well well, Try again! ';
    win = 'stone'
    $('#badge-image').attr('src', 'assets/images/icons/cry.gif');
    wincoin = 0
  }
  
  

  // Update the modal content with the earned badge, points, and image
  $('#badge-earned').text(badgeEarned || 'No badge earned yet.');
  $('#earned-point').text(pointsEarned);
  $('#scoreboard').text(score);
  updateUser(courseId, realuser, score, win, wincoin);

  // Show the modal
  $('#badgeModal').modal('show');
}
//fetch all data
function displayAllAnswers() {
  // Hide the question and choices elements

  $('#question-forms').css('display','none')

  // Create a list to display all answers and correct answers
  const $answersList = $('#answers-list');
  $answersList.empty();

  questions.forEach(function (q, index) {
    // const correctIndex = getCorrectIndex(q.answer);
      const correctIndex = getCorrectIndex(q.answer);
    const correctChoice = ['A', 'B', 'C', 'D'][correctIndex];

    const userChoice = $('input[name="radioNoLabel"]:checked').eq(index).val();

    $answersList.append(`
    
      <li class="list-group-item border border-bottom-1 border-bottom-info p-2">
        <strong>Question ${index + 1}:</strong> ${q.question}<br>
        <strong>Correct Answer:</strong> ${correctChoice}
      </li>
    `);
  });

  // Show the list of answers
  $answersList.css('display','block');
}

//
$('#show-answers-btn').on('click', function () {
  $('#badgeModal').modal('hide');
  displayAllAnswers();
});

//

//update user table
function    updateUser(courseId, realuser,newScore, win,wincoin) {
  // Perform an AJAX request to update the user score on the database

    const payload = {
        course: courseId,
        user: realuser,
        score: newScore,
        win: win,
        wincoin: wincoin
    };

    // Log the array/object to console
    console.log("updateUser payload:", payload);

    $.ajax({
    url: 'admin/api/user/earnings.php',
    method: 'POST',
    data: { 
      course:courseId,
      user:realuser,
      score: newScore,
      win: win,
      wincoin : wincoin
    },
    success: function(response) {
      console.log('Score updated successfully:', response);
    },
    error: function() {
      console.error('Failed to update score on the database.');
    }
  });
}


//update tracker tables


  // Initial fetch
  fetchQuizData();
});
</script>

</body>
</html>