<?php

namespace App\Service;

use App\AutoMapping;
use App\Entity\RegistrationEntity;
use App\Manager\RegistrationManager;
use App\Request\CourseRegisterByStudentRequest;
use App\Response\CourseRegisterByStudentResponse;

class RegistrationService
{
    public function __construct(private AutoMapping $autoMapping, private RegistrationManager $registrationManager)
    {

    }

    public function registerStudentInNewCourse(CourseRegisterByStudentRequest $request)
    {
       $registrationResult = $this->registrationManager->registerStudentInNewCourse($request);

       return $this->autoMapping->map(RegistrationEntity::class, CourseRegisterByStudentResponse::class, $registrationResult);
    }
}
