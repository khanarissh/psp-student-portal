<?php
session_start();

if (!isset($_SESSION["student_id"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Change Password | PSP Student Portal</title>

    <link rel="stylesheet" href="../css/style.css">

    <style>

        /* =========================================
           PASSWORD PAGE
           ========================================= */

        .password-page {
            width: min(900px, 92%);

            margin: auto;

            padding: 50px 0;
        }


        /* =========================================
           HEADER
           ========================================= */

        .password-header {
            margin-bottom: 28px;
        }

        .password-label {
            color: #a78bfa;

            font-size: 11px;

            font-weight: 700;

            letter-spacing: 3px;

            margin-bottom: 8px;
        }

        .password-header h1 {
            color: white;

            font-size: 36px;

            font-weight: 800;

            margin: 0;
        }

        .password-header p {
            color: #71717a;

            font-size: 14px;

            margin-top: 8px;
        }


        /* =========================================
           MAIN CARD
           ========================================= */

        .password-card {
            display: grid;

            grid-template-columns: 0.75fr 1.25fr;

            background:
                linear-gradient(
                    145deg,
                    rgba(26,26,34,0.98),
                    rgba(12,12,17,0.98)
                );

            border:
                1px solid rgba(139,92,246,0.25);

            border-radius: 22px;

            overflow: hidden;

            box-shadow:
                0 25px 65px rgba(0,0,0,0.55);
        }


        /* =========================================
           SECURITY SIDE
           ========================================= */

        .security-panel {
            position: relative;

            padding: 40px 32px;

            background:
                linear-gradient(
                    145deg,
                    rgba(139,92,246,0.14),
                    rgba(15,15,20,0.2)
                );

            border-right:
                1px solid rgba(255,255,255,0.07);

            display: flex;

            flex-direction: column;

            justify-content: center;

            overflow: hidden;
        }


        .security-panel::before {
            content: "";

            position: absolute;

            width: 220px;

            height: 220px;

            background:
                rgba(139,92,246,0.16);

            filter: blur(75px);

            top: -100px;

            left: -100px;
        }


        /* =========================================
           LOCK ICON
           ========================================= */

        .security-icon {
            position: relative;

            width: 65px;

            height: 65px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 18px;

            background:
                rgba(139,92,246,0.12);

            border:
                1px solid rgba(139,92,246,0.22);

            color: #a78bfa;

            font-size: 28px;

            margin-bottom: 25px;

            box-shadow:
                0 0 30px rgba(139,92,246,0.08);
        }


        .security-panel h2 {
            position: relative;

            color: white;

            font-size: 24px;

            font-weight: 800;

            margin: 0 0 12px;
        }


        .security-panel p {
            position: relative;

            color: #71717a;

            font-size: 13px;

            line-height: 1.7;

            margin: 0;
        }


        /* =========================================
           SECURITY TIPS
           ========================================= */

        .security-tips {
            position: relative;

            margin-top: 25px;

            padding-top: 20px;

            border-top:
                1px solid rgba(255,255,255,0.07);
        }


        .security-tip {
            display: flex;

            align-items: center;

            gap: 9px;

            color: #a1a1aa;

            font-size: 11px;

            margin-bottom: 9px;
        }


        .tip-dot {
            width: 6px;

            height: 6px;

            flex-shrink: 0;

            border-radius: 50%;

            background: #8b5cf6;

            box-shadow:
                0 0 7px rgba(139,92,246,0.7);
        }


        /* =========================================
           FORM SIDE
           ========================================= */

        .password-form-section {
            padding: 40px;
        }


        .form-heading {
            color: white;

            font-size: 22px;

            font-weight: 800;

            margin: 0 0 6px;
        }


        .form-subheading {
            color: #71717a;

            font-size: 13px;

            margin-bottom: 28px;
        }


        /* =========================================
           ALERTS
           ========================================= */

        .password-alert {
            padding: 13px 15px;

            border-radius: 10px;

            margin-bottom: 18px;

            font-size: 13px;

            display: flex;

            align-items: center;

            gap: 9px;
        }


        .password-error {
            color: #fca5a5;

            background:
                rgba(239,68,68,0.08);

            border:
                1px solid rgba(239,68,68,0.25);
        }


        .password-success {
            color: #86efac;

            background:
                rgba(34,197,94,0.08);

            border:
                1px solid rgba(34,197,94,0.25);
        }


        /* =========================================
           FORM FIELDS
           ========================================= */

        .password-field {
            margin-bottom: 20px;
        }


        .password-field label {
            display: block;

            color: #d4d4d8;

            font-size: 13px;

            font-weight: 600;

            margin-bottom: 8px;
        }


        .password-field input {
            width: 100%;

            padding: 13px 14px;

            background:
                #0e0e13;

            color: white;

            border:
                1px solid #30303a;

            border-radius: 10px;

            font-size: 14px;

            outline: none;

            transition: 0.25s ease;
        }


        .password-field input::placeholder {
            color: #52525b;
        }


        .password-field input:focus {
            border-color: #8b5cf6;

            box-shadow:
                0 0 0 3px rgba(139,92,246,0.10);
        }


        /* =========================================
           BUTTONS
           ========================================= */

        .password-submit {
            width: 100%;

            padding: 13px;

            border: none;

            border-radius: 10px;

            background:
                linear-gradient(
                    135deg,
                    #8b5cf6,
                    #6d28d9
                );

            color: white;

            font-size: 13px;

            font-weight: 700;

            cursor: pointer;

            box-shadow:
                0 8px 24px rgba(139,92,246,0.22);

            transition: 0.25s ease;
        }


        .password-submit:hover {
            transform: translateY(-2px);

            box-shadow:
                0 12px 30px rgba(139,92,246,0.4);
        }


        .password-back {
            display: flex;

            align-items: center;

            justify-content: center;

            width: 100%;

            padding: 11px;

            margin-top: 10px;

            border-radius: 10px;

            border:
                1px solid rgba(255,255,255,0.08);

            background:
                rgba(255,255,255,0.025);

            color: #a1a1aa;

            text-decoration: none;

            font-size: 13px;

            font-weight: 600;

            transition: 0.25s ease;
        }


        .password-back:hover {
            color: white;

            border-color:
                rgba(139,92,246,0.35);

            background:
                rgba(139,92,246,0.06);
        }


        /* =========================================
           FOOTER
           ========================================= */

        .password-footer {
            text-align: center;

            color: #52525b;

            font-size: 11px;

            margin-top: 22px;
        }


        /* =========================================
           MOBILE
           ========================================= */

        @media (max-width: 750px) {

            .password-page {
                width: 94%;

                padding: 30px 0;
            }

            .password-card {
                grid-template-columns: 1fr;
            }

            .security-panel {
                padding: 32px 25px;

                border-right: none;

                border-bottom:
                    1px solid rgba(255,255,255,0.07);
            }

            .password-form-section {
                padding: 30px 25px;
            }

        }

    </style>

</head>


<body>


<div class="password-page">


    <!-- =========================================
         HEADER
         ========================================= -->

    <div class="password-header">

        <div class="password-label">
            PSP • ACCOUNT SECURITY
        </div>

        <h1>
            Change Password
        </h1>

        <p>
            Update your password to keep your student account secure.
        </p>

    </div>


    <!-- =========================================
         PASSWORD CARD
         ========================================= -->

    <div class="password-card">


        <!-- =====================================
             SECURITY INFORMATION
             ====================================== -->

        <div class="security-panel">

            <div class="security-icon">
                🔐
            </div>

            <h2>
                Account Security
            </h2>

            <p>
                Protect your student account by using
                a strong and secure password.
            </p>


            <div class="security-tips">

                <div class="security-tip">

                    <span class="tip-dot"></span>

                    Keep your password private.

                </div>


                <div class="security-tip">

                    <span class="tip-dot"></span>

                    Avoid using easy-to-guess passwords.

                </div>


                <div class="security-tip">

                    <span class="tip-dot"></span>

                    Do not reuse your password elsewhere.

                </div>

            </div>

        </div>


        <!-- =====================================
             PASSWORD FORM
             ====================================== -->

        <div class="password-form-section">

            <h2 class="form-heading">
                Update Password
            </h2>

            <p class="form-subheading">
                Enter your current password and choose a new one.
            </p>


            <!-- OLD PASSWORD ERROR -->

            <?php if (isset($_GET["error"]) && $_GET["error"] == "old") { ?>

                <div class="password-alert password-error">

                    !

                    Old password is incorrect.

                </div>

            <?php } ?>


            <!-- PASSWORD MATCH ERROR -->

            <?php if (isset($_GET["error"]) && $_GET["error"] == "match") { ?>

                <div class="password-alert password-error">

                    !

                    New password and confirm password do not match.

                </div>

            <?php } ?>


            <!-- SUCCESS -->

            <?php if (isset($_GET["success"])) { ?>

                <div class="password-alert password-success">

                    ✓

                    Password updated successfully.

                </div>

            <?php } ?>


            <form
                action="../controller/Studentcontroller.php"
                method="POST"
            >

                <input
                    type="hidden"
                    name="action"
                    value="change_password"
                >


                <!-- OLD PASSWORD -->

                <div class="password-field">

                    <label for="old_password">
                        Current Password
                    </label>

                    <input
                        type="password"
                        id="old_password"
                        name="old_password"
                        placeholder="Enter your current password"
                        required
                    >

                </div>


                <!-- NEW PASSWORD -->

                <div class="password-field">

                    <label for="new_password">
                        New Password
                    </label>

                    <input
                        type="password"
                        id="new_password"
                        name="new_password"
                        placeholder="Enter your new password"
                        required
                    >

                </div>


                <!-- CONFIRM PASSWORD -->

                <div class="password-field">

                    <label for="confirm_password">
                        Confirm New Password
                    </label>

                    <input
                        type="password"
                        id="confirm_password"
                        name="confirm_password"
                        placeholder="Confirm your new password"
                        required
                    >

                </div>


                <!-- UPDATE -->

                <button
                    type="submit"
                    class="password-submit"
                >
                    Update Password
                </button>


                <!-- BACK -->

                <a
                    href="profile.php"
                    class="password-back"
                >
                    ← Back to Profile
                </a>

            </form>

        </div>

    </div>


    <!-- =========================================
         FOOTER
         ========================================= -->

    <div class="password-footer">

        PSP Student Portal
        •
        Account Security

    </div>


</div>


</body>

</html>