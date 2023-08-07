<div class="my-profile-page">
    <div class="profile-title">
        <h1>My Profile</h1>
        <p>Manage profile information for account security</p>
    </div>
    <div class="update-profile-box">
        <div class="profile-form">
            <form action="" method="post" style="width: 100%;">
                <table style="width: 100%;">
                    <tr>
                        <td>Username:</td>
                        <td>
                            <div class="css-input">
                                <input type="text" id="name" name="username">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>
                            <div class="css-input">
                                <input type="email" id="email" name="email">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Phone Number:</td>
                        <td>
                            <div class="css-input">
                                <input type="text" id="phone" name="phone">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Sex:</td>
                        <td>
                            <input type="radio" id="male" name="sex" value="male" required> Male
                            <input type="radio" id="female" name="sex" value="female" required>Female
                            <input type="radio" id="other" name="sex" value="other" required> Other
                        </td>
                    </tr>
                    <tr>
                        <td>Date of Birth:</td>
                        <td><input type="date" id="dob" name="dob" required></td>
                    </tr>
                    <tr>
                        <td>Address:</td>
                        <td>
                            <div class="css-input">
                                <input type="text" name="address" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button class="submit" type="button" name="submit-update-inforUser">Submit</button></td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="profile-update-image">
            <div class="profile-image-box">
                <div class="profile-image">
                    <div id="preview-photo" class="preview-photo">
                        <img src="../public/images/admin2.jpg" alt="">
                    </div>
                    <div class="btn-photo">
                        <input id="photo-profile" type="file" name="profile-image" accept="image/*">
                    </div>
                    <div class="text">
                        <span>Maximum file size 1 MB</span>
                        <span>Format: .JPEG, .PNG, .JPG</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>