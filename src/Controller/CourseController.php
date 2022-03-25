<?php

namespace App\Controller;

use App\Service\CourseService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route(path: 'v1/courses/')]
class CourseController extends BaseController
{
    public function __construct(SerializerInterface $serializer, private CourseService $courseService)
    {
        parent::__construct($serializer);
    }

    #[Route(path: 'courses', name: 'getAllCoursesForSignedInUser', methods: 'GET')]
    #[IsGranted('ROLE_STUDENT')]
    public function getAllCoursesForStudent(): JsonResponse
    {
        $result = $this->courseService->getAllCoursesForStudent();

        return $this->response($result, self::FETCH);
    }
}
