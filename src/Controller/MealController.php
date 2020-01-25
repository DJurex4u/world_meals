<?php


namespace App\Controller;

use App\Repository\MealRepository;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class MealController extends AbstractController implements TranslatableInterface
{
    use TranslatableTrait;
    private $mealRepository;
    public function __construct(MealRepository $repository)
    {
        $this->mealRepository = $repository;
    }

    /**
     * @Route("/", name="meals", methods={"GET"})
     * @return JsonResponse
     */
    public function showMealAction(Request $request): JsonResponse
    {
        $locale = $request->get('lang');
        $meal = $this->mealRepository->findOneBy(['id' => 2]);
        $data = $meal->toArray($locale);

        $response = new JsonResponse($data, Response::HTTP_OK);
        $response->setEncodingOptions($response->getEncodingOptions()|JSON_PRETTY_PRINT);
        return $response;
    }

//    /**
//     * @Route("/hello", name="proba")
//     */
//    public function proba(Request $request)
//    {
//        $data = $request->get('i');
//        //return new Response('<html><body>HELLO {{$i}}</body></html>');
//    }
}