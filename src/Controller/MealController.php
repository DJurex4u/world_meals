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
        //TODO: Validation; research bundles

        $locale = $request->get('lang');
        $itemsPerPage = $request->get('per_page');

        $meals = $this->mealRepository->findBy([]);
        $totalItems = count($meals);
        $totalPages = $this->numOfPages($totalItems, $itemsPerPage);
        $currentPage = $request->get('page');

        $allData = new ArrayCollection();
        $meta = array("meta" => array('itemsPerPage' => $itemsPerPage, 'totalItems' => $totalItems, 'totalPages' => $totalPages));
        $allData->add($meta);


        if($itemsPerPage){
            $magic = $currentPage * $itemsPerPage - $itemsPerPage;
            $mealsToBePresented = array_slice($meals, $magic,$itemsPerPage, true);
        }else{
            $mealsToBePresented = $meals;
        }
        $data = new ArrayCollection();
        foreach ($mealsToBePresented as $meal )
        {
            $newElement = $meal->toArray($locale);
            $data->add($newElement);
        }

        $allData->add(array("data" => $data->toArray()));

        $previousLink = $request->getPathInfo();
        $nextLink = '';
        $self= '';
        $p = $request->getQueryString();
//        die($previousLink. '?' .$p);
        $links = array('links'=> array('prev_link' => $previousLink, 'next_link'=>$nextLink, 'self'=>$self));
        $allData->add($links);


        $response = new JsonResponse($allData->toArray(), Response::HTTP_OK);
        $response->setEncodingOptions($response->getEncodingOptions()|JSON_PRETTY_PRINT);
        return $response;
    }

    //TODO: this does not belong here, refactor ASAP!!!
    public function  numOfPages(int $totalItems, int $itemsPerPage){
        $div = intdiv($totalItems, $itemsPerPage);
        $num = $totalItems % $itemsPerPage ? ++$div : $div;
        return $num;
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