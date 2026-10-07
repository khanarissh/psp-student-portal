<?php

session_start();

require_once "../database.php";
require_once "../model/Student.php";

// =====================================================
// CHECK LOGIN
// =====================================================

if (!isset($_SESSION['student_id'])) {
    header("Location: ../view/login.php");
    exit;
}


// =====================================================
// CREATE STUDENT MODEL
// =====================================================

$studentModel = new Student($conn);

$studentId = $_SESSION['student_id'];


// =====================================================
// CHECK UPLOAD REQUEST
// =====================================================

if (isset($_POST['upload_profile'])) {

    // -------------------------------------------------
    // CHECK WHETHER FILE WAS SELECTED
    // -------------------------------------------------

    if (!isset($_FILES['profile_picture']) ||
        $_FILES['profile_picture']['error'] === UPLOAD_ERR_NO_FILE) {

        header("Location: ../view/profile.php?error=Please select a profile picture.");
        exit;
    }


    // -------------------------------------------------
    // CHECK UPLOAD ERROR
    // -------------------------------------------------

    if ($_FILES['profile_picture']['error'] !== UPLOAD_ERR_OK) {

        header("Location: ../view/profile.php?error=There was a problem uploading the file.");
        exit;
    }


    // -------------------------------------------------
    // GET FILE INFORMATION
    // -------------------------------------------------

    $file = $_FILES['profile_picture'];

    $fileName = $file['name'];
    $fileTmp = $file['tmp_name'];
    $fileSize = $file['size'];

    $fileExtension = strtolower(
        pathinfo($fileName, PATHINFO_EXTENSION)
    );


    // =================================================
    // ALLOWED FILE TYPES
    // =================================================

    $allowedExtensions = [
        'jpg',
        'jpeg',
        'png'
    ];

    if (!in_array($fileExtension, $allowedExtensions, true)) {

        header(
            "Location: ../view/profile.php?error=Only JPG, JPEG and PNG files are allowed."
        );

        exit;
    }


    // =================================================
    // MAXIMUM FILE SIZE
    // 2 MB
    // =================================================

    $maxFileSize = 2 * 1024 * 1024;

    if ($fileSize > $maxFileSize) {

        header(
            "Location: ../view/profile.php?error=File size must not exceed 2 MB."
        );

        exit;
    }


    // =================================================
    // VERIFY ACTUAL IMAGE FILE
    // =================================================

    $imageInfo = getimagesize($fileTmp);

    if ($imageInfo === false) {

        header(
            "Location: ../view/profile.php?error=The uploaded file is not a valid image."
        );

        exit;
    }


    // =================================================
    // GENERATE UNIQUE FILE NAME
    // =================================================

    $newFileName = 'profile_' . uniqid('', true) . '.' . $fileExtension;


    // =================================================
    // UPLOAD DIRECTORY
    // =================================================

    $uploadDirectory = "../uploads/";


    // Create directory if it does not exist

    if (!is_dir($uploadDirectory)) {

        mkdir($uploadDirectory, 0755, true);
    }


    // =================================================
    // FINAL FILE PATH
    // =================================================

    $destination = $uploadDirectory . $newFileName;


    // =================================================
    // MOVE FILE
    // =================================================

    if (!move_uploaded_file($fileTmp, $destination)) {

        header(
            "Location: ../view/profile.php?error=Unable to save the uploaded file."
        );

        exit;
    }


    // =================================================
    // SAVE FILE NAME INTO DATABASE
    // =================================================

    if ($studentModel->updateProfilePicture(
        $studentId,
        $newFileName
    )) {

        header(
            "Location: ../view/profile.php?success=Profile picture uploaded successfully."
        );

        exit;
    }


    // =================================================
    // DATABASE UPDATE FAILED
    // =================================================

    // Remove uploaded file if database update failed

    if (file_exists($destination)) {
        unlink($destination);
    }

    header(
        "Location: ../view/profile.php?error=Unable to save profile picture information."
    );

    exit;
}


// =====================================================
// INVALID REQUEST
// =====================================================

header("Location: ../view/profile.php");

exit;

?>