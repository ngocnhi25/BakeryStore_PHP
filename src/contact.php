<?php require_once("connect/connectDB.php") ?>

<?php require "layout/header.php"; ?>

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
          <a href="contact.php" itemprop="item">
            <span itemprop="name">Contact</span>
            <meta itemprop="position" content="2" />
          </a>
        </li>
      </ol>
    </nav>
  </div>
</div>
<section class="section-paddingY contact-section">
  <div class="container">
    <div class="section-body">
      <div class="row">
        <div class="col-md-6">
          <div class="card-contact">
            <div class="header-contact">
              <span>NGOC NHI BAKERY </span>
            </div>
            <div class="body-contact mt-3">
              <p><strong>Receive customer information : </strong></p>
              <p class="text"><span class="example1"><img class="img-fluid" src="public/frontend/assets/img/icons/phone.png" alt="" /><span style="font-size: 12pt;"><span style="color: #0000ff;">Contact Hotline : 0707 364 628 </span> | <span style="color: #0000ff;"> 090 77 33 229</span>&nbsp;</span><span style="font-size: 12pt;"></span></p>
              <p class="text"> <span style="color: #0000ff;" >  Direct message with a consultant (www.facebook.com/NgocNhiBakery.2022)  </span> </p>
              <p class="label"><span style="color: #993300; font-size: 12pt;"><strong>Headquarters:</strong></span></p>
              <p class="text"><img class="img-fluid" src="public/frontend/assets/img/icons/location.png" alt="" />
                <span style="font-size: 12pt;">242/20 Le Dinh Can, Tan Tao Ward, Binh Tan District ,</span>
              </p>
              <hr>
              <p class="text">&nbsp;</p>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-contact">
            <form action="supportForm"  method="post" >
              <input type="hidden" name="csrf_test_name" value="3441edce48242ee241352e447f2ea713" />
              <h3 style="text-align: center;"> Support Request Form</h3>
              <div class="form-group">
                <label for="">Fullname : </label>
                <input type="hidden" name="link" value="lien-he">
                <input type="text" class="form-control" name="fullname" required="required" placeholder="Your fullname " />
              </div>
              <div class="form-group">
                <label for="">Phone number : </label>
                <input type="text" class="form-control" name="phone" placeholder="Your Phone Number " pattern="[0][1-9][0-9]{7,9}" />
              </div>
              <div class="form-group">
                <label for="">Email Address : </label>
                <input type="text" class="form-control" name="email" placeholder=" Your Email Address">
              </div>
              <div class="form-group">
                <label for="">Content : </label>
                <textarea name="message" placeholder="Content" required="required" class="form-control"></textarea>
              </div>
              <div class="form-group text-center">
                <button class="btn btn-save-kinhdoanh" type="submit"> Submit </button>
              </div>
            </form>
          </div>
        </div>

</section>

<?php require "layout/footer.php"; ?>