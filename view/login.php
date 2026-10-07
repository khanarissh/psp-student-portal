<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Login | PSP Student Portal</title>

    <link rel="stylesheet" href="../css/style.css">

    <style>

        /* =========================================
           LOGIN PAGE
           ========================================= */

        .login-page {
            min-height: 100vh;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 30px;

            position: relative;

            overflow: hidden;
        }


        /* =========================================
           BACKGROUND GLOW
           ========================================= */

        .login-page::before {
            content: "";

            position: fixed;

            width: 500px;
            height: 500px;

            background:
                rgba(139, 92, 246, 0.14);

            filter: blur(120px);

            top: -250px;
            left: -150px;

            pointer-events: none;
        }

        .login-page::after {
            content: "";

            position: fixed;

            width: 450px;
            height: 450px;

            background:
                rgba(109, 40, 217, 0.10);

            filter: blur(120px);

            bottom: -250px;
            right: -150px;

            pointer-events: none;
        }


        /* =========================================
           LOGIN CONTAINER
           ========================================= */

        .login-container {
            width: min(900px, 100%);

            display: grid;

            grid-template-columns: 0.9fr 1.1fr;

            background:
                linear-gradient(
                    145deg,
                    rgba(25, 25, 33, 0.97),
                    rgba(12, 12, 17, 0.98)
                );

            border:
                1px solid rgba(139, 92, 246, 0.25);

            border-radius: 24px;

            overflow: hidden;

            box-shadow:
                0 30px 80px rgba(0,0,0,0.65),
                0 0 50px rgba(139,92,246,0.08);

            position: relative;

            z-index: 1;
        }


        /* =========================================
           LEFT SIDE
           ========================================= */

        .login-brand {
            padding: 50px 40px;

            background:
                linear-gradient(
                    145deg,
                    rgba(139,92,246,0.15),
                    rgba(15,15,20,0.2)
                );

            border-right:
                1px solid rgba(255,255,255,0.07);

            display: flex;

            flex-direction: column;

            justify-content: center;

            position: relative;
        }

        .login-brand::before {
            content: "";

            position: absolute;

            width: 200px;
            height: 200px;

            background:
                rgba(139,92,246,0.18);

            filter: blur(70px);

            top: -80px;
            left: -80px;
        }


        .brand-small {
            color: #a78bfa;

            font-size: 11px;

            font-weight: 700;

            letter-spacing: 3px;

            margin-bottom: 15px;

            position: relative;
        }


        .brand-title {
            color: white;

            font-size: 42px;

            line-height: 1.05;

            font-weight: 800;

            margin: 0;

            position: relative;
        }


        .brand-title span {
            color: #a78bfa;
        }


        .brand-description {
            color: #a1a1aa;

            line-height: 1.7;

            font-size: 14px;

            margin-top: 18px;

            max-width: 300px;

            position: relative;
        }


        .brand-line {
            width: 55px;

            height: 3px;

            background:
                linear-gradient(
                    90deg,
                    #8b5cf6,
                    #a78bfa
                );

            border-radius: 10px;

            margin-top: 25px;
        }


        /* =========================================
           RIGHT LOGIN SIDE
           ========================================= */

        .login-form-section {
            padding: 50px 45px;
        }


        .login-heading {
            color: white;

            font-size: 28px;

            font-weight: 800;

            margin: 0 0 7px;
        }


        .login-subheading {
            color: #71717a;

            font-size: 14px;

            margin-bottom: 30px;
        }


        /* =========================================
           ERROR
           ========================================= */

        .login-error {
            display: flex;

            align-items: center;

            gap: 10px;

            padding: 13px 15px;

            margin-bottom: 22px;

            border-radius: 11px;

            background:
                rgba(239,68,68,0.08);

            border:
                1px solid rgba(239,68,68,0.25);

            color: #fca5a5;

            font-size: 13px;
        }


        .error-icon {
            width: 23px;
            height: 23px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background:
                rgba(239,68,68,0.12);

            font-weight: 700;
        }


        /* =========================================
           FORM
           ========================================= */

        .login-field {
            margin-bottom: 21px;
        }


        .login-field label {
            display: block;

            color: #d4d4d8;

            font-size: 13px;

            font-weight: 600;

            margin-bottom: 8px;
        }


        .login-field input {
            width: 100%;

            padding: 13px 15px;

            border-radius: 10px;

            border:
                1px solid #30303a;

            background:
                #0e0e13;

            color: white;

            font-size: 14px;

            outline: none;

            transition: 0.25s ease;
        }


        .login-field input::placeholder {
            color: #52525b;
        }


        .login-field input:focus {
            border-color:
                #8b5cf6;

            box-shadow:
                0 0 0 3px rgba(139,92,246,0.10);

            background:
                #111116;
        }


        /* =========================================
           LOGIN BUTTON
           ========================================= */

        .login-submit {
            width: 100%;

            border: none;

            border-radius: 10px;

            padding: 13px;

            margin-top: 5px;

            background:
                linear-gradient(
                    135deg,
                    #8b5cf6,
                    #6d28d9
                );

            color: white;

            font-size: 14px;

            font-weight: 700;

            cursor: pointer;

            box-shadow:
                0 8px 25px rgba(139,92,246,0.22);

            transition: 0.25s ease;
        }


        .login-submit:hover {
            transform: translateY(-2px);

            box-shadow:
                0 12px 30px rgba(139,92,246,0.42);
        }


        /* =========================================
           BACK BUTTON
           ========================================= */

        .back-button {
            display: flex;

            justify-content: center;

            align-items: center;

            width: 100%;

            padding: 12px;

            margin-top: 10px;

            border-radius: 10px;

            border:
                1px solid rgba(255,255,255,0.08);

            background:
                rgba(255,255,255,0.025);

            color: #a1a1aa;

            font-size: 13px;

            font-weight: 600;

            text-decoration: none;

            transition: 0.25s ease;
        }


        .back-button:hover {
            color: white;

            border-color:
                rgba(139,92,246,0.35);

            background:
                rgba(139,92,246,0.06);
        }


        /* =========================================
           FOOTER
           ========================================= */

        .login-footer {
            text-align: center;

            color: #52525b;

            font-size: 11px;

            margin-top: 22px;
        }


        /* =========================================
           MOBILE
           ========================================= */

        @media (max-width: 750px) {

            .login-page {
                padding: 20px;
            }

            .login-container {
                grid-template-columns: 1fr;
            }

            .login-brand {
                padding: 35px 30px;

                border-right: none;

                border-bottom:
                    1px solid rgba(255,255,255,0.07);
            }

            .brand-title {
                font-size: 32px;
            }

            .brand-description {
                max-width: none;
            }

            .login-form-section {
                padding: 35px 30px;
            }

        }

    </style>

</head>


<body>


<div class="login-page">


    <div class="login-container">


        <!-- =====================================
             BRANDING
             ===================================== -->

        <div class="login-brand">

            <div class="brand-small">
                PSP • STUDENT PORTAL
            </div>

            <h1 class="brand-title">
                Welcome<br>
                <span>Back.</span>
            </h1>

            <p class="brand-description">
                Access your student profile,
                manage your information and
                keep your academic records up to date.
            </p>

            <div class="brand-line"></div>

        </div>


        <!-- =====================================
             LOGIN FORM
             ===================================== -->

        <div class="login-form-section">

            <h2 class="login-heading">
                Student Login
            </h2>

            <p class="login-subheading">
                Sign in to access your student account.
            </p>


            <?php if (isset($_GET["error"])) { ?>

                <div class="login-error">

                    <span class="error-icon">
                        !
                    </span>

                    <span>
                        Invalid IC or password.
                    </span>

                </div>

            <?php } ?>


            <form
                action="../controller/Studentcontroller.php"
                method="POST"
            >

                <input
                    type="hidden"
                    name="action"
                    value="login"
                >


                <!-- IC -->

                <div class="login-field">

                    <label for="ic">
                        IC Number
                    </label>

                    <input
                        type="text"
                        id="ic"
                        name="ic"
                        placeholder="Enter your IC number"
                        required
                    >

                </div>


                <!-- PASSWORD -->

                <div class="login-field">

                    <label for="password">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                    >

                </div>


                <!-- LOGIN -->

                <button
                    type="submit"
                    class="login-submit"
                >
                    Login to Portal
                </button>


                <!-- BACK -->

                <a
                    href="index.php"
                    class="back-button"
                >
                    ← Back to Student Portal
                </a>

            </form>


            <div class="login-footer">

                PSP Student Management System

            </div>

        </div>

    </div>

</div>


</body>

</html>