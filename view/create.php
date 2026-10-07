<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Student | PSP Student Portal</title>

    <link rel="stylesheet" href="../css/style.css">

    <style>

        /* =========================================
           CREATE STUDENT PAGE
           ========================================= */

        .create-page {
            width: min(950px, 92%);

            margin: auto;

            padding: 45px 0;
        }


        /* =========================================
           HEADER
           ========================================= */

        .create-header {
            margin-bottom: 28px;
        }

        .create-label {
            color: #a78bfa;

            font-size: 11px;

            font-weight: 700;

            letter-spacing: 3px;

            margin-bottom: 8px;
        }

        .create-header h1 {
            color: white;

            font-size: 36px;

            font-weight: 800;

            margin: 0;
        }

        .create-header p {
            color: #71717a;

            font-size: 14px;

            margin-top: 8px;
        }


        /* =========================================
           MAIN CARD
           ========================================= */

        .create-card {
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

        .create-info {
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


        .create-info::before {
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

        .create-icon {
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

            font-size: 28px;

            margin-bottom: 24px;

            box-shadow:
                0 0 30px rgba(139,92,246,0.08);
        }


        .create-info h2 {
            position: relative;

            color: white;

            font-size: 23px;

            font-weight: 800;

            margin: 0 0 12px;
        }


        .create-info p {
            position: relative;

            color: #71717a;

            font-size: 13px;

            line-height: 1.7;

            margin: 0;
        }


        /* =========================================
           INFO POINTS
           ========================================= */

        .create-points {
            position: relative;

            margin-top: 25px;

            padding-top: 20px;

            border-top:
                1px solid rgba(255,255,255,0.07);
        }


        .create-point {
            display: flex;

            align-items: center;

            gap: 9px;

            color: #a1a1aa;

            font-size: 11px;

            margin-bottom: 10px;
        }


        .point-dot {
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

        .create-form-section {
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

        .create-form {
            display: grid;

            grid-template-columns: repeat(2, 1fr);

            gap: 18px;
        }


        .create-field {
            display: flex;

            flex-direction: column;
        }


        .create-field.full-width {
            grid-column: 1 / -1;
        }


        .create-field label {
            color: #d4d4d8;

            font-size: 13px;

            font-weight: 600;

            margin-bottom: 8px;
        }


        .create-field input {
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


        .create-field input::placeholder {
            color: #52525b;
        }


        .create-field input:focus {
            border-color: #8b5cf6;

            box-shadow:
                0 0 0 3px rgba(139,92,246,0.10);

            background: #111116;
        }


        /* =========================================
           MARKS INPUT
           ========================================= */

        .marks-help {
            color: #52525b;

            font-size: 10px;

            margin-top: 6px;
        }


        /* =========================================
           PASSWORD HELP
           ========================================= */

        .password-help {
            color: #52525b;

            font-size: 10px;

            margin-top: 6px;
        }


        /* =========================================
           ACTIONS
           ========================================= */

        .create-actions {
            grid-column: 1 / -1;

            display: flex;

            gap: 10px;

            margin-top: 8px;

            padding-top: 20px;

            border-top:
                1px solid rgba(255,255,255,0.07);
        }


        .create-button {
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


        .create-button:hover {
            transform: translateY(-2px);

            box-shadow:
                0 12px 30px rgba(139,92,246,0.4);
        }


        .create-back {
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


        .create-back:hover {
            color: white;

            border-color:
                rgba(139,92,246,0.35);

            background:
                rgba(139,92,246,0.06);
        }


        /* =========================================
           FOOTER
           ========================================= */

        .create-footer {
            text-align: center;

            color: #52525b;

            font-size: 11px;

            margin-top: 22px;
        }


        /* =========================================
           MOBILE
           ========================================= */

        @media (max-width: 750px) {

            .create-page {
                width: 94%;

                padding: 30px 0;
            }

            .create-card {
                grid-template-columns: 1fr;
            }

            .create-info {
                padding: 32px 25px;

                border-right: none;

                border-bottom:
                    1px solid rgba(255,255,255,0.07);
            }

            .create-form-section {
                padding: 30px 25px;
            }

            .create-form {
                grid-template-columns: 1fr;
            }

            .create-field.full-width {
                grid-column: auto;
            }

            .create-actions {
                grid-column: auto;

                flex-direction: column;
            }

        }

    </style>

</head>


<body>


<div class="create-page">


    <!-- =========================================
         HEADER
         ========================================= -->

    <div class="create-header">

        <div class="create-label">
            PSP • STUDENT MANAGEMENT
        </div>

        <h1>
            Add Student
        </h1>

        <p>
            Create a new student record in the portal.
        </p>

    </div>


    <!-- =========================================
         MAIN CARD
         ========================================= -->

    <div class="create-card">


        <!-- =====================================
             INFORMATION PANEL
             ====================================== -->

        <div class="create-info">


            <div class="create-icon">
                +
            </div>


            <h2>
                New Student
            </h2>


            <p>
                Enter the student's information
                below to create a new account
                in the PSP Student Portal.
            </p>


            <div class="create-points">


                <div class="create-point">

                    <span class="point-dot"></span>

                    Complete all required fields.

                </div>


                <div class="create-point">

                    <span class="point-dot"></span>

                    Marks must be between 0 and 100.

                </div>


                <div class="create-point">

                    <span class="point-dot"></span>

                    Create a secure password.

                </div>


            </div>

        </div>


        <!-- =====================================
             FORM
             ====================================== -->

        <div class="create-form-section">


            <h2 class="form-title">
                Student Information
            </h2>


            <p class="form-description">
                Fill in the details for the new student.
            </p>


            <form
                action="../controller/Studentcontroller.php"
                method="POST"
                class="create-form"
            >


                <input
                    type="hidden"
                    name="action"
                    value="create"
                >


                <!-- NAME -->

                <div class="create-field full-width">

                    <label for="name">
                        Full Name
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Enter student's full name"
                        required
                    >

                </div>


                <!-- IC -->

                <div class="create-field">

                    <label for="ic">
                        IC Number
                    </label>

                    <input
                        type="text"
                        id="ic"
                        name="ic"
                        placeholder="Enter IC number"
                        required
                    >

                </div>


                <!-- PROGRAM -->

                <div class="create-field">

                    <label for="program">
                        Programme
                    </label>

                    <input
                        type="text"
                        id="program"
                        name="program"
                        placeholder="e.g. Diploma in IT"
                        required
                    >

                </div>


                <!-- MARKS -->

                <div class="create-field">

                    <label for="marks">
                        Marks
                    </label>

                    <input
                        type="number"
                        id="marks"
                        name="marks"
                        min="0"
                        max="100"
                        placeholder="0 - 100"
                        required
                    >

                    <span class="marks-help">
                        Enter a value between 0 and 100.
                    </span>

                </div>


                <!-- PASSWORD -->

                <div class="create-field">

                    <label for="password">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Create password"
                        required
                    >

                    <span class="password-help">
                        Use a secure password.
                    </span>

                </div>


                <!-- ACTIONS -->

                <div class="create-actions">


                    <button
                        type="submit"
                        class="create-button"
                    >
                        Create Student
                    </button>


                    <a
                        href="index.php"
                        class="create-back"
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

    <div class="create-footer">

        PSP Student Portal
        •
        Student Management System

    </div>


</div>


</body>

</html>