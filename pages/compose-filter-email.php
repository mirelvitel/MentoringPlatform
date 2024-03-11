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
        <a class="emailSideBar" href="/MentoringPlatform/pages/compose-email.php">
          <button>
            <i class="bi bi-pencil-square"></i> Compose
          </button>
        </a>
      </li>

      <li>
        <a class="emailSideBar" href="/MentoringPlatform/pages/inbox-email.php">
          <button>
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

    <!-- filter content here -->
    <div class="content">
    <div class="email-filter">
    <div class="filter-header">
    <h3>
    <a class="emailSideBar" href="/MentoringPlatform/pages/compose-email.php">
            <i class="bi bi-chevron-left"></i>
    </a> FILTER <i class="bi bi-sliders icon"></i>
    </h3>
    
    </div>
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
  </div>
</div>

  <footer>
    <!-- Footer content here -->

    <?php include('../components/footer.html'); ?>
  </footer>

</body>

</html>