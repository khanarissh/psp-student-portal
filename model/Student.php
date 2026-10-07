<?php

require_once "../database.php";

class Student
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // =====================================================
    // GET ALL STUDENTS
    // =====================================================

    public function getAll()
    {
        $sql = "SELECT id, name, ic, program, marks FROM students ORDER BY id DESC";

        return $this->conn->query($sql);
    }


    // =====================================================
    // GET STUDENT BY ID
    // =====================================================

    public function getById($id)
    {
        $stmt = $this->conn->prepare(
            "SELECT id, name, ic, program, marks, password, profile_picture
             FROM students
             WHERE id = ?"
        );

        $stmt->bind_param("i", $id);

        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }


    // =====================================================
    // GET STUDENT BY IC
    // =====================================================

    public function getByIc($ic)
    {
        $stmt = $this->conn->prepare(
            "SELECT *
             FROM students
             WHERE ic = ?"
        );

        $stmt->bind_param("s", $ic);

        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }


    // =====================================================
    // CREATE STUDENT
    // =====================================================

    public function create($name, $ic, $program, $marks, $password)
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO students
            (name, ic, program, marks, password)
            VALUES (?, ?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "sssis",
            $name,
            $ic,
            $program,
            $marks,
            $password
        );

        return $stmt->execute();
    }


    // =====================================================
    // UPDATE STUDENT
    // =====================================================

    public function update($id, $name, $ic, $program, $marks)
    {
        $stmt = $this->conn->prepare(
            "UPDATE students
             SET name = ?, ic = ?, program = ?, marks = ?
             WHERE id = ?"
        );

        $stmt->bind_param(
            "sssii",
            $name,
            $ic,
            $program,
            $marks,
            $id
        );

        return $stmt->execute();
    }


    // =====================================================
    // DELETE STUDENT
    // =====================================================

    public function delete($id)
    {
        $stmt = $this->conn->prepare(
            "DELETE FROM students
             WHERE id = ?"
        );

        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }


    // =====================================================
    // UPDATE PASSWORD
    // =====================================================

    public function updatePassword($id, $password)
    {
        $stmt = $this->conn->prepare(
            "UPDATE students
             SET password = ?
             WHERE id = ?"
        );

        $stmt->bind_param(
            "si",
            $password,
            $id
        );

        return $stmt->execute();
    }


    // =====================================================
    // UPDATE PROFILE PICTURE
    // MINI PROJECT 2
    // =====================================================

    public function updateProfilePicture($id, $filename)
    {
        $stmt = $this->conn->prepare(
            "UPDATE students
             SET profile_picture = ?
             WHERE id = ?"
        );

        $stmt->bind_param(
            "si",
            $filename,
            $id
        );

        return $stmt->execute();
    }
}

?>