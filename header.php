<header id="header" class="header d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="frontend/img/logo.png" alt=""> -->
            <h1 id="logo">AgriData Dynamics<span>.</span></h1>
        </a>

        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="index.php">Services</a></li>
                <li><a href="analysis_page.php">Analysis Page</a></li>
                <li><a href="index.php">Testimonials</a></li>
                <li><a href="index.php">Contact</a></li>

                <?php if (isset($_SESSION['user_id'])) : ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle d-flex align-items-center text-dark col-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="frontend/img/avatar.png" alt="Dashboard" class="mr-1" style="max-height: 40px;">
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
                        <a href="login.php" class="nav-link d-flex align-items-center text-dark col-3"><img src="frontend/img/avatar.png" alt="Login" class="mr-1" style="max-height: 40px;">LogIn</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <!-- .navbar -->
    </div>
</header>
<!-- End Header -->