<?php
require_once "../database.php";
require_once "../model/Student.php";

$student = new Student($conn);

$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

$data = $student->getById($id);

if (!$data) {
    die("Student not found.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Student | PSP Student Portal</title>

    <link rel="stylesheet" href="../css/style.css">

    <style>

        /* =========================================
           EDIT STUDENT PAGE
           ========================================= */

        .edit-page {
            width: min(950px, 92%);

            margin: auto;

            padding: 45px 0;
        }


        /* =========================================
           HEADER
           ========================================= */

        .edit-header {
            margin-bottom: 28px;
        }

        .edit-label {
            color: #a78bfa;

            font-size: 11px;

            font-weight: 700;

            letter-spacing: 3px;

            margin-bottom: 8px;
        }

        .edit-header h1 {
            color: white;

            font-size: 36px;

            font-weight: 800;

            margin: 0;
        }

        .edit-header p {
            color: #71717a;

            font-size: 14px;

            margin-top: 8px;
        }


        /* =========================================
           MAIN CARD
           ========================================= */

        .edit-card {
            display: grid;

            grid-template-columns: 0.7fr 1.3fr;

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
           LEFT INFORMATION PANEL
           ========================================= */

        .edit-info {
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


        .edit-info::before {
            content: "";

            position: absolute;

            width: 230px;

            height: 230px;

            background:
                rgba(139,92,246,0.15);

            filter: blur(80px);

            top: -100px;

            left: -100px;
        }


        /* =========================================
           ICON
           ========================================= */

        .edit-icon {
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
                1px solid rgba(139,92,246,0.25);

            color: #a78bfa;

            font-size: 25px;

            margin-bottom: 24px;
        }


        .edit-info h2 {
            position: relative;

            color: white;

            font-size: 23px;

            font-weight: 800;

            margin: 0 0 12px;
        }


        .edit-info p {
            position: relative;

            color: #71717a;

            font-size: 13px;

            line-height: 1.7;

            margin: 0;
        }


        /* =========================================
           STUDENT ID
           ========================================= */

        .student-id-box {
            position: relative;

            margin-top: 25px;

            padding-top: 20px;

            border-top:
                1px solid rgba(255,255,255,0.07);
        }


        .student-id-label {
            display: block;

            color: #71717a;

            font-size: 9px;

            letter-spacing: 2px;

            margin-bottom: 6px;
        }


        .student-id-value {
            color: #c4b5fd;

            font-size: 18px;

            font-weight: 800;
        }


        /* =========================================
           FORM SIDE
           ========================================= */

        .edit-form-section {
            padding: 40px;
        }


        .form-title {
            color: white;

            font-size: 22px;

            font-weight: 800;

            margin: 0 0 6px;
        }


        .form-description {
            color: #71717a;

            font-size: 13px;

            margin-bottom: 28px;
        }


        /* =========================================
           FORM GRID
           ========================================= */

        .edit-form {
            display: grid;

            grid-template-columns: repeat(2, 1fr);

            gap: 18px;
        }


        .edit-field {
            display: flex;

            flex-direction: column;
        }


        .edit-field.full-width {
            grid-column: 1 / -1;
        }


        .edit-field label {
            color: #d4d4d8;

            font-size: 13px;

            font-weight: 600;

            margin-bottom: 8px;
        }


        .edit-field input {
            width: 100%;

            padding: 12px 14px;

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


        .edit-field input:focus {
            border-color: #8b5cf6;

            box-shadow:
                0 0 0 3px rgba(139,92,246,0.10);

            background: #111116;
        }


        /* =========================================
           MARKS
           ========================================= */

        .marks-help {
            color: #52525b;

            font-size: 10px;

            margin-top: 6px;
        }


        /* =========================================
           ACTIONS
           ========================================= */

        .edit-actions {
            grid-column: 1 / -1;

            display: flex;

            gap: 10px;

            margin-top: 8px;

            padding-top: 20px;

            border-top:
                1px solid rgba(255,255,255,0.07);
        }


        .update-button {
            flex: 1;

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


        .update-button:hover {
            transform: translateY(-2px);

            box-shadow:
                0 12px 30px rgba(139,92,246,0.4);
        }


        .edit-back {
            flex: 1;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 12px;

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


        .edit-back:hover {
            color: white;

            border-color:
                rgba(139,92,246,0.35);

            background:
                rgba(139,92,246,0.06);
        }


        /* =========================================
           FOOTER
           ========================================= */

        .edit-footer {
            text-align: center;

            color: #52525b;

            font-size: 11px;

            margin-top: 22px;
        }


        /* =========================================
           MOBILE
           ========================================= */

        @media (max-width: 750px) {

            .edit-page {
                width: 94%;

                padding: 30px 0;
            }

            .edit-card {
                grid-template-columns: 1fr;
            }

            .edit-info {
                padding: 32px 25px;

                border-right: none;

                border-bottom:
                    1px solid rgba(255,255,255,0.07);
            }

            .edit-form-section {
                padding: 30px 25px;
            }

            .edit-form {
                grid-template-columns: 1fr;
            }

            .edit-field.full-width {
                grid-column: auto;
            }

            .edit-actions {
                grid-column: auto;

                flex-direction: column;
            }

        }

    </style>

</head>


<body>


<div class="edit-page">


    <!-- =========================================
         HEADER
         ========================================= -->

    <div class="edit-header">

        <div class="edit-label">
            PSP • STUDENT MANAGEMENT
        </div>

        <h1>
            Edit Student
        </h1>

        <p>
            Update the selected student's information.
        </p>

    </div>


    <!-- =========================================
         MAIN CARD
         ========================================= -->

    <div class="edit-card">


        <!-- =====================================
             INFORMATION PANEL
             ====================================== -->

        <div class="edit-info">


            <div class="edit-icon">
                ✎
            </div>


            <h2>
                Update Record
            </h2>


            <p>
                Modify the student's information
                below. Make sure all details are
                accurate before saving.
            </p>


            <div class="student-id-box">

                <span class="student-id-label">
                    STUDENT ID
                </span>

                <span class="student-id-value">
                    #<?= htmlspecialchars($data["id"]) ?>
                </span>

            </div>


        </div>


        <!-- =====================================
             FORM
             ====================================== -->

        <div class="edit-form-section">


            <h2 class="form-title">
                Student Information
            </h2>


            <p class="form-description">
                Update the details for this student record.
            </p>


            <form
                action="../controller/Studentcontroller.php"
                method="POST"
                class="edit-form"
            >


                <input
                    type="hidden"
                    name="action"
                    value="update"
                >


                <input
                    type="hidden"
                    name="id"
                    value="<?= htmlspecialchars($data["id"]) ?>"
                >


                <!-- NAME -->

                <div class="edit-field full-width">

                    <label for="name">
                        Full Name
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="<?= htmlspecialchars($data["name"]) ?>"
                        required
                    >

                </div>


                <!-- IC -->

                <div class="edit-field">

                    <label for="ic">
                        IC Number
                    </label>

                    <input
                        type="text"
                        id="ic"
                        name="ic"
                        value="<?= htmlspecialchars($data["ic"]) ?>"
                        required
                    >

                </div>


                <!-- PROGRAM -->

                <div class="edit-field">

                    <label for="program">
                        Programme
                    </label>

                    <input
                        type="text"
                        id="program"
                        name="program"
                        value="<?= htmlspecialchars($data["program"]) ?>"
                        required
                    >

                </div>


                <!-- MARKS -->

                <div class="edit-field">

                    <label for="marks">
                        Marks
                    </label>

                    <input
                        type="number"
                        id="marks"
                        name="marks"
                        min="0"
                        max="100"
                        value="<?= htmlspecialchars($data["marks"]) ?>"
                        required
                    >

                    <span class="marks-help">
                        Enter a value between 0 and 100.
                    </span>

                </div>


                <!-- ACTIONS -->

                <div class="edit-actions">


                    <button
                        type="submit"
                        class="update-button"
                    >
                        Save Changes
                    </button>


                    <a
                        href="index.php"
                        class="edit-back"
                    >
                        ← Back to Portal
                    </a>


                </div>


            </form>


        </div>

    </div>


    <!-- =========================================
         FOOTER
         ========================================= -->

    <div class="edit-footer">

        PSP Student Portal
        •
        Student Management System

    </div>


</div>


</body>

</html>