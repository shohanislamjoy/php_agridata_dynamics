<?php
include('login_check.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>AgriData Dynamics - Home</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/farm_1.png" rel="icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/main.css" rel="stylesheet">

</head>

<body>

    <header id="header" class="header d-flex align-items-center">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1 id="logo">AgriData Dynamics<span>.</span></h1>
            </a>

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="analysis_page.php">Analysis Page</a></li>
                    <li><a href="#testimonials">Testimonials</a></li>
                    <li><a href="#contact">Contact</a></li>

                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle d-flex align-items-center text-dark col-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="assets/img/avatar.png" alt="Dashboard" class="mr-1" style="max-height: 40px;">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
                                <li>
                                    <h4 class="h3 mb-0"><strong><?php echo $user_name ?></strong></h4>
                                    <div class="mb-3">
                                        <?php echo $user_email ?>
                                    </div>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <a id="openReviewForm" class="dropdown-item">
                                        <i class="fa-regular fa-comments"></i>Leave a Review</a>

                                    <!-- Review form modal -->
                                    <div id="reviewModal" class="modal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Leave a Review</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>


                                                </div>
                                                <div class="modal-body">
                                                    <form id="reviewForm" action="submit_review.php" method="post">
                                                        <div class="form-group">
                                                            <label for="name">Your Name</label>
                                                            <input type="text" name="name" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Your Occupation</label>
                                                            <input type="text" name="occupation" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="message">Your Review</label>
                                                            <textarea name="message" class="form-control" rows="3" required></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="rating">Rating:</label><br>
                                                            <div class="rate text-center">
                                                                <input type="radio" id="star5" name="rate" value="5" />
                                                                <label for="star5" title="text"></label>
                                                                <input type="radio" id="star4" name="rate" value="4" />
                                                                <label for="star4" title="text"></label>
                                                                <input type="radio" id="star3" name="rate" value="3" />
                                                                <label for="star3" title="text"></label>
                                                                <input type="radio" id="star2" name="rate" value="2" />
                                                                <label for="star2" title="text"></label>
                                                                <input type="radio" id="star1" name="rate" value="1" />
                                                                <label for="star1" title="text"></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group text-center">
                                                            <button type="submit" class="btn btn-secondary">Submit Review</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li><a href="#" class="dropdown-item"><i class="fas fa-user-cog mr-2"></i> Settings</a></li>
                                <li><a href="#" class="dropdown-item"><i class="fas fa-lock mr-2"></i> Change Password</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a href="logout.php" class="dropdown-item text-danger" id="logout-button"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a></li>
                            </ul>
                        </li>
                    <?php else : ?>
                        <li>
                            <a href="login.php" class="nav-link d-flex align-items-center text-dark col-3"><img src="assets/img/avatar.png" alt="Login" class="mr-1" style="max-height: 40px;">LogIn</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <!-- .navbar -->
        </div>
    </header>
    <!-- End Header -->


    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero">
        <div class="info d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h2 data-aos="fade-down">Welcome to <span>AgriData Dynamics</span></h2>
                        <p data-aos="fade-up"><b>W</b>e pioneer advanced data analytics to revolutionize agriculture. Our expertise in crop weather analysis and field data management empowers farmers with actionable insights for sustainable growth.</p>


                        <a data-aos="fade-up" data-aos-delay="200" href="#contact" class="btn-contact">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>

        <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-item active" style="background-image: url(assets/img/hero/unsplash/7.jpg)"></div>
            <div class="carousel-item" style="background-image: url(assets/img/hero/unsplash/6.jpg)"></div>
            <div class="carousel-item" style="background-image: url(assets/img/hero/unsplash/8.jpg)"></div>
            <div class="carousel-item" style="background-image: url(assets/img/hero/unsplash/10.jpg)"></div>
            <div class="carousel-item" style="background-image: url(assets/img/hero/unsplash/12.jpg)"></div>

            <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>
        </div>
    </section>
    <!-- End Hero Section -->

    <main id="main">
        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6" data-aos="fade-right">
                        <div class="content">
                            <h3>About Us</h3>
                            <p>At Agridata Dynamics, we are dedicated to harnessing cutting-edge technology to transform the agricultural landscape. With a firm commitment to sustainable farming practices and data-driven solutions, we empower farmers and agricultural professionals to navigate the complexities of modern agriculture with confidence.</p>
                            <p>Our success is rooted in integrity, collaboration, and a profound respect for the land. We believe in forging meaningful partnerships with farmers, agronomists, researchers, and industry stakeholders to drive positive change and foster a more sustainable future for agriculture.</p>
                            <p>At Agridata Dynamics, we are not merely revolutionizing agriculture – we are cultivating a brighter, more sustainable future for generations to come.</p>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">
                        <div class="image">
                            <!-- Replace 'image_url' with the actual URL of the image representing Agridata Dynamics -->
                            <img src="assets/img/hero/unsplash/data_about.jpg" class="img-fluid" alt="About Us Image">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End About Us Section -->


        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Services</h2>
                    <p>Explore our range of services tailored to optimize your agricultural operations.</p>
                </div>

                <div class="row gy-4">

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item  position-relative">
                            <div class="icon">
                                <i class="fa-solid fa-mountain-city"></i>
                            </div>
                            <h3>Data Analysis</h3>
                            <p>Unlock insights from your agricultural data to make informed decisions and improve productivity.</p>
                            <a href="service-details.html" class="readmore stretched-link">Learn more <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="fa-solid fa-arrow-up-from-ground-water"></i>
                            </div>
                            <h3>Predictive Modeling</h3>
                            <p>Anticipate crop yields, disease outbreaks, and market trends through advanced predictive modeling techniques.</p>
                            <a href="service-details.html" class="readmore stretched-link">Learn more <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="fa-solid fa-compass-drafting"></i>
                            </div>
                            <h3>Crop Monitoring</h3>
                            <p>Monitor crop health, growth stages, and environmental conditions in real-time to optimize cultivation practices.</p>
                            <a href="service-details.html" class="readmore stretched-link">Learn more <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="fa-solid fa-trowel-bricks"></i>
                            </div>
                            <h3>Farm Management Software</h3>
                            <p>Streamline farm operations, track inventory, and manage resources efficiently with our comprehensive software solutions.</p>
                            <a href="service-details.html" class="readmore stretched-link">Learn more <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="fa-solid fa-helmet-safety"></i>
                            </div>
                            <h3>Consulting Services</h3>
                            <p>Receive expert guidance and customized solutions tailored to your specific agricultural challenges and goals.</p>
                            <a href="service-details.html" class="readmore stretched-link">Learn more <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="fa-solid fa-arrow-up-from-ground-water"></i>
                            </div>
                            <h3>Data Analytics</h3>
                            <p>Harness the power of data analytics to optimize resource allocation, minimize risks, and maximize agricultural productivity.</p>
                            <a href="service-details.html" class="readmore stretched-link">Learn more <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- End Service Item -->

                </div>

            </div>
        </section>
        <!-- End Services Section -->



        <!-- ======= Testimonials Section ======= -->
        <section id="testimonials" class="testimonials section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Testimonials</h2>
                    <p>Here are some testimonials from our satisfied clients. We take pride in delivering exceptional services and exceeding our clients' expectations. Read on to see what they have to say about their experience working with us.</p>
                </div>

                <div class="slides-2 swiper">
                    <div class="swiper-wrapper">
                        <?php include 'show_testimonials.php' ?>

                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section>
        <!-- End Testimonials Section -->



        <!-- ======= contact form ======= -->
        <section id="contact" class="contact section-bg">
            <div class="container">
                <div class="row justify-content-between gy-4">
                    <div class="col-lg-6 d-flex align-items-center" data-aos="fade-up">
                        <div class="content">
                            <h3>Contact Us</h3>
                            <p>At Agridata Dynamics, we're passionate about leveraging cutting-edge technology to revolutionize agriculture. With a deep-rooted commitment to sustainable farming practices and data-driven solutions, we empower farmers and agricultural professionals to navigate the complexities of modern agriculture with confidence.</p>

                            <!-- <p>Our journey began with a simple yet profound vision: to bridge the gap between traditional farming methods and innovative technologies. Founded by a team of agronomists, data scientists, and technology enthusiasts, Agridata Dynamics is driven by the belief that data holds the key to unlocking the full potential of agriculture.

                            <p> At the heart of our mission lies a dedication to empowering farmers with actionable insights derived from comprehensive data analysis. By harnessing the power of advanced analytics, predictive modeling, and artificial intelligence, we enable farmers to make informed decisions that drive productivity, optimize resource allocation, and mitigate risks.</p>

                            <p>We understand that every farm is unique, facing its own set of challenges and opportunities. That's why we take a personalized approach to our solutions, tailoring our services to meet the specific needs and goals of each client. Whether it's crop monitoring, soil analysis, yield forecasting, or farm management software, we're committed to delivering innovative solutions that empower farmers to thrive in an ever-evolving agricultural landscape.</p> -->

                            <p>Beyond technology, our success is built on a foundation of integrity, collaboration, and a deep-rooted respect for the land. We believe in fostering meaningful partnerships with farmers, agronomists, researchers, and industry stakeholders to drive positive change and create a more sustainable future for agriculture.</p>

                            <p>At Agridata Dynamics, we're not just revolutionizing agriculture — we're cultivating a brighter, more sustainable future for generations to come.</p>

                        </div>
                    </div>
                    <div class="col-lg-5" data-aos="fade">
                        <!-- Alert message -->
                        <div id="alertMessage" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                            <strong>Success!</strong> Your message has been received successfully. Thank you!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <form id="quoteForm" action="submit_contact.php" method="post" class="php-email-form">
                            <div class="row gy-3">
                                <div class="col-md-12">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
                                </div>
                                <div class="col-md-12">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="col-md-12">
                                    <textarea class="form-control" id="message" name="message" rows="6" placeholder="Message" required></textarea>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" id="submitButton">Send A Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- End Quote Form -->
                </div>
            </div>
        </section>
        <!-- End contact form Section -->

    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include('footer.php') ?>
    <!-- End Footer -->


</body>

</html>