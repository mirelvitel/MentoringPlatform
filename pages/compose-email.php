<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mentoring Platform</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/email.css" rel="stylesheet">
    <link href="../css/navbar.css" rel="stylesheet">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

</head>

<body>

    <?php include('../components/header.html'); ?>

    <aside>
        <!-- Sidebar content here -->
        <h2>Emails</h2>
        <ul class="sidebar">

            <li>
                <button onclick="href='#'">
                    <i class="bi bi-pencil-square"></i> Compose
                </button>
            </li>

            <li>
                <a class="emailSideBar" href="/MentoringPlatform/pages/inbox-email.php">
                    <button href='#'>
                        <i class="bi bi-inbox"></i> Inbox
                    </button>
                </a>
            </li>

            <li>
                <button onclick="href='#'">
                    <i class="bi bi-star"></i> Starred
                </button>
            </li>

            <li>
                <button onclick="href='#'">
                    <i class="bi bi-send"></i> Sent
                </button>
            </li>

            <li>
                <button onclick="href='#'">
                    <i class="bi bi-trash"></i> Trash
                </button>
            </li>

        </ul>
    </aside>

    <main>
        <div class="container">
            <div class="email-container">
                <div class="email-header">
                    <h3>New Message</h3>
                    <div class="email-header-buttons">
                        <button class="email-header-button">
                            <img src="../screenshots/minimize_button.svg" alt="Minimize">
                        </button>
                        <button class="email-header-button">
                            <img src="../screenshots/bigger_button.svg" alt="Maximize">
                        </button>
                        <button class="email-header-button">
                            <img src="../screenshots/close_button.svg" alt="Close">
                        </button>
                    </div>
                </div>
                <form>
                    <div class="form-group">
                        <label for="from" class="form-label">From</label>
                        <input type="email" id="from" class="form-control" value="admin@technikum-wien.at" readonly>
                    </div>

                    <div class="form-group">
                        <label for="to" class="form-label">To</label>
                        <div class="input-group">
                            <input type="email" id="to" class="form-control" placeholder="mentorin@technikum-wien.at">
                            <span class="icon-group">
                                <img src="../screenshots/magnifying-glass.svg" alt="Search" class="input-group-icon">
                                    <img src="../screenshots/friends.svg" alt="Friends" id="openFilterModal" class="input-group-icon">
                                </a>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="subject" class="form-label">Subject</label>
                        <div class="input-group">
                            <input type="text" id="subject" class="form-control" placeholder="Profile Problem!">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="body" class="form-label">Message</label>
                        <textarea id="body" class="form-control email-body">Hallo Mentorin!</textarea>
                    </div>

                    <div class="form-group send-button-container">
                        <button type="submit" class="btn-send">
                            <img src="../screenshots/send.svg" alt="Send" class="send-icon">
                            Send
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </main>
    <div id="filterModal" class="modal" style="display: none;">
    <!-- Modal content -->
    <div class="modal-content">
      <span class="close" id="closeFilterModal">&times;</span>
      <h3>FILTER <i class="bi bi-sliders"></i></h3>
      <!-- Insert your filter form here -->
      
      <form id="filter-form">
      <div class="filter-row">
          <div class="activity-label">Activity*</div>
          <div class="activity-options">
            <label><input type="radio" name="activity" value="active"> Active</label>
            <label><input type="radio" name="activity" value="non-active"> Non Active</label>
            <label><input type="radio" name="activity" value="all" checked> All</label>
          </div>
        </div>
        
        <div class="filter-row">
          <div class="role-label">Role*</div>
          <div class="role-options">
            <label><input type="radio" name="role" value="mentor"> Mentor</label>
            <label><input type="radio" name="role" value="mentee"> Mentee</label>
            <label><input type="radio" name="role" value="all" checked> All</label>
          </div>
        </div>
        <div class="filter-group">
          <label>Faculty</label>
          <select name="faculty">
            <option value="computer-science">Computer Science</option>
          </select>
          <label>Group</label>
          <select name="group">
            <option value="select">Select</option>
          </select>
          <label>Semester</label>
          <select name="semester">
            <option value="select">Select</option>
          </select>
          <label>More Examples</label>
          <select name="more examples">
            <option value="select">Select</option>
          </select>
        </div>

        <div class="filter-actions">
          <button type="submit" class="btn-search">Search <i class="bi bi-search"></i></button>
          <button type="button" class="btn-add">Add</button>
        </div>
      </form>
    
      <!-- ... -->
    </div>
  </div>

  <script>
// When the user clicks the button, open the modal 
document.getElementById('openFilterModal').onclick = function() {
  document.getElementById('filterModal').style.display = "block";
}

// When the user clicks on <span> (x), close the modal
document.getElementById('closeFilterModal').onclick = function() {
  document.getElementById('filterModal').style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  var modal = document.getElementById('filterModal');
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

</body>
    <footer>
        <!-- Footer content here -->

        <?php include('../components/footer.html'); ?>
    </footer>



</html>