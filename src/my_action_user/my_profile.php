<head>

</head>
<div class="my-profile-page">
    <div class="profile-title">
        <h1>My Profile</h1>
        <p>Manage profile information for account security</p>
    </div>
    <div>
        <form action="" method="post">
            <h2>User Information</h2>
            <div class="form-group">
                <label for="name">Username:</label>
                <input type="text" id="name" name="username" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" readonly>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" readonly>
            </div>
            <div class="form-group">
                <label>Sex:</label>
                <input type="radio" id="male" name="sex" value="male" required> Male
                <input type="radio" id="female" name="sex" value="female" required>Female
                <input type="radio" id="other" name="sex" value="other" required> Other
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit" name="submit-update-inforUser">Submit</button>
            </div>
        </form>
    </div>
</div>