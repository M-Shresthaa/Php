
<?php
session_start();
include("header.html");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>complete responsive coffee shop website design</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="stylea.css">

</head>
<body>
    
<!-- header section starts  -->

<header class="header">

    <a href="#" class="logo">
        <img src="logo/logo.png" alt="">
    </a>

    <nav class="navbar">
        <h2>Are you already a student here?</h2> 
        <a href="first.php" class="btn">Login to Your Account</a>
        <h2>New Here?</h2>
        <a href="#new-section" class="btn">Learn More ↓</a>
    </nav>

    <div class="search-form">
        <input type="search" id="search-box" placeholder="search here...">
        <label for="search-box" class="fas fa-search"></label>
    </div>

</header>
<section class="home" id="home">

    <div class="content">
        <h3>Yutake language School For Japanese Learner </h3>
        <p> If you are looking for a Japanese courses, or preparing for JLPT, NAT exams feel free to contact us !!!!</p>
        <a href="#" class="btn">Contact Us Now !!!!</a>
    </div>

</section>

<!-- home section ends -->

<!-- about section starts  -->

<section class="about" id="about">

    <h1 class="heading"> <span>about</span> us </h1>

    <div class="row">

        <div class="image">
            <img src="logo/school.jpg" alt="">
        </div>

        <div class="content">
            <h3>EutakaEdu Japanese Language School</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus qui ea ullam, enim tempora ipsum fuga alias quae ratione a officiis id temporibus autem? Quod nemo facilis cupiditate. Ex, vel?</p>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit amet enim quod veritatis, nihil voluptas culpa! Neque consectetur obcaecati sapiente?</p>
            <a href="#" class="btn">learn more</a>
        </div>

    </div>

</section>
<!-- review section starts  -->

<section class="review" id="review">

    <h1 class="heading"> Our <span>Students</span> </h1>

    <div class="box-container">

        <div class="box">
            <img src="images/quote-img.png" alt="" class="quote">
            <p>I passed my JLPT n5 within amonth</p>
            <img src="images/pic-1.png" class="user" alt="">
            <h3>john deo</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
        </div>

        <div class="box">
            <img src="images/quote-img.png" alt="" class="quote">
            <p>The teacher are very professionals and very willing to help in every aspects.</p>
            <img src="images/pic-2.png" class="user" alt="">
            <h3>john deo</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
        </div>
        
        <div class="box">
            <img src="images/quote-img.png" alt="" class="quote">
            <p>Yo will have a boost in the confidence once you take a course in here!!!</p>
            <img src="images/pic-3.png" class="user" alt="">
            <h3>john deo</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
        </div>
    </div>

</section>

<!-- review section ends -->

<script>
// Smooth scrolling when clicking "New Visitor"
document.querySelector('a[href="#new-section"]').addEventListener('click', function(e) {
    e.preventDefault();
    document.querySelector('#new-section').scrollIntoView({ behavior: 'smooth' });
});
</script>

</body>
</html>
<br>
<br>
