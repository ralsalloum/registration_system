<?php

namespace App\Request;

class CourseRegisterByStudentRequest
{
    private int $studentUserId;

    private int $courseId;

    public function setStudentUserId(int $studentUserId): void
    {
        $this->studentUserId = $studentUserId;
    }

    public function getCourseId(): int
    {
        return $this->courseId;
    }

    public function getStudentUserId(): int
    {
        return $this->studentUserId;
    }
}
