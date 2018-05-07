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
use App\Form\PeopleType;

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
      $form = $this->createForm(PeopleType::class, new People());
      $form->submit($request->request->all());
      if (false === $form->isValid()) {
          $error = array('code' => Response::HTTP_BAD_REQUEST, 'error' => (string)$form->getErrors(true, false));
          return new JsonResponse($error, Response::HTTP_BAD_REQUEST);
      }
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($form->getData());
      $entityManager->flush();

      return new JsonResponse($form->getData());

    }
}
