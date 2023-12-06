<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <title>Password Form with Visible Icon Button</title>
    <style>
        .password-container {
            position: relative;
        }

        .password-input {
            padding-right: 40px;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 5px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .button {

            border: 2px solid #ff8fab;

            transition-duration: 0.4s;
        }

        .button:hover {
            background-color: #04AA6D;

            color: white;
        }

        .header {
            padding: 10px;
            text-align: center;
            background: #ff8fab;
            color: black;
            font-size: 30px;

        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #ff8fab;
            color: white;
            text-align: center;
        }

        .card {

            max-width: 315px;
            margin: auto;
            text-align: center;
            font-family: arial;
            padding: 20px;
            box-shadow: 0 0px 20px 0 rgba(0, 0, 0, 0.2);
            background: #ffe5ec
        }

        input[type=email] {
            width: 100%;
            padding: 10px 20px;
            margin: 1px 0;
            display: inline-block;
            border: 1px solid pink;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=password],
        select {
            width: 100%;
            padding: 10px 20px;
            margin: 1px 0;
            display: inline-block;
            border: 1px solid pink;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=text],
        select {
            width: 100%;
            padding: 10px 20px;
            margin: 1px 0;
            display: inline-block;
            border: 1px solid pink;
            border-radius: 4px;
            box-sizing: border-box;
        }
    </style>
</head>

<body style="background: #ffe5ec;">
    <div class="header">
        <h1>WELCOME TO</h1>
        <p>Creative Unit Production System</p>
    </div>
    <br>

    <div class="container-fluid card" align="center" style="background-color: #f9ccd5;">
        <div style="width: 18rem;">
            <div class="card-body ">

                <h5 class="card-title" style="background:#ff8fab; border: 1px solid #ffe5ec;
            border-radius: 4px; padding: 10px 20px;">Log in</h5>

                <p class="card-text">
                <form align="center" method="post" action="login.php">
                    <label for="emailInput" align="left">Email : </label>
                    <input type="email" id="emailInput" name="emailInput" class="form-control " placeholder="Enter Email" required>

                    <div class="password-container">

                        <br>
                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <label for="inputPassword6" align="left">Password : </label>

                                <input type="password" id="inputPassword6" name="inputPassword6" class="form-control" placeholder="Enter password">
                            </div>
                            <div class="form-row">
                                <input type="checkbox" onclick="myFunction()" id="ShowPassword">
                                <label for="ShowPassword" align="left">Show Password</label>
                            </div>

                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-light">Submit</button>
                </form>
                <br>
                Don't have any account?<a href="signuppage.php">Sign up</a></p>


                </p>

            </div>
        </div>
    </div>

    <div class="footer">
        <br>
        <p>Copyright &copy; 2023 Ana Muslim Sdn Bhd. All rightsreserved.</p>

    </div>

    <script>
        function myFunction() {
            var x = document.getElementById("inputPassword6");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</body>

</html>