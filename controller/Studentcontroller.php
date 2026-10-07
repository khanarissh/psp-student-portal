<?php
session_start();
require_once "../database.php";
require_once "../model/Student.php";

$student = new Student($conn);

if (isset($_GET["action"])) {
    $action = $_GET["action"];

    if ($action == "delete" && isset($_GET["id"])) {
        $student->delete((int)$_GET["id"]);
        header("Location: ../view/index.php");
        exit;
    }

    if ($action == "logout") {
        session_destroy();
        header("Location: ../view/login.php");
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];

    if ($action == "create") {
        $name = trim($_POST["name"]);
        $ic = trim($_POST["ic"]);
        $program = trim($_POST["program"]);
        $marks = (int)$_POST["marks"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $student->create($name, $ic, $program, $marks, $password);
        header("Location: ../view/index.php");
        exit;
    }

    if ($action == "update") {
        $id = (int)$_POST["id"];
        $name = trim($_POST["name"]);
        $ic = trim($_POST["ic"]);
        $program = trim($_POST["program"]);
        $marks = (int)$_POST["marks"];

        $student->update($id, $name, $ic, $program, $marks);
        header("Location: ../view/index.php");
        exit;
    }

    if ($action == "login") {
        $ic = trim($_POST["ic"]);
        $password = $_POST["password"];

        $data = $student->getByIc($ic);

        if ($data && password_verify($password, $data["password"])) {
            $_SESSION["student_id"] = $data["id"];
            header("Location: ../view/profile.php");
            exit;
        } else {
            header("Location: ../view/login.php?error=1");
            exit;
        }
    }

    if ($action == "change_password") {
        if (!isset($_SESSION["student_id"])) {
            header("Location: ../view/login.php");
            exit;
        }

        $id = (int)$_SESSION["student_id"];
        $data = $student->getById($id);

        $oldPassword = $_POST["old_password"];
        $newPassword = $_POST["new_password"];
        $confirmPassword = $_POST["confirm_password"];

        if (!password_verify($oldPassword, $data["password"])) {
            header("Location: ../view/password.php?error=old");
            exit;
        }

        if ($newPassword != $confirmPassword) {
            header("Location: ../view/password.php?error=match");
            exit;
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $student->updatePassword($id, $hashedPassword);

        header("Location: ../view/password.php?success=1");
        exit;
    }
}
?>