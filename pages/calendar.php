<?php
// Function to generate the monthly calendar HTML
function generateCalendar($month, $year) {
    //HARDCODED events
    $events = [
        '2024-04-01' => [
            'title' => 'April Fools Day Event',
            'time' => '14:00-15:00',
            'description' => 'April Fools Day celebration at the park.'
        ]
    ];
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
        $eventMarkup = "";
        if (isset($events[$date])) {
            // if there's an event on this day, add a marker
            $eventMarkup = "<span class='event-indicator'></span>";
        }
        
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

// Function to generate the weekly calendar HTML
function generateWeeklyCalendar($date) {
    $events = [
        '2024-04-01' => [
            'title' => 'April Fools Day Event',
            'time' => '14:00-15:00',
            'description' => 'April Fools Day celebration at the park.'
        ]
    ];

    $timestamp = strtotime($date);
    
    // Correctly determine the Sunday of the week
    $sundayOfWeek = date('w', $timestamp) == 0 ? $timestamp : strtotime('last sunday', $timestamp);
    
    // Create headers for each day of the week
    $weeklyCalendar = "<table class='calendar-table'>";
    $weeklyCalendar .= "<thead><tr><th></th>"; // Blank cell for the first header

    $daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    for ($i = 0; $i < 7; $i++) {
        $dayTimestamp = strtotime("+$i day", $sundayOfWeek);
        $dayDateFormatted = date('Y-m-d', $dayTimestamp);
        $dayOfMonth = date('j', $dayTimestamp);
        
        // Indicate if there's an event on this day
        $eventIndicator = isset($events[$dayDateFormatted]) ? "*" : ""; // Adjust the indicator as needed
        $weeklyCalendar .= "<th class='header'>$daysOfWeek[$i] $dayOfMonth $eventIndicator</th>";
    }
    $weeklyCalendar .= "</tr></thead><tbody>";

    // Create a row for each hour
    $hours = range(8, 21);
    foreach ($hours as $hour) {
        $hourFormatted = str_pad($hour, 2, "0", STR_PAD_LEFT) . ':00';
        $weeklyCalendar .= "<tr><th class='hour'>$hourFormatted</th>";

        for ($i = 0; $i < 7; $i++) {
            $dayTimestamp = strtotime("+$i day", $sundayOfWeek);
            $dayDateFormatted = date('Y-m-d', $dayTimestamp);
            $eventHtml = "";

            // Check if an event is scheduled for this day and time
            if (isset($events[$dayDateFormatted]) && $hourFormatted == substr($events[$dayDateFormatted]['time'], 0, 5)) {
                $eventHtml = "<div class='event'>" . $events[$dayDateFormatted]['title'] . "</div>";
            }

            $weeklyCalendar .= "<td class='time-slot'>$eventHtml</td>";
        }
        $weeklyCalendar .= "</tr>";
    }

    $weeklyCalendar .= "</tbody></table>";
    return $weeklyCalendar;
}

// Check if this is an AJAX request to update the calendar
if(isset($_POST['action']) && $_POST['action'] == 'get_calendar') {
    $view = $_POST['view'] ?? 'monthly'; // Default to 'monthly' if not set
    $date = $_POST['date'] ?? date('Y-m-d'); // Use current date if none provided

    if ($view === 'weekly') {
        echo generateWeeklyCalendar($date);
    } else {
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
    }
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
                        <select id="calendar-view" class="form-select" aria-label="Select calendar view">
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
            var currentMonth = new Date().getMonth() + 1; // JavaScript months are 0-11
            var currentYear = new Date().getFullYear();
            var currentDate = new Date();

            function updateCalendar(view, date) {
                var monthNames = ["January", "February", "March", "April", "May", "June",
                                "July", "August", "September", "October", "November", "December"];
                var year = date.getFullYear();

                // Determine the Sunday of this week
                var firstDayOfWeek = new Date(date);
                firstDayOfWeek.setDate(date.getDate() - date.getDay()); // Adjust to the previous Sunday

                var formattedMonth = monthNames[firstDayOfWeek.getMonth()];
                var formattedDay = firstDayOfWeek.getDate();

                $.ajax({
                    type: 'POST',
                    url: 'calendar.php',
                    data: {
                        action: 'get_calendar',
                        view: view,
                        date: firstDayOfWeek.toISOString().split('T')[0], // Pass the Sunday date for weekly view
                        month: firstDayOfWeek.getMonth() + 1, // Needed for monthly view
                        year: year  // Needed for monthly view
                    },
                    success: function(response) {
                        $('.calendar-container').html(response);
                        // Update the calendar title depending on the view
                        if(view === 'monthly') {
                            $('#calendar-title').text(`${formattedMonth} ${year}`);
                        } else {
                            $('#calendar-title').text(`Week of ${formattedMonth} ${formattedDay}, ${year}`);
                        }
                    }
                });
            }

            function navigateCalendar(view, direction) {
                if (view === 'monthly') {
                    if (direction === 'prev') {
                        currentDate.setMonth(currentDate.getMonth() - 1);
                    } else {
                        currentDate.setMonth(currentDate.getMonth() + 1);
                    }
                } else { // 'weekly' view
                    var daysToNavigate = (direction === 'prev' ? -7 : 7);
                    currentDate.setDate(currentDate.getDate() + daysToNavigate);
                }
                updateCalendar(view, currentDate);
            }

            $(document).ready(function(){
                var selectedView = $('#calendar-view').val();
                updateCalendar(selectedView, currentDate);

                $('#calendar-view').change(function() {
                    selectedView = $(this).val();
                    updateCalendar(selectedView, currentDate);
                });

                $('#prev-month').click(function(){
                    navigateCalendar(selectedView, 'prev');
                });

                $('#next-month').click(function(){
                    navigateCalendar(selectedView, 'next');
                });

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