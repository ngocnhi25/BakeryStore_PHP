<?php 
session_start();
require_once("connect/connectDB.php") ?>
<?php include("layout/header.php"); ?>

<div class="breadcrumb">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
          <a href="home.php" itemprop="item">
            <span itemprop="name">Home</span>
            <meta itemprop="position" content="1" />
          </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
          <a href="ve-chung-toi.php" itemprop="item">
            <span itemprop="name"> About Us </span>
            <meta itemprop="position" content="2" />
          </a>
        </li>
      </ol>
    </nav>
  </div>
</div>
<section class="section-paddingY contact-section">
  <div class="container bg-white mb-0">
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="name-ladding">
            <h3>Welcom to My Bakery</h3>
          </div>
          <div class="card-ladding">
            <div>
              <div class="kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql">
                <div dir="auto">Ngoc Nhi Bakery was born in 1996, during more than 25 years of establishment and development, with unremitting efforts Ngoc Nhi Bakery has brought unforgettable impressions in the hearts of the people of the Capital.
With a variety of flavors and products, Ngoc Nhi Bakery has become an indispensable part of people's spiritual life and successfully brought the essence of French cuisine closer to gourmets. .</div>
              </div>
              <br>
              <div class="cxmmr5t8 oygrvhab hcukyx3x c1et5uql o9v6fnle">
                <div dir="auto">With a variety of flavors and products, Ngoc Nhi Bakery has become an indispensable part of people's spiritual life and successfully brought the essence of French cuisine closer to gourmets.</div>
                <div dir="auto">&nbsp;</div>
                <div dir="auto">Using the freshest ingredients from nature, creating cakes that are safe for health, with standard French flavor.
Preserving and continuing traditional values ​​in a constantly changing modern society.
Constantly trying to improve services, create new product lines, meet the needs of customers.</div>
              <p><img src="../public/images/logo/logo.jpg" width="1000" height="300" /></p>
            </div>
            <div>&nbsp;</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>

<?php include("layout/footer.php"); ?>