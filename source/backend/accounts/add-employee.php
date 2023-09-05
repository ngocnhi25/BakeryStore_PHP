<?php 
session_start();
require_once("../../connect/connectDB.php");
$id = '';
if (isset($_SESSION["auth_user"])) {
    $user = $_SESSION["auth_user"]; // Retrieve the user data from the session
    if ($user["role"] == 3) { 
        $user_name = $_SESSION["auth_user"]["username"];
        $user_id = $_SESSION["auth_user"]["user_id"];
        $user = executeSingleResult("SELECT * FROM tb_user where user_id = $user_id");
    } else {
        header("location: ../../User/login.php");
    }
} else {
    header("location: ../../User/login.php");
}

?>
<head>
    <style>
        .title-page {
            margin-top: 20px;
            margin-left: 20px;
        }

        .addPro-wapper {
            position: relative;
            width: 650px;
            margin: auto;
        }


        .product-input-box {
            display: flex;
            flex-direction: column;
            position: relative;
            justify-content: space-evenly;
        }

        .product-input-box .product-input {
            display: flex;
            gap: 2rem;
        }

        .input-animation {
            margin-bottom: 25px;
        }

        .input-box {
            position: relative;
            width: 280px;
        }

        .input-box label {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            font-size: 16px;
            color: #504e4e;
            padding: 0 5px;
            pointer-events: none;
            transition: 0.5s;
        }

        .input-box input {
            width: 100%;
            padding: 10px;
            background: #41cb782e;
            border: 1.8px solid rgba(255, 255, 255, 0.3);
            outline: none;
            border-radius: 50px;
            font-size: 16px;
            color: #141212;
            transition: .5s;
            box-shadow: 1px 1px 3px black;
        }

        .input-box input:focus~label,
        .input-box input:valid~label {
            top: -5px;
            left: 18px;
            font-size: 13px;
            background: #1d2b3e;
            color: #0080ff;
            padding: 0 12px;
            border-radius: 5px;
        }

        .input-box input:focus,
        .input-box input:valid {
            border: 1.8px solid #0080ff;
        }

        .ckeditor-box {
            position: relative;
            width: 100%;
            overflow: hidden;
            border-radius: 10px;
            border: 1px solid #504e4e;
        }

        .select-container {
            width: 200px;
            position: relative;
            height: 30px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 1px 1px 3px black;
        }

        .select-box {
            border: none;
            width: 100%;
            padding: 6px 10px 6px 10px;
            color: #000;
            background-color: #96dcd57a;
            font-size: 14px;
        }

        .image-box {
            margin-bottom: 15px;
        }

        .image-box label {
            font-size: 16px;
        }

        .image-box input[type="file"] {
            font-size: 14px;
            border-radius: 50px;
            box-shadow: 1px 1px 3px black;
            width: 200px;
            outline: none;
            margin-left: 10px;
        }

        ::-webkit-file-upload-button {
            background-color: #96dcd57a;
            padding: 8px;
            border: none;
            border-radius: 50px;
            outline: none;
        }

        .error {
            margin-left: 20px;
        }
    </style>
</head>
<div class="my-profile-page">
    <div class="profile-title">
        <h1>Add New Empployee </h1>
        <div>
            <form method="post" action="">
                <div class="addPro-wapper">
                    <div class="profile-form">
                        <div class="product-input">
                            <div class="input-animation">
                                <div class="input-box">
                                    <input id="input-name" type="text" name="username" >
                                    <label for="">Username : </label> <br>
                                </div>
                                <div class="errorName error" style="color: red;"></div>
                            </div>
                            <div class="input-animation">
                                <div class="input-box">
                                    <input id="input-email" type="email" name="email" >
                                    <label for="">Email : </label> <br>
                                </div>
                                <div class="errorEmail error" style="color: red;"></div>
                            </div>
                            <div class="input-animation">
                                <div class="input-box">
                                    <input id="input-salary" type="text" name="salary" >
                                    <label for="">Salary : </label> <br>
                                </div>
                                <div class="errorSalary error" style="color: red;"></div>
                            </div>
                            <div class="input-animation">
                                <div class="input-box">
                                    <input id="input-phone" type="text" name="phone"  >
                                    <label for="">Phone : </label> <br>
                                </div>
                                <div class="errorPhone error" style="color: red;"></div>
                            </div>
                        </div>
                        <div class="input-animation">
                            <div class="input-box">
                                <input id="input-password" type="password" name="password" >
                                <label for="">Password</label> <br>
                            </div>
                            <div class="errorPassword error" style="color: red;"></div>
                        </div>
                        <div class="input-animation">
                            <div class="input-box">
                                <input id="input-Repassword" type="password" name="re-password" >
                                <label for="">Repeat Password</label> <br>
                            </div>
                            <div class="errorRePassword error" style="color: red;"></div>
                        </div>

                    </div>
                </div>
                <button id="submitData" class="submit" type="button" >Submit</button>
            </form>
        </div>
    </div>
</div>



<script type="text/javascript">
    $("#success").hide();
    $("#submitData").click(function(e) {
        e.preventDefault();
        $(document).ready(function() {
            var formData = new FormData();

            formData.append("username", $('#input-name').val());
            formData.append("status", $('#status').val());
            formData.append("phone", $('#input-phone').val());
            formData.append("email", $('#input-email').val());
            formData.append("password", $('#input-password').val());
            formData.append("re-password", $('#input-Repassword').val());
            formData.append("salary", $('#input-salary').val());

            $.ajax({
                type: "POST",
                url: 'handles/addEmp.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res === 'success') {
                        alert("Add new employee successfully ! ")
                        location.reload();
                    }else {
                        var errors = JSON.parse(res);
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                var value = errors[key];
                                $('.' + key).empty().append(value);
                            }
                        }
                    }
                }
            })
        })
    })
</script>