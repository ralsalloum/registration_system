<?php

namespace App\Manager;

use App\Entity\CourseEntity;
use App\Repository\CourseEntityRepository;

class CourseManager
{
//    private CourseEntityRepository $courseEntityRepository;

    public function __construct(private CourseEntityRepository $courseEntityRepository)
    {
    }

    public function getAllCoursesForStudent(): array
    {
        return $this->courseEntityRepository->findAll();
    }

    public function getCourseById(int $courseId): ?CourseEntity
    {
        return $this->courseEntityRepository->find($courseId);
    }
}
