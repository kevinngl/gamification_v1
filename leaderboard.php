<?php
include "./function.php";
include "./header.php";
if (!isLoggedIn()) {
    header('location:login.php');
    exit();
}

?>
<!--nav fixed-->
<header class="bg-primary-subtle  py-5">
    <div class="container">
        <div class="row py-5">
            <div class="col-12">
                <div class="lh-sm w-100 mx-auto text-center ">
                    <div class="gam__profile-image text-center mx-auto d-flex justify-content-center align-items-center">
                        <h3 class="fw-bold display-3">
                            <i class="fa-solid fa-gamepad"></i>
                        </h3>
                    </div>


                    <div class="row justify-content-center gap-0">
                        <div class="col-7">
                            <h3 class="fw-bold gam__title">
                                <h3 class="fw-bold opacity-75 display-3">
                                    Rankings
                                </h3>
                            </h3>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--header -->
<!--section-->
<section class="bg-body-tertiary py-5">
    <div class="container">
        <div class="row">
            <div class="lh-sm text-center">

            </div>
            <div class="py-3">
                <table class="table table-striped table-hover table-responsive" id="leaderTable">
                    <thead>
                        <tr>
                            <th scope="col">Rank</th>
                            <th scope="col">Email</th>
                            <th scope="col">Username</th>
                            <th scope="col">Earning</th>
                            <th scope="col">Level</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                        <!-- User data added here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!--section-->
</main>
<?php
include "./footer.php"

?>
<script>
    let levelRanges = [{
            level: "Basic",
            earnings: 0,
            xps_coin: 0
        },
        {
            level: "Pro",
            earnings: 200,
            xps_coin: 1000
        },
        {
            level: "Master",
            earnings: 500,
            xps_coin: 2000
        }
    ];


    function getUserLevel(user) {
        for (let i = levelRanges.length - 1; i >= 0; i--) {
            if (user.earnings >= levelRanges[i].earnings && user.xps_coin >= levelRanges[i].xps_coin) {
                return levelRanges[i].level;
            }
        }

        return "Unknown";
    }

    $.ajax({
        url: 'admin/api/user/alluser.php',
        method: 'GET',
        dataType: 'json',
        success: function(jsonData) {
            // Sort the data based on earning and xps_coin
            jsonData.data.sort(function(a, b) {
                // Compare by earning first
                if (a.earnings !== b.earnings) {
                    return b.earnings - a.earnings; // Descending order by earning
                } else {
                    return b.xps_coin - a.xps_coin; // If earning is the same, compare by xps_coin
                }
            });

            // Assign ranks to each user
            $.each(jsonData.data, function(index, user) {
                user.rank = index + 1;
                user.level = getUserLevel(user); // Assign user level
            });

            // Append data to the table
            let tableBody = $('#userTableBody');
            $.each(jsonData.data, function(index, user) {
                if (user.earnings <= 0) {
                    return;
                }

                let row = '<tr>';
                row += '<td>' + user.rank + '</td>';
                row += '<td>' + user.email + '</td>';
                row += '<td>' + user.username + '</td>';
                row += '<td>' + user.earnings + '</td>';
                row += '<td>' + user.level + '</td>';
                row += '</tr>';
                tableBody.append(row);
            });
        },
        error: function() {
            console.log('Error fetching data');
        }
    });
</script>

</body>

</html>