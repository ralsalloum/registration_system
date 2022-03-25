<?php

namespace App\Service;

use App\AutoMapping;
use App\Entity\CourseEntity;
use App\Manager\CourseManager;
use App\Response\CoursesGetResponse;

class CourseService
{
    public function __construct(private AutoMapping $autoMapping, private CourseManager $courseManager)
    {

    }

    public function getAllCoursesForStudent(): array
    {
        $response = [];

        $courses = $this->courseManager->getAllCoursesForStudent();

        if ($courses) {
            // If there are existing courses, then we do two steps:
            foreach ($courses as $index => $value) {
                // First step, we just auto mapping the returned courses to a custom response
                $response[] = $this->autoMapping->map(CourseEntity::class, CoursesGetResponse::class, $value);

                // Second step, check availability
                if ($value->getCapacity() > $value->getRegistrationEntities()->count()) {
                    $response[$index]->availability = true;

                } else {
                    $response[$index]->availability = false;
                }
            }
        }

        return $response;
    }
}
