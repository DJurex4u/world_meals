<?php


namespace App\Controller;

use App\Repository\MealRepository;
use Doctrine\Common\Collections\ArrayCollection;
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
        $id = $request->get('id');
        $meals = $this->mealRepository->findBy(['id' => 2]);
//        var_dump($meal); die();
//        $meal = $this->mealRepository->findOneBy(['id' => 2]);
//        $data = $meal->toArray($locale);
        $data = new ArrayCollection();
        foreach ($meals as $meal )
        {
            $newElement = $meal->toArray($locale);
            $data->add($newElement);
        }

        $response = new JsonResponse($data->toArray(), Response::HTTP_OK);
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