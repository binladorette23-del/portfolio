<?php
define("hostname", "localhost");
define("username", "root");
define("password", "");
define("database", "portdb");

$connection = mysqli_connect(hostname, username, password, database);

if (!$connection) {
    die("connection failed");
}

$errorMessage = "";
$successMessage = "";
$reviewError = "";
$reviewSuccess = "";

// Handle contact form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['fullName'])) {

    $fullName = trim($_POST['fullName']);
    $email    = trim($_POST['email']);
    $phone    = trim($_POST['phone']);
    $subject  = trim($_POST['subject']);
    $message  = trim($_POST['message']);

    if (empty($fullName) || empty($email) || empty($message)) {
        $errorMessage = "Please fill in the required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Invalid email address.";
    } else {
        $stmt = $connection->prepare("INSERT INTO messages (FullName, Email, PhoneNumber, Subject, Message, Status, CreatedAt) VALUES (?, ?, ?, ?, ?, 'unread', NOW())");
        $stmt->bind_param("sssss", $fullName, $email, $phone, $subject, $message);

        if ($stmt->execute()) {
            $successMessage = "Message sent successfully!";
        } else {
            $errorMessage = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Handle review/rating submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitReview'])) {
    $reviewerName = trim($_POST['reviewerName']);
    $rating = intval($_POST['rating']);
    $comment = trim($_POST['comment']);

    if (empty($reviewerName) || $rating < 1 || $rating > 5) {
        $reviewError = "Please provide your name and a valid rating.";
    } else {
        $stmt = $connection->prepare("INSERT INTO reviews (FullName, Rating, Comment, CreatedAt) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sis", $reviewerName, $rating, $comment);
        if ($stmt->execute()) {
            $reviewSuccess = "Thanks for your rating!";
        } else {
            $reviewError = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>Binla Dorette-Portfolio</title>
</head>

<body>

    <!-- header section code -->

    <header class="header">
        <a href="#home" class="logo">Binla Dorette</a>

        <i class='bx bx-menu' id="menu-icon"></i>

        <nav class="navbar">
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#services">Services</a>
            <a href="#testimonial">testimonial</a>
            <a href="#contact">contact</a>
        </nav>
    </header>

    <!--Home Section Code-->

    <section class="Home" id="Home">
        <div class="home-img">
            <img src="dorette.jpg" alt="profile image">
        </div>

        <div class="home-content" id="home">
            <h3>Hello, Myself</h3>
            <h1> Binla Dorette</h1>
            <h3> And I am a <span class="multiple-text">Web Developer</span></h3>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptate modi magnam error aliquid corrupti
                reprehenderit sequi, aspernatur deserunt, quisquam debitis provident dignissimos? Cumque aut quos itaque
                deserunt nisi repellat nihil!</p>

            <div class="social-media">
                <a href="#"><i class='bx bxl-linkedin'></i></a>
                <a href="#"><i class='bx bxl-facebook-circle'></i></a>
                <a href="#"><i class='bx bxl-instagram-alt'></i></a>
                <a href="#"><i class='bx bxl-whatsapp'></i></a>
            </div>
            <a href="#" class="btn">Download CV</a>
        </div>
    </section>

    <section class="About" id="about">
        <div class="About-content">
            <h2 class="heading">About <span>Me</span></h2>
            <h3> I Am a <span> front end Developer</span></h3>
            <p>My name is Binla Dorette and i am a passionate and dedicated Developer</p>
            <a href="readMe.html" class="btn">Read More</a>
        </div>

        <div class="About-img">
            <img src="IMG-20260729-WA0005.jpg" alt="About Image">
        </div>
    </section>

    <!--services section code-->

    <section class="section" id="services">
        <h2 class="heading">My <span>Services</span></h2>

        <div class="services-container">
            <div class="services-box">
                <i class="bx bx-code"></i>
                <h3> Web Development</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam itaque consequuntur quos in quia
                    provident corporis magnam a esse suscipit eligendi, beatae aspernatur veniam quibusdam ea autem,
                    nobis fugiat repellendus!</p>
                <a href="#" class="btn">Read More</a>
            </div>


            <div class="services-box">
                <i class="bx bx-palette"></i>
                <h3> UI/UX Design</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit laboriosam repudiandae
                    nesciunt aperiam recusandae est porro quasi perferendis nam, fugiat vitae ipsa deleniti nobis
                    libero? Ipsa soluta corrupti modi cumque.</p>
                <a href="#" class="btn">Read More</a>
            </div>

            <div class="services-box">
                <i class="bx bxl-android"></i>
                <h3> App Development</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus modi sint eaque eos aliquam
                    cum saepe, delectus dolor necessitatibus maxime iste. Iure repellat animi ut laudantium veniam
                    eius nulla natus?</p>
                <a href="#" class="btn">Read More</a>
            </div>
        </div>
    </section>

    <!--testimonial section-->

    <section class="testimonial" id="testimonial">

        <div class="testimonial-box">
            <h2 class="heading">Testimonials</h2>
            <div class="testimonil-slider">

                <div class="wrapper">

                    <div class="testimonial-item">
                        <img src="IMG-20260727-WA0041.jpg" alt="">

                        <h2>Dorette</h2>
                        <div class="rating">
                            <i class="bx bxs-star" id="star"></i>
                            <i class="bx bxs-star" id="star"></i>
                            <i class="bx bxs-star" id="star"></i>
                            <i class="bx bxs-star" id="star"></i>
                            <i class="bx bxs-star" id="star"></i>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda tempore ut, a hic ad architecto
                            officia voluptates nemo soluta aspernatur ducimus ipsam corrupti optio doloremque ipsa fugiat
                            mollitia vitae. Dignissimos.</p>
                    </div>

                    <div class="testimonial-item">
                        <img src="dorette.jpg" alt="">

                        <h2>Binla</h2>
                        <div class="rating">
                            <i class="bx bxs-star" id="star"></i>
                            <i class="bx bxs-star" id="star"></i>
                            <i class="bx bxs-star" id="star"></i>
                            <i class="bx bxs-star" id="star"></i>
                            <i class="bx bxs-star" id="star"></i>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda tempore ut, a hic ad architecto
                            officia voluptates nemo soluta aspernatur ducimus ipsam corrupti optio doloremque ipsa fugiat
                            mollitia vitae. Dignissimos.</p>
                    </div>

                    <div class="testimonial-item">
                        <img src="wiyk.jpeg" alt="">

                        <h2>Dorette</h2>
                        <div class="rating">
                            <i class="bx bxs-star" id="star"></i>
                            <i class="bx bxs-star" id="star"></i>
                            <i class="bx bxs-star" id="star"></i>
                            <i class="bx bxs-star" id="star"></i>
                            <i class="bx bxs-star" id="star"></i>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda tempore ut, a hic ad architecto
                            officia voluptates nemo soluta aspernatur ducimus ipsam corrupti optio doloremque ipsa fugiat
                            mollitia vitae. Dignissimos.</p>
                    </div>
                </div>
            </div>
            <button class="prev-btn">&#10094</button>
            <button class="next-btn">&#10095</button>

            <div class="dots">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>

        <!--Rate Me form-->
        <div class="rate-me-box">
            <h2 class="heading">Rate <span>Me</span></h2>

            <?php if (!empty($reviewSuccess)): ?>
                <p style="color: green; text-align: center;"><?php echo $reviewSuccess; ?></p>
            <?php elseif (!empty($reviewError)): ?>
                <p style="color: red; text-align: center;"><?php echo $reviewError; ?></p>
            <?php endif; ?>

            <form action="#contact" method="post">
                <div class="input-box">
                    <input type="text" name="reviewerName" placeholder="Your Name" required>
                    <select name="rating" required>
                        <option value="">Rate me</option>
                        <option value="5">★★★★★ Excellent</option>
                        <option value="4">★★★★ Good</option>
                        <option value="3">★★★ Average</option>
                        <option value="2">★★ Poor</option>
                        <option value="1">★ Very Poor</option>
                    </select>
                </div>
                <div class="input-box">
                    <textarea name="comment" id="" cols="30" placeholder="Leave a comment (optional)"></textarea>
                </div>
                <input type="submit" name="submitReview" value="Submit Rating" class="btn">
            </form>
        </div>
    </section>

    <!--contact section code-->
    <section class="contact" id="contact">
        <h2 class="heading">contact <span>Me</span></h2>

        <?php if (!empty($successMessage)): ?>
            <p style="color: green; text-align: center;"><?php echo $successMessage; ?></p>
        <?php elseif (!empty($errorMessage)): ?>
            <p style="color: red; text-align: center;"><?php echo $errorMessage; ?></p>
        <?php endif; ?>

        <form action="#" method="post">
            <div class="input-box">
                <input type="text" name="fullName"  placeholder="Full Name" required>
                <input type="email" name="email" placeholder="email address" required>
            </div>
            <div class="input-box">
                <input type="number" name="phone" placeholder="phone number">
                <input type="text" name="subject" placeholder="email subject">
            </div>
            <div class="input-box">
                <textarea name="message" id="" cols="30" placeholder="your messsage"></textarea>
                <input type="submit" value="send message" class="btn">
            </div>
        </form>
    </section>
    <!-- footer section code-->

    <footer class="footer">
        <div class="social">
            <a href="#"><i class='bx bxl-linkedin'></i></a>
            <a href="#"><i class='bx bxl-facebook'></i></a>
            <a href="#"><i class='bx bxl-instagram'></i></a>
            <a href="#"><i class='bx bxl-whatsapp-square'></i></a>
        </div>
        <p class="copyright">
            &copy;Binla Dorette-All rights reserved
        </p>
    </footer>

    <script src="https://unpkg.com/typed.js@3.0.0/dist/typed.umd.js"></script>
    <script src="script.js"></script>
</body>
</html>