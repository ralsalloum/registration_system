<?php

namespace App\Manager;

use App\AutoMapping;
use App\Entity\RegistrationEntity;
use App\Request\CourseRegisterByStudentRequest;
use Doctrine\ORM\EntityManagerInterface;

class RegistrationManager
{
    public function __construct(private AutoMapping $autoMapping, private EntityManagerInterface $entityManager, private StudentManager $studentManager,
                                private CourseManager $courseManager)
    {

    }

    public function registerStudentInNewCourse(CourseRegisterByStudentRequest $request)
    {
        // First, get student and course entities using their IDs
        $student = $this->studentManager->getStudentByUserId($request->getStudentUserId());
        $course = $this->courseManager->getCourseById($request->getCourseId());

        // Then, do auto mapping between create request and registration entity
        $registrationEntity = $this->autoMapping->map(CourseRegisterByStudentRequest::class, RegistrationEntity::class, $request);

        // Thirdly, set both student and course of the new initiated registration entity
        $registrationEntity->setStudent($student);
        $registrationEntity->setCourse($course);

        $this->entityManager->persist($registrationEntity);
        $this->entityManager->flush();

        return $registrationEntity;
    }
}
