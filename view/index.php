<?php
session_start();

require_once "../database.php";
require_once "../model/Student.php";

$student = new Student($conn);
$result = $student->getAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PSP Student Portal</title>

    <link rel="stylesheet" href="../css/style.css">

    <style>

        /* =========================================
           INDEX / DASHBOARD PAGE
           ========================================= */

        .dashboard-page {
            width: min(1200px, 92%);
            margin: auto;
            padding: 45px 0;
        }


        /* =========================================
           TOP BAR
           ========================================= */

        .dashboard-topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 35px;
        }

        .portal-label {
            color: #a78bfa;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 3px;
            margin-bottom: 8px;
        }

        .dashboard-title {
            margin: 0;
            color: white;
            font-size: 38px;
            font-weight: 800;
        }

        .dashboard-subtitle {
            margin-top: 8px;
            margin-bottom: 0;
            color: #a1a1aa;
            font-size: 15px;
        }


        /* =========================================
           TOP ACTIONS
           ========================================= */

        .dashboard-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .dashboard-button {
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            transition: 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .add-button {
            color: white;
            background: linear-gradient(
                135deg,
                #8b5cf6,
                #6d28d9
            );
            box-shadow:
                0 8px 25px rgba(139, 92, 246, 0.25);
        }

        .add-button:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow:
                0 12px 30px rgba(139, 92, 246, 0.45);
        }

        .login-button {
            color: #c4b5fd;
            border: 1px solid rgba(139, 92, 246, 0.4);
            background: rgba(139, 92, 246, 0.06);
        }

        .login-button:hover {
            color: white;
            background: #7c3aed;
            transform: translateY(-2px);
        }


        /* =========================================
           STAT CARDS
           ========================================= */

        .dashboard-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
    margin-bottom: 30px;
    }

    .stat-icon {
    width: 38px;
    height: 38px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background:
        rgba(139, 92, 246, 0.12);

    color: #a78bfa;

    font-size: 18px;

    margin-bottom: 12px;
    }
        .stat-card:hover {
            transform: translateY(-4px);

            border-color:
                rgba(139, 92, 246, 0.45);

            box-shadow:
                0 20px 45px rgba(0, 0, 0, 0.5),
                0 0 25px rgba(139, 92, 246, 0.08);
        }

        .stat-card::after {
            content: "";

            position: absolute;

            width: 100px;
            height: 100px;

            background: rgba(139, 92, 246, 0.12);

            filter: blur(45px);

            right: -30px;
            top: -30px;

            pointer-events: none;
        }

        .stat-icon {
            width: 42px;
            height: 42px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background:
                rgba(139, 92, 246, 0.12);

            color: #a78bfa;

            font-size: 20px;

            margin-bottom: 18px;
        }

       .stat-number {
    display: block;

    color: white;

    font-size: 27px;

    font-weight: 800;

    margin-bottom: 3px;
}

        .stat-title {
            color: #71717a;

            font-size: 12px;

            text-transform: uppercase;

            letter-spacing: 1.5px;
        }


        /* =========================================
           STUDENT TABLE CARD
           ========================================= */

        .student-section {
            background:
                linear-gradient(
                    145deg,
                    rgba(24, 24, 31, 0.97),
                    rgba(12, 12, 17, 0.97)
                );

            border: 1px solid rgba(139, 92, 246, 0.22);

            border-radius: 22px;

            overflow: hidden;

            box-shadow:
                0 20px 55px rgba(0, 0, 0, 0.45);
        }

        .student-section-header {
            padding: 25px 28px;

            display: flex;

            justify-content: space-between;

            align-items: center;

            border-bottom:
                1px solid rgba(255,255,255,0.07);
        }

        .section-heading {
            margin: 0;

            color: white;

            font-size: 20px;

            font-weight: 700;
        }

        .section-description {
            margin: 5px 0 0;

            color: #71717a;

            font-size: 13px;
        }

        .student-count {
            color: #c4b5fd;

            background:
                rgba(139,92,246,0.1);

            border:
                1px solid rgba(139,92,246,0.2);

            padding: 7px 12px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: 700;
        }


        /* =========================================
           TABLE
           ========================================= */

        .table-wrapper {
            overflow-x: auto;
        }

        .student-table {
            width: 100%;

            border-collapse: collapse;

            min-width: 750px;
        }

        .student-table th {
            text-align: left;

            padding: 16px 20px;

            background:
                rgba(255,255,255,0.025);

            color: #71717a;

            font-size: 10px;

            text-transform: uppercase;

            letter-spacing: 1.5px;

            border-bottom:
                1px solid rgba(255,255,255,0.06);
        }

        .student-table td {
            padding: 18px 20px;

            color: #e4e4e7;

            font-size: 14px;

            border-bottom:
                1px solid rgba(255,255,255,0.055);
        }

        .student-table tbody tr {
            transition: 0.2s ease;
        }

        .student-table tbody tr:hover {
            background:
                rgba(139,92,246,0.045);
        }

        .student-table tbody tr:last-child td {
            border-bottom: none;
        }


        /* =========================================
           ID
           ========================================= */

        .student-id {
            color: #a78bfa;

            font-weight: 700;

            font-size: 13px;
        }


        /* =========================================
           STUDENT NAME
           ========================================= */

        .student-name {
            color: white;

            font-weight: 700;
        }


        /* =========================================
           MARKS
           ========================================= */

        .marks {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            min-width: 45px;

            padding: 6px 9px;

            border-radius: 8px;

            background:
                rgba(139,92,246,0.1);

            color: #c4b5fd;

            font-weight: 700;

            font-size: 12px;
        }


        /* =========================================
           ACTIONS
           ========================================= */

        .action-buttons {
            display: flex;

            gap: 8px;
        }

        .edit-button,
        .delete-button {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            padding: 7px 12px;

            border-radius: 8px;

            font-size: 12px;

            font-weight: 700;

            text-decoration: none;

            transition: 0.2s ease;
        }

        .edit-button {
            color: #c4b5fd;

            border:
                1px solid rgba(139,92,246,0.3);

            background:
                rgba(139,92,246,0.06);
        }

        .edit-button:hover {
            color: white;

            background: #7c3aed;

            transform: translateY(-1px);
        }

        .delete-button {
            color: #fca5a5;

            border:
                1px solid rgba(239,68,68,0.25);

            background:
                rgba(239,68,68,0.05);
        }

        .delete-button:hover {
            color: white;

            background: #dc2626;

            transform: translateY(-1px);
        }


        /* =========================================
           EMPTY STATE
           ========================================= */

        .empty-state {
            padding: 60px 20px;

            text-align: center;

            color: #71717a;
        }

        .empty-icon {
            font-size: 35px;

            margin-bottom: 10px;
        }


        /* =========================================
           FOOTER
           ========================================= */

        .dashboard-footer {
            text-align: center;

            color: #52525b;

            font-size: 12px;

            margin-top: 25px;
        }

        .dashboard-footer span {
            color: #8b5cf6;

            margin: 0 6px;
        }


        /* =========================================
           MOBILE
           ========================================= */

        @media (max-width: 800px) {

            .dashboard-page {
                width: 94%;

                padding: 30px 0;
            }

            .dashboard-topbar {
                flex-direction: column;

                align-items: flex-start;
            }

            .dashboard-title {
                font-size: 30px;
            }

            .dashboard-actions {
                width: 100%;
            }

            .dashboard-button {
                flex: 1;

                justify-content: center;
            }

            .dashboard-stats {
                grid-template-columns: 1fr;
            }

            .student-section-header {
                align-items: flex-start;

                gap: 15px;

                flex-direction: column;
            }
        }

    </style>

</head>

<body>

<div class="dashboard-page">


    <!-- =========================================
         HEADER
         ========================================= -->

    <div class="dashboard-topbar">

        <div>

            <div class="portal-label">
                PSP • STUDENT MANAGEMENT SYSTEM
            </div>

            <h1 class="dashboard-title">
                Student Portal
            </h1>

            <p class="dashboard-subtitle">
                Manage student records from one place.
            </p>

        </div>


        <div class="dashboard-actions">

            <a
                href="create.php"
                class="dashboard-button add-button"
            >
                + Add Student
            </a>

            <a
                href="login.php"
                class="dashboard-button login-button"
            >
                Student Login
            </a>

        </div>

    </div>


    <!-- =========================================
         STATISTICS
         ========================================= -->

    <?php

        $studentCount = 0;

        if ($result) {

            $studentCount = $result->num_rows;

        }

    ?>

    <div class="dashboard-stats">


        <div class="stat-card">

            <div class="stat-icon">
                👥
            </div>

            <span class="stat-number">
                <?= $studentCount ?>
            </span>

            <span class="stat-title">
                Total Students
            </span>

        </div>


        <div class="stat-card">

            <div class="stat-icon">
                🎓
            </div>

            <span class="stat-number">
                DIT
            </span>

            <span class="stat-title">
                Main Programme
            </span>

        </div>


        <div class="stat-card">

            <div class="stat-icon">
                ●
            </div>

            <span class="stat-number">
                Active
            </span>

            <span class="stat-title">
                Portal Status
            </span>

        </div>

    </div>


    <!-- =========================================
         STUDENT TABLE
         ========================================= -->

    <div class="student-section">


        <div class="student-section-header">

            <div>

                <h2 class="section-heading">
                    Student Records
                </h2>

                <p class="section-description">
                    View and manage registered students.
                </p>

            </div>


            <div class="student-count">

                <?= $studentCount ?> Students

            </div>

        </div>


        <div class="table-wrapper">

            <table class="student-table">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Name</th>

                        <th>IC</th>

                        <th>Programme</th>

                        <th>Marks</th>

                        <th>Action</th>

                    </tr>

                </thead>


                <tbody>

                <?php if ($studentCount > 0): ?>

                    <?php while ($row = $result->fetch_assoc()) { ?>

                        <tr>

                            <td>

                                <span class="student-id">

                                    #<?= htmlspecialchars($row["id"]) ?>

                                </span>

                            </td>


                            <td>

                                <span class="student-name">

                                    <?= htmlspecialchars($row["name"]) ?>

                                </span>

                            </td>


                            <td>

                                <?= htmlspecialchars($row["ic"]) ?>

                            </td>


                            <td>

                                <?= htmlspecialchars($row["program"]) ?>

                            </td>


                            <td>

                                <span class="marks">

                                    <?= htmlspecialchars($row["marks"]) ?>

                                </span>

                            </td>


                            <td>

                                <div class="action-buttons">

                                    <a
                                        href="edit.php?id=<?= $row["id"] ?>"
                                        class="edit-button"
                                    >
                                        Edit
                                    </a>


                                    <a
                                        href="../controller/Studentcontroller.php?action=delete&id=<?= $row["id"] ?>"
                                        class="delete-button"
                                        onclick="return confirm('Are you sure you want to delete this student?')"
                                    >
                                        Delete
                                    </a>

                                </div>

                            </td>

                        </tr>

                    <?php } ?>

                <?php else: ?>

                    <tr>

                        <td colspan="6">

                            <div class="empty-state">

                                <div class="empty-icon">
                                    👤
                                </div>

                                No students found.

                            </div>

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>


    <!-- =========================================
         FOOTER
         ========================================= -->

    <div class="dashboard-footer">

        PSP Student Portal

        <span>•</span>

        Student Management System

    </div>


</div>

</body>

</html>