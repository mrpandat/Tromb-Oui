<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use App\Entity\People;
/**
 * Brand controller.
 *
 * @Route("/")
 */
class PeopleController extends Controller
{
    /**
     * Lists all Peoples.
     * @FOSRest\Get("/peoples")
     *
     * @return array
     */
    public function getPeoplesAction()
    {
        $repository = $this->getDoctrine()->getRepository(People::class);

        $people = $repository->findall();

        return new JsonResponse($people);
    }
    /**
     * Create People.
     * @FOSRest\Post("/people")
     *
     * @return array
     */
    public function postPeopleAction(Request $request)
    {
        $people = new People();
        $people->setName($request->get('name'));
        $people->setDescription($request->get('description'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($people);
        $em->flush();
        return new JsonResponse($people);
    }
}
