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
        <a class="emailSideBar"href='/MentoringPlatform/pages/sent-email.php'>
        <button>
            <i class="bi bi-send"></i> Sent
        </button>
        </a>
      </li>

      <li>
        <a class="emailSideBar"href='/MentoringPlatform/pages/trash-email.php'>
          <button>
            <i class="bi bi-trash"></i> Trash
          </button>
        </a>
     </li>

    </ul>
  </aside>

  <main>
    <!-- Email list content here -->
    <section>
      <article>
        <!-- List of emails -->
        <div class="email-entry"> 
          <i class="bi bi-person-circle icon"></i>
          <div class="email-info">
            <p>Cathrin Luther</p>
            <span>Checking up on your milestones</span>
          </div>
          <span class="date-time">Nov 20, 15:00</span>
        </div>

        <div class="email-entry">
          <i class="bi bi-person-circle icon"></i>
          <div class="email-info">
            <p> Cathrin Jackson</p>
            <span>Another Problem!</span>
          </div>
          <span class="date-time">Nov 20, 15:00</span>
        </div>

        <div class="email-entry">
          <i class="bi bi-person-circle icon"></i>
          <div class="email-info">
            <p> Kristina Musterfrau </p>
            <span>Ending of Mentorship</span>
          </div>
          <span class="date-time">Nov 20, 15:00</span>
        </div>

        <div class="email-entry">
          <i class="bi bi-person-circle icon"></i>
          <div class="email-info">
            <p> Sophia Musterfrau </p>
            <span>Mentorship change request</span>
          </div>
          <span class="date-time">Nov 20, 15:00</span>
        </div>

      </article>
    </section>
  </main>

  <footer>
    <!-- Footer content here -->

    <?php include('../components/footer.html'); ?>
  </footer>

</body>

</html>