<?php
include('connection.php');

// Fetch testimonials from the database
$sql = "SELECT * FROM testimonials";
$result = $conn->query($sql);

// Check if there are any testimonials
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Output testimonial data within the Bootstrap slide structure
        echo '
        <div class="swiper-slide">
            <div class="testimonial-wrap">
                <div class="testimonial-item">
                <img src="" class="testimonial-img" alt="">
                    <h3>' . $row["name"] . '</h3>
                    <h4>' . $row["occupation"] . '</h4>
                    <div class="stars">';
        // Output star rating dynamically
        for ($i = 0; $i < $row["rating"]; $i++) {
            echo '<i class="bi bi-star-fill"></i>';
        }
        echo '
                    </div>
                    <p>
                    <i class="bi bi-quote quote-icon-left"></i>
                    ' . $row["message"] . '<i class="bi bi-quote quote-icon-right"></i></p> 
                </div>
            </div>
        </div>
        <!-- End testimonial item -->';
    }
} else {
    echo "0 results";
}
$conn->close();
