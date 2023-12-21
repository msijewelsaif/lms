<?php
require_once "connection.php"; // Include the database connection file

// Fetch testimonials from the database
$sql = "SELECT * FROM testimonials";
$result = $conn->query($sql);

$testimonials = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $testimonials[] = $row;
    }
}

?>

<!-- Testimonials section starts -->
<section class="testimonials">
    <h2>What Our Students Say</h2>
    <?php foreach ($testimonials as $testimonial) : ?>
        <div class="testimonial-card">
            <div class="testimonial-content">
                <p><?php echo $testimonial['content']; ?></p>
            </div>
            <div class="testimonial-author">
                <p><?php echo $testimonial['author']; ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</section>
<!-- Testimonials section ends -->

<?php
$conn->close(); // Close the database connection
?>
