<?php
session_start();
require_once("../../theme/header.php"); 
setTitle("about");
?>
<!-- Header-->
<header class="bg-dark py-5 mb-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Welcome to YourShop</h1>
            <p class="lead fw-normal text-white-50 mb-0">Your one-stop shop for all your needs, from fashion to electronics</p>
        </div>
    </div>
</header>
<!-- About section-->
<section id="about">
    <div class="container px-4">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-8 mb-5 mt-5">
                <h2>About Our Store</h2>
                <p class="lead">YourShop is a premier online shopping destination offering a wide range of products across multiple categories. We are committed to providing our customers with high-quality products, seamless shopping experiences, and unbeatable prices. Our extensive inventory includes everything from fashion and beauty to electronics and home goods.</p>
                <ul>
                    <li>Wide range of products from trusted brands</li>
                    <li>Secure online shopping experience</li>
                    <li>Fast and reliable shipping</li>
                    <li>24/7 customer support</li>
                    <li>Easy returns and exchanges</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- Services section-->
<section class="bg-light mt-5" id="services">
    <div class="container px-4">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-8 mb-5 mt-5">
                <h2>Services We Offer</h2>
                <p class="lead">At YourShop, we go beyond simply offering products. We strive to provide our customers with a range of services designed to make their shopping experience as convenient and enjoyable as possible.</p>
                <ul>
                    <li><strong>Personalized Shopping Recommendations</strong>: Get tailored product suggestions based on your browsing and purchase history.</li>
                    <li><strong>Gift Wrapping Services</strong>: Send your purchases as a beautifully wrapped gift, complete with a personal message.</li>
                    <li><strong>Order Tracking</strong>: Stay updated on the status of your orders in real-time with our advanced tracking system.</li>
                    <li><strong>Subscription Boxes</strong>: Sign up for monthly subscription boxes filled with your favorite products.</li>
                    <li><strong>Exclusive Deals and Discounts</strong>: Enjoy members-only discounts and promotions by signing up for our loyalty program.</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- Contact section-->
<section id="contact">
    <div class="container px-4">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-8 mt-5 mb-5">
                <h2>Contact Us</h2>
                <p class="lead">Have a question, concern, or need support? We’re here to help! Our customer service team is available 24/7 to assist you with any inquiries or issues you may have.</p>
                <p>Email: support@yourshop.com</p>
                <p>Phone: 1-800-YOURSHOP (1-800-968-7746)</p>
                <p>Follow us on social media for the latest updates, promotions, and customer reviews!</p>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#">Facebook</a></li>
                    <li class="list-inline-item"><a href="#">Instagram</a></li>
                    <li class="list-inline-item"><a href="#">Twitter</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<?php
require_once("../../theme/footer.php"); 
?>