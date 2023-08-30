<?php
session_start();
require_once("connect/connectDB.php");

$user_id = '';
$user = [];

if (isset($_SESSION["auth_user"])) {
  $user_id = $_SESSION["auth_user"]["user_id"];

  $user = executeSingleResult("SELECT * FROM tb_user where user_id = $user_id");
  $username = $user["username"];
  $phone = $user["phone"];
  $email = $user["email"];
}


?>

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
              <p class="text"><span class="example1"><img class="img-fluid" src="public/frontend/assets/img/icons/phone.png" alt="" /><span style="font-size: 12pt;"><span style="color: #0000ff;">Contact Hotline : 0707 364 628 </span> | <span style="color: #0000ff;">
                      090 77 33 229</span>&nbsp;</span><span style="font-size: 12pt;"></span></p>
              <p class="text"> <span style="color: #0000ff;"> Direct message with a consultant
                  (www.facebook.com/NgocNhiBakery.2022) </span> </p>
              <p class="label"><span style="color: #993300; font-size: 12pt;"><strong>Headquarters:</strong></span></p>
              <p class="text"><img class="img-fluid" src="public/frontend/assets/img/icons/location.png" alt="" />
                <span style="font-size: 12pt;">242/20 Le Dinh Can, Tan Tao Ward, Binh Tan District ,</span>
              </p>
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.6689993332234!2d106.5934355738705!3d10.759973059499387!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752c4fae2d5ea5%3A0x4b305304c9baab94!2zMjQyIEzDqiDEkMOsbmggQ-G6qW4sIFTDom4gVOG6oW8sIELDrG5oIFTDom4sIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1692689484061!5m2!1sen!2s" width="500" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              <hr>
              <p class="text">&nbsp;</p>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-contact">
            <form action="User/supportForm.php" method="post">
              <input type="hidden" name="csrf_test_name" value="3441edce48242ee241352e447f2ea713" />
              <h3 style="text-align: center;"> Support Request Form</h3>
              <div class="form-group">
                <label for="">Fullname : </label>
                <input type="hidden" name="link" value="lien-he">
                <input type="text" class="form-control" name="fullname" required="required" value="<?= ($user_id != null ? $username : '') ?>" placeholder="Your fullname " />
              </div>
              <div class="form-group">
                <label for="">Phone number : </label>
                <input type="text" class="form-control" name="phone" required="required" placeholder="Your Phone Number" value="<?= ($user_id != null ? $phone : '') ?>">
              </div>
              <div class="form-group">
                <label for="">Email Address : </label>
                <input type="email" class="form-control" name="email" required="required" value="<?= ($user_id != null ? $email : '') ?>" placeholder=" Your Email Address">
              </div>
              <div class="form-group">
                <label for="">Comment : </label>
                <textarea name="content" placeholder="Content" required="required" class="form-control"></textarea>
              </div>
              <div class="form-group text-center">
                <button class="btn btn-save-kinhdoanh" type="submit" name="sb-FormSupport"> Submit </button>
              </div>
            </form>
          </div>
        </div>

</section>

<?php if (isset($_SESSION['status'])) { ?>
  <script>
    alert('<?php echo $_SESSION['status']; ?>');
  </script>
<?php
  unset($_SESSION['status']); // Clear the session status after displaying
}
?>

<?php require "layout/footer.php"; ?>