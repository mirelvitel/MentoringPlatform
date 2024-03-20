<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Mentoring Platform</title>
        <link rel="icon" type="image/x-icon" href="./assets/favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/frontPage.css" rel="stylesheet">
        <link href="../css/navbar.css" rel="stylesheet">
        <link href="../css/help.css" rel="stylesheet">
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
    </head>

    <body>
        <?php include('../components/header.html'); ?>

        <div class="container">
            <h1>Help Center</h1>
            <div class="row">
                <div class="col-md-10">
                    <!------------------- FAQ -------------------->
                    <h3>FAQ</h3>
                    <div class="accordion" id="faqAccordion">

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Question 1
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Answer to question 1.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Question 2
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Answer to question 2.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Question 3
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Answer to question 3.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Question 4
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Answer to question 4.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    Question 5
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Answer to question 5.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-------------------- Contact ---------------------->
                <div class="col-md-2 support-box">
                    <h3>Contact Support</h3>
                    <form action="path_to_support_submission_script" method="post">
                        <div class="mb-3">
                            <label for="supportName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="supportName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="supportEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="supportEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="supportMessage" class="form-label">Message</label>
                            <textarea class="form-control" id="supportMessage" name="message" rows="3" required></textarea>
                        </div>
                        <div class="button-wrapper">
                            <button type="submit" class="btn btn-custom">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer>
            <?php include('../components/footer.html'); ?>
        </footer>

        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        
    </body>

</html>