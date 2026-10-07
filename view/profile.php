<?php
session_start();

if (!isset($_SESSION["student_id"])) {
    header("Location: login.php");
    exit;
}

require_once "../database.php";
require_once "../model/Student.php";

$student = new Student($conn);

$data = $student->getById((int)$_SESSION["student_id"]);

if (!$data) {
    session_destroy();
    header("Location: login.php");
    exit;
}

// =====================================================
// DISPLAY SUCCESS / ERROR MESSAGE
// =====================================================

$success = $_GET["success"] ?? "";
$error = $_GET["error"] ?? "";

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Profile | PSP Student Portal</title>

    <link rel="stylesheet" href="../css/style.css">

    <style>

        /* =========================================
           PROFILE PAGE
           ========================================= */

        .profile-page {
            width: min(1050px, 92%);

            margin: auto;

            padding: 45px 0;
        }


        /* =========================================
           HEADER
           ========================================= */

        .profile-header {
            margin-bottom: 28px;
        }

        .profile-label {
            color: #a78bfa;

            font-size: 11px;

            font-weight: 700;

            letter-spacing: 3px;

            margin-bottom: 8px;
        }

        .profile-header h1 {
            margin: 0;

            color: white;

            font-size: 36px;

            font-weight: 800;
        }

        .profile-header p {
            color: #71717a;

            margin-top: 8px;

            font-size: 14px;
        }


        /* =========================================
           ALERTS
           ========================================= */

        .profile-alert {
            padding: 14px 17px;

            border-radius: 12px;

            margin-bottom: 18px;

            font-size: 13px;

            display: flex;

            align-items: center;

            gap: 10px;
        }

        .profile-success {
            color: #86efac;

            background: rgba(34,197,94,0.08);

            border: 1px solid rgba(34,197,94,0.25);
        }

        .profile-error {
            color: #fca5a5;

            background: rgba(239,68,68,0.08);

            border: 1px solid rgba(239,68,68,0.25);
        }


        /* =========================================
           MAIN PROFILE CARD
           ========================================= */

        .profile-card {
            position: relative;

            overflow: hidden;

            background:
                linear-gradient(
                    145deg,
                    rgba(26,26,34,0.98),
                    rgba(12,12,17,0.98)
                );

            border:
                1px solid rgba(139,92,246,0.25);

            border-radius: 22px;

            box-shadow:
                0 25px 65px rgba(0,0,0,0.55);
        }


        .profile-card::before {
            content: "";

            position: absolute;

            width: 350px;
            height: 350px;

            background:
                rgba(139,92,246,0.11);

            filter: blur(100px);

            right: -150px;
            top: -180px;

            pointer-events: none;
        }


        /* =========================================
           PROFILE TOP
           ========================================= */

        .profile-top {
            position: relative;

            display: flex;

            align-items: center;

            gap: 35px;

            padding: 38px;

            border-bottom:
                1px solid rgba(255,255,255,0.07);
        }


        /* =========================================
           PROFILE IMAGE
           ========================================= */

        .profile-image-area {
            text-align: center;

            min-width: 175px;
        }


        .profile-picture {
            width: 155px;

            height: 155px;

            object-fit: cover;

            border-radius: 50%;

            border: 4px solid #8b5cf6;

            padding: 4px;

            background: #0b0b0f;

            box-shadow:
                0 0 0 6px rgba(139,92,246,0.07),
                0 0 40px rgba(139,92,246,0.35);

            transition: 0.3s ease;
        }


        .profile-picture:hover {
            transform: scale(1.04);

            box-shadow:
                0 0 0 8px rgba(139,92,246,0.10),
                0 0 55px rgba(139,92,246,0.5);
        }


        .profile-placeholder {
            width: 155px;

            height: 155px;

            margin: auto;

            border-radius: 50%;

            border: 2px dashed #8b5cf6;

            background: #111116;

            display: flex;

            align-items: center;

            justify-content: center;

            color: #71717a;

            font-size: 11px;

            font-weight: 700;

            letter-spacing: 1px;
        }


        /* =========================================
           STATUS
           ========================================= */

        .profile-status {
            display: flex;

            justify-content: center;

            align-items: center;

            gap: 7px;

            margin-top: 12px;

            color: #a1a1aa;

            font-size: 11px;
        }


        .status-dot {
            width: 7px;

            height: 7px;

            border-radius: 50%;

            background: #22c55e;

            box-shadow:
                0 0 9px rgba(34,197,94,0.8);
        }


        /* =========================================
           PROFILE INTRO
           ========================================= */

        .profile-intro {
            position: relative;
        }


        .profile-role {
            display: inline-block;

            padding: 5px 9px;

            border-radius: 6px;

            color: #c4b5fd;

            background:
                rgba(139,92,246,0.10);

            border:
                1px solid rgba(139,92,246,0.18);

            font-size: 10px;

            font-weight: 700;

            letter-spacing: 2px;

            margin-bottom: 12px;
        }


        .profile-intro h2 {
            color: white;

            font-size: 29px;

            font-weight: 800;

            margin: 0 0 8px;
        }


        .profile-intro p {
            color: #71717a;

            font-size: 14px;

            margin: 0;
        }


        /* =========================================
           INFORMATION SECTION
           ========================================= */

        .profile-information {
            padding: 30px 38px;
        }


        .section-heading {
            display: flex;

            align-items: center;

            gap: 10px;

            color: white;

            font-size: 17px;

            font-weight: 700;

            margin-bottom: 20px;
        }


        .heading-line {
            width: 4px;

            height: 20px;

            border-radius: 5px;

            background:
                linear-gradient(
                    #8b5cf6,
                    #a78bfa
                );
        }


        .information-grid {
            display: grid;

            grid-template-columns: repeat(2, 1fr);

            gap: 14px;
        }


        .information-box {
            padding: 18px;

            border-radius: 13px;

            background:
                rgba(255,255,255,0.025);

            border:
                1px solid rgba(255,255,255,0.06);

            transition: 0.25s ease;
        }


        .information-box:hover {
            background:
                rgba(139,92,246,0.045);

            border-color:
                rgba(139,92,246,0.3);
        }


        .information-label {
            display: block;

            color: #71717a;

            font-size: 9px;

            font-weight: 700;

            letter-spacing: 2px;

            margin-bottom: 7px;
        }


        .information-value {
            display: block;

            color: #f4f4f5;

            font-size: 14px;

            font-weight: 600;
        }


        .marks-value {
            color: #a78bfa;

            font-size: 19px;
        }


        /* =========================================
           UPLOAD SECTION
           ========================================= */

        .upload-section {
            padding: 0 38px 30px;
        }


        .upload-description {
            color: #71717a;

            font-size: 13px;

            margin-bottom: 16px;
        }


        /* =========================================
           FILE INPUT
           ========================================= */

        .file-input {
            width: 100%;

            padding: 13px;

            border-radius: 11px;

            border:
                1px solid #30303a;

            background: #0e0e13;

            color: #a1a1aa;

            cursor: pointer;
        }


        .file-input:hover {
            border-color:
                rgba(139,92,246,0.5);
        }


        .file-input:focus {
            outline: none;

            border-color: #8b5cf6;

            box-shadow:
                0 0 0 3px rgba(139,92,246,0.10);
        }


        /* =========================================
           FILE HELP
           ========================================= */

        .file-help {
            color: #52525b;

            font-size: 11px;

            margin-top: 8px;
        }


        /* =========================================
           UPLOAD BUTTON
           ========================================= */

        .upload-button {
            margin-top: 16px;

            padding: 12px 20px;

            border: none;

            border-radius: 10px;

            color: white;

            background:
                linear-gradient(
                    135deg,
                    #8b5cf6,
                    #6d28d9
                );

            font-weight: 700;

            font-size: 13px;

            cursor: pointer;

            box-shadow:
                0 7px 22px rgba(139,92,246,0.2);

            transition: 0.25s ease;
        }


        .upload-button:hover {
            transform: translateY(-2px);

            box-shadow:
                0 10px 28px rgba(139,92,246,0.4);
        }


        /* =========================================
           BOTTOM ACTIONS
           ========================================= */

        .profile-actions {
            display: flex;

            gap: 10px;

            padding: 22px 38px 30px;

            border-top:
                1px solid rgba(255,255,255,0.07);
        }


        .password-button,
        .logout-button {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            padding: 11px 17px;

            border-radius: 9px;

            font-size: 13px;

            font-weight: 700;

            text-decoration: none;

            transition: 0.25s ease;
        }


        .password-button {
            color: #c4b5fd;

            background:
                rgba(139,92,246,0.06);

            border:
                1px solid rgba(139,92,246,0.3);
        }


        .password-button:hover {
            color: white;

            background: #7c3aed;

            transform: translateY(-2px);
        }


        .logout-button {
            color: #fca5a5;

            background:
                rgba(239,68,68,0.05);

            border:
                1px solid rgba(239,68,68,0.25);
        }


        .logout-button:hover {
            color: white;

            background: #dc2626;

            transform: translateY(-2px);
        }


        /* =========================================
           FOOTER
           ========================================= */

        .profile-footer {
            text-align: center;

            color: #52525b;

            font-size: 11px;

            margin-top: 20px;
        }


        .profile-footer span {
            color: #8b5cf6;

            margin: 0 6px;
        }


        /* =========================================
           MOBILE
           ========================================= */

        @media (max-width: 700px) {

            .profile-page {
                width: 94%;

                padding: 30px 0;
            }


            .profile-top {
                flex-direction: column;

                text-align: center;

                padding: 30px 22px;
            }


            .profile-intro h2 {
                font-size: 23px;
            }


            .profile-information,
            .upload-section {
                padding-left: 22px;

                padding-right: 22px;
            }


            .information-grid {
                grid-template-columns: 1fr;
            }


            .profile-actions {
                padding-left: 22px;

                padding-right: 22px;

                flex-direction: column;
            }


            .password-button,
            .logout-button {
                width: 100%;
            }

        }

    </style>

</head>


<body>


<div class="profile-page">


    <!-- =========================================
         HEADER
         ========================================= -->

    <div class="profile-header">

        <div class="profile-label">
            PSP • STUDENT PORTAL
        </div>

        <h1>
            My Profile
        </h1>

        <p>
            View your student information and manage your profile.
        </p>

    </div>


    <!-- =========================================
         SUCCESS MESSAGE
         ========================================= -->

    <?php if (!empty($success)): ?>

        <div class="profile-alert profile-success">

            ✓

            <?= htmlspecialchars($success) ?>

        </div>

    <?php endif; ?>


    <!-- =========================================
         ERROR MESSAGE
         ========================================= -->

    <?php if (!empty($error)): ?>

        <div class="profile-alert profile-error">

            !

            <?= htmlspecialchars($error) ?>

        </div>

    <?php endif; ?>


    <!-- =========================================
         PROFILE CARD
         ========================================= -->

    <div class="profile-card">


        <!-- =====================================
             PROFILE HEADER
             ====================================== -->

        <div class="profile-top">


            <div class="profile-image-area">

                <?php if (!empty($data["profile_picture"])): ?>

                    <img
                        src="../uploads/<?= htmlspecialchars($data["profile_picture"]) ?>"
                        alt="Profile Picture"
                        class="profile-picture"
                    >

                <?php else: ?>

                    <div class="profile-placeholder">

                        NO IMAGE

                    </div>

                <?php endif; ?>


                <div class="profile-status">

                    <span class="status-dot"></span>

                    Active Student

                </div>

            </div>


            <div class="profile-intro">

                <div class="profile-role">
                    STUDENT
                </div>

                <h2>
                    <?= htmlspecialchars($data["name"]) ?>
                </h2>

                <p>
                    <?= htmlspecialchars($data["program"]) ?>
                </p>

            </div>

        </div>


        <!-- =====================================
             STUDENT INFORMATION
             ====================================== -->

        <div class="profile-information">

            <div class="section-heading">

                <span class="heading-line"></span>

                Student Information

            </div>


            <div class="information-grid">


                <div class="information-box">

                    <span class="information-label">
                        FULL NAME
                    </span>

                    <span class="information-value">
                        <?= htmlspecialchars($data["name"]) ?>
                    </span>

                </div>


                <div class="information-box">

                    <span class="information-label">
                        IC / NRIC
                    </span>

                    <span class="information-value">
                        <?= htmlspecialchars($data["ic"]) ?>
                    </span>

                </div>


                <div class="information-box">

                    <span class="information-label">
                        PROGRAMME
                    </span>

                    <span class="information-value">
                        <?= htmlspecialchars($data["program"]) ?>
                    </span>

                </div>


                <div class="information-box">

                    <span class="information-label">
                        MARKS
                    </span>

                    <span class="information-value marks-value">
                        <?= htmlspecialchars($data["marks"]) ?>
                    </span>

                </div>


            </div>

        </div>


        <!-- =====================================
             PROFILE PICTURE UPLOAD
             ====================================== -->

        <div class="upload-section">

            <div class="section-heading">

                <span class="heading-line"></span>

                Profile Picture

            </div>


            <div class="upload-description">

                Update your profile picture using JPG, JPEG or PNG.

            </div>


            <form
                action="../controller/profileController.php"
                method="POST"
                enctype="multipart/form-data"
            >

                <input
                    type="file"
                    name="profile_picture"
                    id="profile_picture"
                    class="file-input"
                    accept=".jpg,.jpeg,.png"
                    required
                >


                <div class="file-help">

                    Maximum file size: 2 MB

                </div>


                <button
                    type="submit"
                    name="upload_profile"
                    class="upload-button"
                >

                    Upload Profile Picture →

                </button>

            </form>

        </div>


        <!-- =====================================
             ACTION BUTTONS
             ====================================== -->

        <div class="profile-actions">


            <a
                href="password.php"
                class="password-button"
            >

                🔐 Change Password

            </a>


            <a
                href="../controller/Studentcontroller.php?action=logout"
                class="logout-button"
            >

                Logout

            </a>


        </div>


    </div>


    <!-- =========================================
         FOOTER
         ========================================= -->

    <div class="profile-footer">

        PSP Student Portal

        <span>•</span>

        Student Management System

    </div>


</div>


</body>

</html>