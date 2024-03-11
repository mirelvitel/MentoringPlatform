<!DOCTYPE html>
<html lang="en">

<head>
  <title>Mentoring Platform</title>
  <link rel="icon" type="image/x-icon" href="./assets/favicon.ico" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/frontPage.css" rel="stylesheet">
  <link href="../css/navbar.css" rel="stylesheet">
  <link href="../css/profile.css" rel="stylesheet">
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
  <?php include('../components/header.html'); ?>

  <div class="container">
    <div class="row">
      <?php include('../components/sidebar.html'); ?>

      <div class="col-lg-10 col-md-9 col-sm-12 bootstrap snippets bootdey">
        <div class="row">
          <h1>EDIT PROFILE</h1>
          <hr>
          <!-- left column -->
          <div class="col-lg-3 col-md-3">
            <div class="text-center">
              <svg class="avatar img-circle img-thumbnail" viewBox="0 0 71 71" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="35.5" cy="35.5" r="35.5" fill="#D9D9D9" />
                <path d="M30.5318 33.1338C29.0644 33.1338 27.8417 32.5835 26.8634 31.483C25.8852 30.3825 25.498 29.0986 25.7018 27.6313L26.4966 21.6397C26.8227 19.3164 27.8824 17.3901 29.6758 15.8608C31.4692 14.3315 33.5683 13.5677 35.9731 13.5693C38.3779 13.5693 40.477 14.334 42.2704 15.8633C44.0638 17.3926 45.1236 19.318 45.4497 21.6397L46.2445 27.6313C46.4483 29.0986 46.0611 30.3825 45.0828 31.483C44.1046 32.5835 42.8818 33.1338 41.4145 33.1338H30.5318ZM16.4087 52.6982V45.8507C16.4087 44.4649 16.7657 43.1907 17.4798 42.0283C18.1939 40.8658 19.1412 39.9797 20.3216 39.3699C22.8487 38.1064 25.4165 37.1584 28.0251 36.5258C30.6337 35.8932 33.283 35.5777 35.9731 35.5793C38.6632 35.5793 41.3126 35.8956 43.9212 36.5282C46.5298 37.1608 49.0976 38.108 51.6247 39.3699C52.8067 39.9813 53.7548 40.8683 54.4689 42.0307C55.183 43.1932 55.5392 44.4665 55.5376 45.8507V52.6982H16.4087Z" fill="white" />
              </svg>

              <h6 style="color: #90B30F; font-size: 30px;">Admin</h6>
              <input type="file" class="form-control">
            </div>
          </div>

          <!-- form column -->
          <div class="col-lg-9 col-md-9 personal-info">

            <form class="form-horizontal" role="form">
              <div class="form-group">
                <label class="control-label">Firstname:</label>
                <div>
                  <input class="form-control" type="text">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Lastname:</label>
                <div>
                  <input class="form-control" type="text">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Email:</label>
                <div>
                  <input class="form-control" type="email">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Phone:</label>
                <div>
                  <input class="form-control" type="text">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Admin ID:</label>
                <div>
                  <input class="form-control" type="number">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Specialization:</label>
                <div>
                  <div class="ui-select">
                    <select id="field_specialization" class="form-control">
                      <option>Field_1</option>
                      <option>Field_2</option>
                      <option>Field_3</option>
                      <option>Field_4</option>
                      <option>Field_5</option>
                    </select>
                  </div>
                </div>
              </div>
              <div>
                <button class="editProfile">Edit Profile <svg width="23" height="25" viewBox="0 0 23 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18.1967 2.0957L21.0717 5.2207L18.88 7.60404L16.005 4.47904L18.1967 2.0957ZM7.6665 16.6665H10.5415L17.5249 9.07591L14.6499 5.95091L7.6665 13.5415V16.6665Z" fill="white" />
                    <path d="M18.2083 19.7917H7.81808C7.79317 19.7917 7.76729 19.8021 7.74238 19.8021C7.71075 19.8021 7.67912 19.7927 7.64654 19.7917H4.79167V5.20833H11.3534L13.27 3.125H4.79167C3.73462 3.125 2.875 4.05833 2.875 5.20833V19.7917C2.875 20.9417 3.73462 21.875 4.79167 21.875H18.2083C18.7167 21.875 19.2042 21.6555 19.5636 21.2648C19.9231 20.8741 20.125 20.3442 20.125 19.7917V10.7625L18.2083 12.8458V19.7917Z" fill="white" />
                  </svg></button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <hr>


    </div>
  </div>
  <footer>
    <!-- Footer content here -->

    <?php include('../components/footer.html'); ?>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>