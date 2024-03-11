<?php
// Function to generate the calendar HTML
function generateCalendar($month, $year) {
    // Calculate the first day of the month
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
    // How many days does this month contain?
    $numberDays = date('t', $firstDayOfMonth);
    // Retrieve some information about the first day of the
    // month in question.
    $dateComponents = getdate($firstDayOfMonth);
    // What is the name of the month in question?
    $monthName = $dateComponents['month'];
    // What is the index value (0-6) of the first day of the
    // month in question.
    $dayOfWeek = $dateComponents['wday'];

    // Create the table tag opener and day headers
    $calendar = "<table class='calendar-table'>";
    $calendar .= "<thead><tr>";

    // Create the calendar headers
    $daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    foreach ($daysOfWeek as $day) {
        $calendar .= "<th class='header'>$day</th>";
    }
    // Create the rest of the calendar
    // Initiate the day counter, starting with the 1st.
    $currentDay = 1;
    $calendar .= "</tr></thead><tbody><tr>";

    // The variable $dayOfWeek is used to ensure that the calendar
    // display consists of exactly 7 columns.
    if ($dayOfWeek > 0) { 
        $calendar .= "<td colspan='$dayOfWeek'>&nbsp;</td>"; 
    }
    
    $month = str_pad($month, 2, "0", STR_PAD_LEFT);
    
    while ($currentDay <= $numberDays) {
        // Seventh column (Saturday) reached. Start a new row.
        if ($dayOfWeek == 7) {
            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }
        
        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";
        
        $calendar .= "<td class='day' rel='$date'>$currentDay</td>";

        // Increment counters
        $currentDay++;
        $dayOfWeek++;
    }

    // Complete the row of the last week in month if necessary
    if ($dayOfWeek != 7) { 
        $remainingDays = 7 - $dayOfWeek;
        $calendar .= "<td colspan='$remainingDays'>&nbsp;</td>"; 
    }
    
    $calendar .= "</tr></tbody></table>";

    return $calendar;
}

// Check if this is an AJAX request to update the calendar
if(isset($_POST['action']) && $_POST['action'] == 'get_calendar') {
    $month = filter_input(INPUT_POST, 'month', FILTER_VALIDATE_INT, [
        'options' => [
            'default' => date('n'), // current month
            'min_range' => 1,
            'max_range' => 12
        ]
    ]);
    $year = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT, [
        'options' => [
            'default' => date('Y'), // current year
            'min_range' => 2018,
            'max_range' => 2030
        ]
    ]);

    echo generateCalendar($month, $year);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mentoring Platform</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/navbar.css" rel="stylesheet">
    <link href="../css/calendar.css" rel="stylesheet">
    <link href="../css/frontPage.css" rel="stylesheet">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
    <?php include('../components/header.html'); ?>

    <div class="container">
        <div class="row">
            <?php include('../components/sidebar.html'); ?>

            <div class="col-10">
            <h1>CALENDAR</h1>
            <div class="calendar-navigation d-flex justify-content-between align-items-center mb-3">
                <div class="col-8">
                    <h2 id="calendar-title" class="m-0" style="color: #00649C;"><?php echo date('F Y'); ?></h2>
                </div>
                <div class="col-3">
                    <select id="calendar-view" class="form-select" aria-label="Select calendar view" onchange="updateView()">
                        <option value="monthly" selected>Monthly</option>
                        <option value="weekly">Weekly</option>
                    </select>
                </div>
                <div class="col-2 end-text">
                    <button id="prev-month" class="btn btn-light ms-2">&lt;</button>
                    <button id="next-month" class="btn btn-light ms-2">&gt;</button>
                </div>
            </div>
            <div class="calendar-container">
                <!-- The PHP script will insert the calendar table here -->
                <?php echo generateCalendar(date('n'), date('Y')); ?>
            </div>
            <div class="text-end mt-3">
                <button id="create-event" class="btn" data-bs-toggle="modal" data-bs-target="#eventModal" style="background:none; border:none; outline:none;">
                    <svg width="84" height="84" viewBox="0 0 84 84" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="42" cy="42" r="42" fill="#F5F5F5"/>
                        <path d="M22.75 41.5C22.75 34.4294 22.75 30.8931 24.9475 28.6975C27.1431 26.5 30.6794 26.5 37.75 26.5H45.25C52.3206 26.5 55.8569 26.5 58.0525 28.6975C60.25 30.8931 60.25 34.4294 60.25 41.5V45.25C60.25 52.3206 60.25 55.8569 58.0525 58.0525C55.8569 60.25 52.3206 60.25 45.25 60.25H37.75C30.6794 60.25 27.1431 60.25 24.9475 58.0525C22.75 55.8569 22.75 52.3206 22.75 45.25V41.5Z" stroke="#00649C" stroke-width="6.25"/>
                        <path d="M52.75 49H49M49 49H45.25M49 49V45.25M49 49V52.75" stroke="#00649C" stroke-width="6.25" stroke-linecap="round"/>
                        <path opacity="0.5" d="M32.125 26.5V23.6875M50.875 26.5V23.6875M22.75 35.875H60.25" stroke="#00649C" stroke-width="6.25" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
        </div>

        </div>
    </div>
    <footer>
        <?php include('../components/footer.html'); ?>
    </footer>

    <!-- Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="eventModalLabel">Create New Event</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="create-event-form">
                <div class="mb-3">
                    <label for="event-title" class="form-label">Event Title</label>
                    <input type="text" class="form-control" id="event-title" required>
                </div>
                <div class="mb-3">
                    <label for="event-date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="event-date" required>
                </div>
                <div class="mb-3">
                    <label for="event-time" class="form-label">Time</label>
                    <input type="time" class="form-control" id="event-time" required>
                </div>
                <div class="mb-3">
                    <label for="event-participants" class="form-label">Other Participants (optional)</label>
                    <input type="text" class="form-control" id="event-participants">
                </div>
                <div class="mb-3">
                    <label for="event-description" class="form-label">Description</label>
                    <textarea class="form-control" id="event-description" rows="3"></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" form="create-event-form" class="btn btn-primary">Save Event</button>
        </div>
        </div>
    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            var currentMonth = new Date().getMonth() + 1; // JavaScript months are 0-11
            var currentYear = new Date().getFullYear();

            // Attach event listener to previous button
            $('.btn-light').first().click(function(){
                // Decrement month
                currentMonth--;
                if(currentMonth < 1) {
                    currentMonth = 12;
                    currentYear--;
                }
                updateCalendar(currentMonth, currentYear);
            });

            // Attach event listener to next button
            $('.btn-light').last().click(function(){
                // Increment month
                currentMonth++;
                if(currentMonth > 12) {
                    currentMonth = 1;
                    currentYear++;
                }
                updateCalendar(currentMonth, currentYear);
            });

            function updateCalendar(month, year) {
                $.ajax({
                    type: 'POST',
                    url: 'calendar.php', // The PHP file URL
                    data: {
                        action: 'get_calendar',
                        month: month,
                        year: year
                    },
                    success: function(response) {
                        $('.calendar-container').html(response);
                        // Update the calendar title
                        var monthNames = ["January", "February", "March", "April", "May", "June",
                                        "July", "August", "September", "October", "November", "December"];
                        $('#calendar-title').text(monthNames[month - 1] + " " + year);
                    }
                });
            }

            // Event listener for the form submission
            $('#create-event-form').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Gather the form data
            var formData = {
                title: $('#event-title').val(),
                date: $('#event-date').val(),
                time: $('#event-time').val(),
                participants: $('#event-participants').val(),
                description: $('#event-description').val()
            };

            // TODO: Send formData to the server via AJAX or handle it however you need
            console.log(formData); // For demonstration purposes

            // Close the modal after submission
            $('#eventModal').modal('hide');

            // Optionally, you could clear the form fields after saving the event
            $('#create-event-form')[0].reset();
            });

        });
    </script>
</body>

</html>