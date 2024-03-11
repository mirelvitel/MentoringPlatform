<!DOCTYPE html>
<html lang="en">

<head>
  <title>Mentoring Platform</title>
  <link rel="icon" type="image/x-icon" href="./assets/favicon.ico" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/frontPage.css" rel="stylesheet">
  <link href="../css/navbar.css" rel="stylesheet">
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
  <?php include('../components/header.html'); ?>

  <div class="container">
    <div class="row">
      <div class="col sideBar">
        <h1>MAIN</h1>
        <div class="col-md-2">
          <div class="d-flex flex-column align-items-start">
            <ul class="nav nav-pills flex-column mb-auto">
              <li class="nav-item">
                <div class="sideNavItems">
                  <i class="bi bi-box item"></i>
                  <a href="/MentoringPlatform/pages/main.php" class="nav-link item">Home</a>
                </div>
              </li>
              <h1 id="tools">TOOLS</h1>
              <div class="sideNavItems">
                <i class="bi bi-envelope"></i>
                <a href="/MentoringPlatform/pages/inbox-email.php" class="nav-link item">Email</a>
              </div>
              <div class="sideNavItems">
                <i class="bi bi-calendar4"></i>
                <a href="/MentoringPlatform/pages/calendar.php" class="nav-link item">Calendar</a>
              </div>
              <div class="sideNavItems">
                <i class="bi bi-bar-chart"></i>
                <a href="#" class="nav-link item">Reports</a>
              </div>
              <div class="sideNavItems">
                <i class="bi bi-people"></i>
                <a href="#" class="nav-link item">Users</a>
              </div>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-8">
        <h1 id="news">NEWS</h1>
        <div class="container mt-4">

          <div class="card">
            <div class="card-header d-md-flex justify-content-between align-items-center boxBorderHeader">
              <span>Create</span>
              <a href="#"><svg class="addFile " viewBox="0 0 9 18" xmlns="http://www.w3.org/2000/svg">
                  <path d="M7.77273 4.09091V13.5C7.77273 14.368 7.42792 15.2004 6.81417 15.8142C6.20041 16.4279 5.36798 16.7727 4.5 16.7727C3.63202 16.7727 2.79959 16.4279 2.18583 15.8142C1.57208 15.2004 1.22727 14.368 1.22727 13.5V3.27273C1.22727 2.73024 1.44278 2.20997 1.82637 1.82637C2.20997 1.44278 2.73024 1.22727 3.27273 1.22727C3.81522 1.22727 4.33548 1.44278 4.71908 1.82637C5.10268 2.20997 5.31818 2.73024 5.31818 3.27273V11.8636C5.31818 12.0806 5.23198 12.2887 5.07854 12.4422C4.9251 12.5956 4.717 12.6818 4.5 12.6818C4.283 12.6818 4.0749 12.5956 3.92146 12.4422C3.76802 12.2887 3.68182 12.0806 3.68182 11.8636V4.09091H2.45455V11.8636C2.45455 12.4061 2.67005 12.9264 3.05365 13.31C3.43724 13.6936 3.95751 13.9091 4.5 13.9091C5.04249 13.9091 5.56276 13.6936 5.94635 13.31C6.32995 12.9264 6.54545 12.4061 6.54545 11.8636V3.27273C6.54545 2.40475 6.20065 1.57232 5.58689 0.95856C4.97314 0.344804 4.14071 0 3.27273 0C2.40475 0 1.57231 0.344804 0.958559 0.95856C0.344804 1.57232 0 2.40475 0 3.27273V13.5C0 14.6935 0.474106 15.8381 1.31802 16.682C2.16193 17.5259 3.30653 18 4.5 18C5.69347 18 6.83807 17.5259 7.68198 16.682C8.52589 15.8381 9 14.6935 9 13.5V4.09091H7.77273Z" fill="#8BB31D" />
                </svg></a>
            </div>
            <div class="card-body">
              <form>
                <div class="mb-3">
                  <!-- <label for="textInput" class="form-label">Text</label> -->
                  <textarea class="form-control" id="textInput" rows="3" placeholder="Text"></textarea>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                  <button type="submit" class="btn btnCreate">Add</button>
                </div>
              </form>
            </div>
          </div>

          <div class="card">
            <div class="card-header boxBorderHeader">
              <div class="d-flex align-items-center">
                <svg class="userIcon" viewBox="0 0 47 47" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="23.5" cy="23.5" r="23.5" fill="#D9D9D9" />
                  <path d="M20.2114 21.9335C19.2401 21.9335 18.4306 21.5693 17.7831 20.8408C17.1355 20.1123 16.8792 19.2624 17.0141 18.291L17.5402 14.3248C17.7561 12.7868 18.4576 11.5117 19.6448 10.4993C20.832 9.48698 22.2215 8.98134 23.8134 8.98242C25.4053 8.98242 26.7949 9.4886 27.9821 10.5009C29.1692 11.5133 29.8708 12.7879 30.0866 14.3248L30.6127 18.291C30.7477 19.2624 30.4913 20.1123 29.8438 20.8408C29.1962 21.5693 28.3868 21.9335 27.4154 21.9335H20.2114ZM10.8623 34.8846V30.3518C10.8623 29.4344 11.0987 28.5909 11.5714 27.8214C12.0441 27.0519 12.6711 26.4653 13.4525 26.0617C15.1254 25.2253 16.8252 24.5977 18.552 24.1789C20.2788 23.7602 22.0326 23.5513 23.8134 23.5524C25.5942 23.5524 27.348 23.7618 29.0748 24.1806C30.8016 24.5993 32.5014 25.2264 34.1743 26.0617C34.9568 26.4664 35.5844 27.0535 36.0571 27.823C36.5298 28.5926 36.7656 29.4355 36.7645 30.3518V34.8846H10.8623Z" fill="white" />
                </svg>
                <div>
                  <h6 class="mb-0 infoUsername">Claudia Musterfrau</h6>
                  <small class="text-muted">Wednesday, 6 January 2024 at 13:50 AM</small>
                </div>
              </div>
            </div>
            <div class="card-body">
              <p>Hello everyone!</p>
              <p>I am looking for a new mentor to help me with ...</p>
              <p>Thank you!</p>
            </div>
          </div>

          <div class="card">
            <div class="card-header boxBorderHeader">
              <div class="d-flex align-items-center">
                <svg class="handshakeIcon" viewBox="0 0 29 29" xmlns="http://www.w3.org/2000/svg">
                  <path d="M14.349 24.1665C14.4296 24.1665 14.5101 24.1464 14.5907 24.1061C14.6712 24.0658 14.7316 24.0255 14.7719 23.9853L24.6802 14.0769C24.9219 13.8353 25.0983 13.5634 25.2095 13.2613C25.3207 12.9592 25.3758 12.6571 25.375 12.355C25.375 12.0328 25.3199 11.7255 25.2095 11.4331C25.0991 11.1407 24.9227 10.8841 24.6802 10.6634L19.5448 5.52796C19.3233 5.2863 19.0663 5.11028 18.7739 4.99992C18.4815 4.88956 18.175 4.83398 17.8544 4.83317C17.5523 4.83317 17.2502 4.88875 16.9481 4.99992C16.646 5.11109 16.3742 5.2871 16.1325 5.52796L15.8002 5.86025L18.0356 8.12588C18.3377 8.40782 18.5592 8.73005 18.7002 9.09255C18.8412 9.45505 18.9117 9.83768 18.9117 10.2405C18.9117 11.0863 18.6249 11.7964 18.0513 12.3708C17.4778 12.9451 16.7677 13.2319 15.921 13.2311C15.5183 13.2311 15.1308 13.1606 14.7586 13.0196C14.3865 12.8787 14.059 12.6672 13.7762 12.3853L11.5094 10.1498L6.22296 15.4363C6.16254 15.4967 6.11743 15.5624 6.08762 15.6333C6.05782 15.7041 6.04251 15.7795 6.04171 15.8592C6.04171 16.0203 6.10212 16.1665 6.22296 16.2978C6.34379 16.4291 6.48476 16.4944 6.64587 16.4936C6.72643 16.4936 6.80698 16.4734 6.88754 16.4332C6.96809 16.3929 7.02851 16.3526 7.06879 16.3123L11.1771 12.204L12.8688 13.8957L8.79066 18.004C8.73025 18.0644 8.68514 18.1301 8.65533 18.201C8.62553 18.2718 8.61022 18.3472 8.60941 18.4269C8.60941 18.588 8.66983 18.729 8.79066 18.8498C8.9115 18.9707 9.05247 19.0311 9.21358 19.0311C9.29414 19.0311 9.37469 19.0109 9.45525 18.9707C9.5358 18.9304 9.59622 18.8901 9.6365 18.8498L13.7448 14.7717L15.4365 16.4634L11.3584 20.5717C11.298 20.612 11.2528 20.6724 11.223 20.753C11.1932 20.8335 11.1779 20.9141 11.1771 20.9946C11.1771 21.1557 11.2375 21.2967 11.3584 21.4175C11.4792 21.5384 11.6202 21.5988 11.7813 21.5988C11.8618 21.5988 11.9376 21.5835 12.0085 21.5529C12.0793 21.5223 12.1446 21.4772 12.2042 21.4175L16.3125 17.3394L18.0042 19.0311L13.8959 23.1394C13.8355 23.1998 13.7903 23.2651 13.7605 23.3352C13.7307 23.4053 13.7154 23.481 13.7146 23.5623C13.7146 23.7234 13.7803 23.8644 13.9116 23.9853C14.0429 24.1061 14.1887 24.1665 14.349 24.1665ZM14.3188 26.5832C13.5737 26.5832 12.9139 26.3367 12.3395 25.8437C11.7652 25.3507 11.4281 24.7312 11.3282 23.9853C10.6434 23.8846 10.0695 23.6026 9.60629 23.1394C9.1431 22.6762 8.86115 22.1023 8.76046 21.4175C8.07573 21.3169 7.50701 21.0301 7.05429 20.5572C6.60157 20.0844 6.32446 19.5152 6.22296 18.8498C5.45768 18.7491 4.83337 18.4168 4.35004 17.853C3.86671 17.2891 3.62504 16.6245 3.62504 15.8592C3.62504 15.4564 3.70076 15.069 3.85221 14.6968C4.00365 14.3246 4.21994 13.9972 4.50108 13.7144L11.5094 6.7363L15.4667 10.6936C15.507 10.754 15.5674 10.7995 15.648 10.8301C15.7285 10.8607 15.8091 10.8756 15.8896 10.8748C16.0709 10.8748 16.2219 10.8197 16.3427 10.7093C16.4636 10.5989 16.524 10.4527 16.524 10.2707C16.524 10.1901 16.5087 10.1096 16.4781 10.029C16.4475 9.94845 16.4024 9.88803 16.3427 9.84775L12.023 5.52796C11.8014 5.2863 11.5449 5.11028 11.2532 4.99992C10.9616 4.88956 10.6543 4.83398 10.3313 4.83317C10.0292 4.83317 9.72712 4.88875 9.42504 4.99992C9.12296 5.11109 8.85108 5.2871 8.60941 5.52796L4.35004 9.81754C4.16879 9.9988 4.01775 10.2103 3.89691 10.4519C3.77608 10.6936 3.69553 10.9353 3.65525 11.1769C3.61497 11.4186 3.61497 11.6655 3.65525 11.9176C3.69553 12.1698 3.77608 12.4062 3.89691 12.6269L2.14483 14.379C1.80247 13.9158 1.55073 13.4075 1.38962 12.8541C1.22851 12.3007 1.16809 11.7416 1.20837 11.1769C1.24865 10.613 1.38962 10.0644 1.63129 9.53117C1.87296 8.99789 2.20525 8.51939 2.62816 8.09567L6.88754 3.8363C7.37087 3.3731 7.90979 3.02067 8.50429 2.779C9.09879 2.53734 9.70779 2.4165 10.3313 2.4165C10.9556 2.4165 11.565 2.53734 12.1595 2.779C12.754 3.02067 13.2824 3.3731 13.7448 3.8363L14.0771 4.16859L14.4094 3.8363C14.8927 3.3731 15.4317 3.02067 16.0262 2.779C16.6207 2.53734 17.2297 2.4165 17.8532 2.4165C18.4775 2.4165 19.0869 2.53734 19.6814 2.779C20.2759 3.02067 20.8043 3.3731 21.2667 3.8363L26.3719 8.9415C26.8351 9.4047 27.1875 9.93838 27.4292 10.5425C27.6709 11.1467 27.7917 11.7609 27.7917 12.3853C27.7917 13.0096 27.6709 13.619 27.4292 14.2135C27.1875 14.808 26.8351 15.3364 26.3719 15.7988L16.4636 25.6769C16.1816 25.9589 15.8546 26.1804 15.4824 26.3415C15.1102 26.5026 14.7224 26.5832 14.3188 26.5832Z" fill="#8BB31D" />
                </svg>
                <div>
                  <small class="text-muted">Wednesday, 20 January 2024 at 19:50 AM</small>
                </div>
              </div>
            </div>
            <div class="card-body">
              <p><i id="handshakeName">Beatrice</i> and <i id="handshakeName">Sarah</i> have agreed to a new menthorship.</p>
            </div>
          </div>

          <div class="card">
            <div class="card-header boxBorderHeader">
              <div class="d-flex align-items-center">
                <svg class="userIcon" viewBox="0 0 47 47" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="23.5" cy="23.5" r="23.5" fill="#D9D9D9" />
                  <path d="M20.2114 21.9335C19.2401 21.9335 18.4306 21.5693 17.7831 20.8408C17.1355 20.1123 16.8792 19.2624 17.0141 18.291L17.5402 14.3248C17.7561 12.7868 18.4576 11.5117 19.6448 10.4993C20.832 9.48698 22.2215 8.98134 23.8134 8.98242C25.4053 8.98242 26.7949 9.4886 27.9821 10.5009C29.1692 11.5133 29.8708 12.7879 30.0866 14.3248L30.6127 18.291C30.7477 19.2624 30.4913 20.1123 29.8438 20.8408C29.1962 21.5693 28.3868 21.9335 27.4154 21.9335H20.2114ZM10.8623 34.8846V30.3518C10.8623 29.4344 11.0987 28.5909 11.5714 27.8214C12.0441 27.0519 12.6711 26.4653 13.4525 26.0617C15.1254 25.2253 16.8252 24.5977 18.552 24.1789C20.2788 23.7602 22.0326 23.5513 23.8134 23.5524C25.5942 23.5524 27.348 23.7618 29.0748 24.1806C30.8016 24.5993 32.5014 25.2264 34.1743 26.0617C34.9568 26.4664 35.5844 27.0535 36.0571 27.823C36.5298 28.5926 36.7656 29.4355 36.7645 30.3518V34.8846H10.8623Z" fill="white" />
                </svg>
                <div>
                  <h6 class="mb-0 infoUsername">Claudia Musterfrau</h6>
                  <small class="text-muted">Wednesday, 27 January 2024 at 16:20 AM</small>
                </div>
              </div>
            </div>
            <div class="card-body">
              <p id="contentBox">Has added content to her page!</p>
            </div>
          </div> 

          <div class="card">
            <div class="card-header boxBorderHeader">
              <div class="d-flex align-items-center">
                <svg class="userIcon" viewBox="0 0 47 47" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="23.5" cy="23.5" r="23.5" fill="#D9D9D9" />
                  <path d="M20.2114 21.9335C19.2401 21.9335 18.4306 21.5693 17.7831 20.8408C17.1355 20.1123 16.8792 19.2624 17.0141 18.291L17.5402 14.3248C17.7561 12.7868 18.4576 11.5117 19.6448 10.4993C20.832 9.48698 22.2215 8.98134 23.8134 8.98242C25.4053 8.98242 26.7949 9.4886 27.9821 10.5009C29.1692 11.5133 29.8708 12.7879 30.0866 14.3248L30.6127 18.291C30.7477 19.2624 30.4913 20.1123 29.8438 20.8408C29.1962 21.5693 28.3868 21.9335 27.4154 21.9335H20.2114ZM10.8623 34.8846V30.3518C10.8623 29.4344 11.0987 28.5909 11.5714 27.8214C12.0441 27.0519 12.6711 26.4653 13.4525 26.0617C15.1254 25.2253 16.8252 24.5977 18.552 24.1789C20.2788 23.7602 22.0326 23.5513 23.8134 23.5524C25.5942 23.5524 27.348 23.7618 29.0748 24.1806C30.8016 24.5993 32.5014 25.2264 34.1743 26.0617C34.9568 26.4664 35.5844 27.0535 36.0571 27.823C36.5298 28.5926 36.7656 29.4355 36.7645 30.3518V34.8846H10.8623Z" fill="white" />
                </svg>
                <div>
                  <h6 class="mb-0 infoUsername">Claudia Musterfrau</h6>
                  <small class="text-muted">Wednesday, 6 January 2024 at 13:50 AM</small>
                </div>
              </div>
            </div>
            <div class="card-body">
              <p>Hello everyone!</p>
              <p>I am looking for a new mentor to help me with ...</p>
              <p>Thank you!</p>
            </div>
          </div>

          <div class="card">
            <div class="card-header boxBorderHeader">
              <div class="d-flex align-items-center">
                <svg class="userIcon" viewBox="0 0 47 47" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="23.5" cy="23.5" r="23.5" fill="#D9D9D9" />
                  <path d="M20.2114 21.9335C19.2401 21.9335 18.4306 21.5693 17.7831 20.8408C17.1355 20.1123 16.8792 19.2624 17.0141 18.291L17.5402 14.3248C17.7561 12.7868 18.4576 11.5117 19.6448 10.4993C20.832 9.48698 22.2215 8.98134 23.8134 8.98242C25.4053 8.98242 26.7949 9.4886 27.9821 10.5009C29.1692 11.5133 29.8708 12.7879 30.0866 14.3248L30.6127 18.291C30.7477 19.2624 30.4913 20.1123 29.8438 20.8408C29.1962 21.5693 28.3868 21.9335 27.4154 21.9335H20.2114ZM10.8623 34.8846V30.3518C10.8623 29.4344 11.0987 28.5909 11.5714 27.8214C12.0441 27.0519 12.6711 26.4653 13.4525 26.0617C15.1254 25.2253 16.8252 24.5977 18.552 24.1789C20.2788 23.7602 22.0326 23.5513 23.8134 23.5524C25.5942 23.5524 27.348 23.7618 29.0748 24.1806C30.8016 24.5993 32.5014 25.2264 34.1743 26.0617C34.9568 26.4664 35.5844 27.0535 36.0571 27.823C36.5298 28.5926 36.7656 29.4355 36.7645 30.3518V34.8846H10.8623Z" fill="white" />
                </svg>
                <div>
                  <h6 class="mb-0 infoUsername">Claudia Musterfrau</h6>
                  <small class="text-muted">Wednesday, 6 January 2024 at 13:50 AM</small>
                </div>
              </div>
            </div>
            <div class="card-body">
              <p>Hello everyone!</p>
              <p>I am looking for a new mentor to help me with ...</p>
              <p>Thank you!</p>
            </div>
          </div>

          <div class="card">
            <div class="card-header boxBorderHeader">
              <div class="d-flex align-items-center">
                <svg class="userIcon" viewBox="0 0 47 47" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="23.5" cy="23.5" r="23.5" fill="#D9D9D9" />
                  <path d="M20.2114 21.9335C19.2401 21.9335 18.4306 21.5693 17.7831 20.8408C17.1355 20.1123 16.8792 19.2624 17.0141 18.291L17.5402 14.3248C17.7561 12.7868 18.4576 11.5117 19.6448 10.4993C20.832 9.48698 22.2215 8.98134 23.8134 8.98242C25.4053 8.98242 26.7949 9.4886 27.9821 10.5009C29.1692 11.5133 29.8708 12.7879 30.0866 14.3248L30.6127 18.291C30.7477 19.2624 30.4913 20.1123 29.8438 20.8408C29.1962 21.5693 28.3868 21.9335 27.4154 21.9335H20.2114ZM10.8623 34.8846V30.3518C10.8623 29.4344 11.0987 28.5909 11.5714 27.8214C12.0441 27.0519 12.6711 26.4653 13.4525 26.0617C15.1254 25.2253 16.8252 24.5977 18.552 24.1789C20.2788 23.7602 22.0326 23.5513 23.8134 23.5524C25.5942 23.5524 27.348 23.7618 29.0748 24.1806C30.8016 24.5993 32.5014 25.2264 34.1743 26.0617C34.9568 26.4664 35.5844 27.0535 36.0571 27.823C36.5298 28.5926 36.7656 29.4355 36.7645 30.3518V34.8846H10.8623Z" fill="white" />
                </svg>
                <div>
                  <h6 class="mb-0 infoUsername">Claudia Musterfrau</h6>
                  <small class="text-muted">Wednesday, 6 January 2024 at 13:50 AM</small>
                </div>
              </div>
            </div>
            <div class="card-body">
              <p>Hello everyone!</p>
              <p>I am looking for a new mentor to help me with ...</p>
              <p>Thank you!</p>
            </div>
          </div>

          <div class="card">
            <div class="card-header boxBorderHeader">
              <div class="d-flex align-items-center">
                <svg class="userIcon" viewBox="0 0 47 47" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="23.5" cy="23.5" r="23.5" fill="#D9D9D9" />
                  <path d="M20.2114 21.9335C19.2401 21.9335 18.4306 21.5693 17.7831 20.8408C17.1355 20.1123 16.8792 19.2624 17.0141 18.291L17.5402 14.3248C17.7561 12.7868 18.4576 11.5117 19.6448 10.4993C20.832 9.48698 22.2215 8.98134 23.8134 8.98242C25.4053 8.98242 26.7949 9.4886 27.9821 10.5009C29.1692 11.5133 29.8708 12.7879 30.0866 14.3248L30.6127 18.291C30.7477 19.2624 30.4913 20.1123 29.8438 20.8408C29.1962 21.5693 28.3868 21.9335 27.4154 21.9335H20.2114ZM10.8623 34.8846V30.3518C10.8623 29.4344 11.0987 28.5909 11.5714 27.8214C12.0441 27.0519 12.6711 26.4653 13.4525 26.0617C15.1254 25.2253 16.8252 24.5977 18.552 24.1789C20.2788 23.7602 22.0326 23.5513 23.8134 23.5524C25.5942 23.5524 27.348 23.7618 29.0748 24.1806C30.8016 24.5993 32.5014 25.2264 34.1743 26.0617C34.9568 26.4664 35.5844 27.0535 36.0571 27.823C36.5298 28.5926 36.7656 29.4355 36.7645 30.3518V34.8846H10.8623Z" fill="white" />
                </svg>
                <div>
                  <h6 class="mb-0 infoUsername">Claudia Musterfrau</h6>
                  <small class="text-muted">Wednesday, 6 January 2024 at 13:50 AM</small>
                </div>
              </div>
            </div>
            <div class="card-body">
              <p>Hello everyone!</p>
              <p>I am looking for a new mentor to help me with ...</p>
              <p>Thank you!</p>
            </div>
          </div>

          <div class="card">
            <div class="card-header boxBorderHeader">
              <div class="d-flex align-items-center">
                <svg class="userIcon" viewBox="0 0 47 47" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="23.5" cy="23.5" r="23.5" fill="#D9D9D9" />
                  <path d="M20.2114 21.9335C19.2401 21.9335 18.4306 21.5693 17.7831 20.8408C17.1355 20.1123 16.8792 19.2624 17.0141 18.291L17.5402 14.3248C17.7561 12.7868 18.4576 11.5117 19.6448 10.4993C20.832 9.48698 22.2215 8.98134 23.8134 8.98242C25.4053 8.98242 26.7949 9.4886 27.9821 10.5009C29.1692 11.5133 29.8708 12.7879 30.0866 14.3248L30.6127 18.291C30.7477 19.2624 30.4913 20.1123 29.8438 20.8408C29.1962 21.5693 28.3868 21.9335 27.4154 21.9335H20.2114ZM10.8623 34.8846V30.3518C10.8623 29.4344 11.0987 28.5909 11.5714 27.8214C12.0441 27.0519 12.6711 26.4653 13.4525 26.0617C15.1254 25.2253 16.8252 24.5977 18.552 24.1789C20.2788 23.7602 22.0326 23.5513 23.8134 23.5524C25.5942 23.5524 27.348 23.7618 29.0748 24.1806C30.8016 24.5993 32.5014 25.2264 34.1743 26.0617C34.9568 26.4664 35.5844 27.0535 36.0571 27.823C36.5298 28.5926 36.7656 29.4355 36.7645 30.3518V34.8846H10.8623Z" fill="white" />
                </svg>
                <div>
                  <h6 class="mb-0 infoUsername">Claudia Musterfrau</h6>
                  <small class="text-muted">Wednesday, 6 January 2024 at 13:50 AM</small>
                </div>
              </div>
            </div>
            <div class="card-body">
              <p>Hello everyone!</p>
              <p>I am looking for a new mentor to help me with ...</p>
              <p>Thank you!</p>
            </div>
          </div>

          <div class="card">
            <div class="card-header boxBorderHeader">
              <div class="d-flex align-items-center">
                <svg class="userIcon" viewBox="0 0 47 47" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="23.5" cy="23.5" r="23.5" fill="#D9D9D9" />
                  <path d="M20.2114 21.9335C19.2401 21.9335 18.4306 21.5693 17.7831 20.8408C17.1355 20.1123 16.8792 19.2624 17.0141 18.291L17.5402 14.3248C17.7561 12.7868 18.4576 11.5117 19.6448 10.4993C20.832 9.48698 22.2215 8.98134 23.8134 8.98242C25.4053 8.98242 26.7949 9.4886 27.9821 10.5009C29.1692 11.5133 29.8708 12.7879 30.0866 14.3248L30.6127 18.291C30.7477 19.2624 30.4913 20.1123 29.8438 20.8408C29.1962 21.5693 28.3868 21.9335 27.4154 21.9335H20.2114ZM10.8623 34.8846V30.3518C10.8623 29.4344 11.0987 28.5909 11.5714 27.8214C12.0441 27.0519 12.6711 26.4653 13.4525 26.0617C15.1254 25.2253 16.8252 24.5977 18.552 24.1789C20.2788 23.7602 22.0326 23.5513 23.8134 23.5524C25.5942 23.5524 27.348 23.7618 29.0748 24.1806C30.8016 24.5993 32.5014 25.2264 34.1743 26.0617C34.9568 26.4664 35.5844 27.0535 36.0571 27.823C36.5298 28.5926 36.7656 29.4355 36.7645 30.3518V34.8846H10.8623Z" fill="white" />
                </svg>
                <div>
                  <h6 class="mb-0 infoUsername">Claudia Musterfrau</h6>
                  <small class="text-muted">Wednesday, 6 January 2024 at 13:50 AM</small>
                </div>
              </div>
            </div>
            <div class="card-body">
              <p>Hello everyone!</p>
              <p>I am looking for a new mentor to help me with ...</p>
              <p>Thank you!</p>
            </div>
          </div>

        </div>
      </div>

      <div class="col">
        <h1>REPORTS SUMMARY</h1>
        <div class="card report-card">
          <div class="card-header report-card-header d-flex justify-content-between align-items-center">
            New Users
            <i class="bi bi-people icon-box"></i>
          </div>
          <div class="card-body report-card-body">
            <div class="report-value-up">+59</div>
            <div class="report-increase">
              <i class="bi bi-caret-up-fill"></i>
            </div>
          </div>
        </div>

        <div class="card report-card">
          <div class="card-header report-card-header d-flex justify-content-between align-items-center">
            New Matches
            <i class="bi bi-people icon-box"></i>
          </div>
          <div class="card-body report-card-body">
            <div class="report-value-up">+27</div>
            <div class="report-increase">
              <i class="bi bi-caret-up-fill"></i>
            </div>
          </div>
        </div>

        <div class="card report-card">
          <div class="card-header report-card-header d-flex justify-content-between align-items-center">
            User Feedback
            <i class="bi bi-people icon-box"></i>
          </div>
          <div class="card-body report-card-body">
            <div class="report-value-down">-3.4%</div>
            <div class="report-increase">
              <i class="bi bi-caret-down-fill" style="color: #F44336;"></i>
            </div>
          </div>
        </div>
      </div>



    </div>
  </div>
  <footer>
    <!-- Footer content here -->

    <?php include('../components/footer.html'); ?>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>