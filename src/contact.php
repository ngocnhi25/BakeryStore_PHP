<?php require_once("connect/connectDB.php") ?>

<?php require "layout/header.php"; ?>

<div class="breadcrumb">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
          <a href="" itemprop="item">
            <span itemprop="name">Trang chủ</span>
            <meta itemprop="position" content="1" />
          </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
          <a href="lien-he" itemprop="item">
            <span itemprop="name">Liên hệ</span>
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
              <span>Thu Hương Bakery</span>
            </div>
            <div class="body-contact mt-3">
              <p><strong>Tiếp nhận c&aacute;c th&ocirc;ng tin kh&aacute;ch h&agrave;ng</strong></p>
              <p class="text"><span class="example1"><img class="img-fluid" src="public/frontend/assets/img/icons/phone.png" alt="" /><span style="font-size: 12pt;"><span style="color: #0000ff;">090 754 6668</span> | <span style="color: #0000ff;">096 938
                      6611</span>&nbsp;</span><span style="font-size: 12pt;"><a class="ml-4" href="mailto:sales@thuhuongbakery.com.vn"><img class="img-fluid" src="public/frontend/assets/img/icons/mail-contact.png" alt="" /></a></span></span><span class="s1" style="font-size: 14pt; color: #3366ff;"><a style="color: #3366ff;" href="mailto:sales@thuhuongbakery.com.vn"><span class="example1">sales@thuhuongbakery.com.vn</span></a></span></p>
              <p class="label"><span style="color: #993300; font-size: 12pt;"><strong>Trụ sở ch&iacute;nh
                    :</strong></span></p>
              <p class="text"><img class="img-fluid" src="public/frontend/assets/img/icons/location.png" alt="" />
                <span style="font-size: 12pt;">Số 32A, ng&otilde; chợ Nguyễn C&ocirc;ng Trứ &ndash; Phường Phố Huế
                  &ndash; Quận Hai B&agrave; Trưng &ndash; H&agrave; Nội</span>
              </p>
              <p class="text"><img class="img-fluid" src="public/frontend/assets/img/icons/phone.png" alt="" /><span style="font-size: 12pt;">024 3633 0435</span></p>
              <ul>
                <li><span style="color: #800000; font-size: 12pt;"><strong>Hệ Thống Cửa H&agrave;ng</strong></span>
                </li>
              </ul>
              <p class="text"><span style="font-size: 12pt;"><img class="img-fluid" src="public/frontend/assets/img/icons/location.png" alt="" /> 149 Phố Huế - Hai B&agrave; Trưng
                  - H&agrave; Nội&nbsp;<img class="img-fluid" src="public/frontend/assets/img/icons/phone.png" alt="" />024 3663 0435<strong><br /></strong></span></p>
              <p class="text"><span style="font-size: 12pt;"><img class="img-fluid" src="public/frontend/assets/img/icons/location.png" alt="" /> 14 L&yacute; Nam Đế - Ho&agrave;n
                  Kiếm - H&agrave; Nội&nbsp;&nbsp;<img class="img-fluid" src="public/frontend/assets/img/icons/phone.png" alt="" />024 3358 1555</span></p>
              <p class="text"><span style="font-size: 12pt;"><img class="img-fluid" src="public/frontend/assets/img/icons/location.png" alt="" /> 05 L&aacute;ng Hạ - Đống Đa -
                  H&agrave; Nội&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img class="img-fluid" src="public/frontend/assets/img/icons/phone.png" alt="" />024 3152 4123</span></p>
              <p class="text">&nbsp;</p>
              <hr />
              <p class="text"><img src="source/icon/logo%20tag.png" alt="" width="20" height="19" /><span style="color: #ff9900;">&nbsp;<span style="font-size: 12pt;"><a style="color: #ff9900;" href="danh-muc/banh-sinh-nhat">B&aacute;nh Sinh Nhật</a>, <a style="color: #ff9900;" href="danh-muc/banh-sinh-nhat">Địa chỉ mua b&aacute;nh sinh nhật tại H&agrave; Nội</a>, <a style="color: #ff9900;" href="danh-muc/banh-su-kien">B&aacute;nh Sinh Nhật C&ocirc;ng Ty</a>,
                    <a style="color: #ff9900;" href="danh-muc/banh-cho-be">B&aacute;nh Sinh Nhật Cho B&eacute;</a>,
                    <a style="color: #ff9900;" href="danh-muc/banh-sinh-nhat">B&aacute;nh Sinh Nhật
                      Đẹp</a></span></span></p>
              <p class="text">&nbsp;</p>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-contact">
            <form action="dang-ky-kinh-doanh" class="form-horizontal create-product-form jquery-form-submit" method="post" accept-charset="utf-8">
              <input type="hidden" name="csrf_test_name" value="3441edce48242ee241352e447f2ea713" />
              <div class="form-group">
                <label for="">Họ và tên</label>
                <input type="hidden" name="link" value="lien-he">
                <input type="text" class="form-control" name="fullname" required="required" placeholder="Tên của bạn" />
              </div>
              <div class="form-group">
                <label for="">Số điện thoại</label>
                <input type="text" class="form-control" name="phone" placeholder="Số điện thoại của bạn" pattern="[0][1-9][0-9]{7,9}" />
              </div>
              <div class="form-group">
                <label for="">Mô hình kinh doanh</label>
                <input type="text" class="form-control" name="type_bussines" placeholder="Mô hình kinh doanh của bạn">
              </div>
              <div class="form-group">
                <label for="">Địa chỉ email</label>
                <input type="text" class="form-control" name="email" placeholder="Địa chỉ email của bạn">
              </div>
              <div class="form-group">
                <label for="">Nội dung</label>
                <textarea name="message" placeholder="Nội dung" required="required" class="form-control"></textarea>
              </div>
              <div class="form-group text-center">
                <button class="btn btn-save-kinhdoanh" type="submit">Đăng ký kinh doanh</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-12 col-lg-12 mt-5">
          <div class="map">
            <iframe src="maps/embed?pb=!1m18!1m12!1m3!1d3724.459614944495!2d105.84959111398118!3d21.014287986006202!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab8cdb2c4133%3A0x41cb97f653d653f0!2sThu%20Huong%20Bakery!5e0!3m2!1svi!2s!4v1653384066310!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require "layout/footer.php"; ?>