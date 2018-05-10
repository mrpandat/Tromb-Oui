<?php

namespace App\Controller;

use App\Entity\People;
use App\Form\PeopleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/api/v1/people")
 */
class PeopleController extends Controller
{
    /**
     * @Route("/", name="people_index", methods="GET")
     */
    public function index(): Response
    {
        $people = $this->getDoctrine()
            ->getRepository(People::class)
            ->findAll();
        return new JsonResponse($people);
    }

    /**
     * @Route("/new", name="people_new", methods="POST")
     */
    public function new(Request $request): Response
    {
        $person = new People();
        $form = $this->createForm(PeopleType::class, $person);
        $form->handleRequest($request);
        $form->submit($request->request->all());
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();
            return new JsonResponse($person);
        }

        $error = array('code' => Response::HTTP_BAD_REQUEST, 'error' => (string)$form->getErrors(true, false));
        return new JsonResponse($error, Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/{id}", name="people_show", methods="GET")
     */
    public function show($id): Response
    {
      $em = $this->getDoctrine()->getManager();
      $person = $em->getRepository(People::class)->findOneById($id);
      if(!$person) {
        $error = array('error' => 'No people found with id '.$id);
        return new JsonResponse($error, Response::HTTP_NOT_FOUND);
      }
      return new JsonResponse($person);
    }

    /**
     * @Route("/{id}/edit", name="people_edit", methods="POST")
     */
    public function edit(Request $request, $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $person = $em->getRepository(People::class)->findOneById($id);
        if(!$person) {
          $error = array('error' => 'No people found with id '.$id);
          return new JsonResponse($error, Response::HTTP_NOT_FOUND);
        }
        $parameters = $request->request;

        if($parameters->get('name')) {
          $person->setName($parameters->get('name'));
        }
        if($parameters->get('description')) {
          $person->setDescription($parameters->get('description'));
        }
        $em = $this->getDoctrine()->getManager()->flush();
        return new JsonResponse($person);
    }

    /**
     * @Route("/{id}", name="people_delete", methods="DELETE")
     */
    public function delete(Request $request, $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $person = $em->getRepository(People::class)->findOneById($id);
        if(!$person) {
          $error = array('error' => 'No people found with id '.$id);
          return new JsonResponse($error, Response::HTTP_NOT_FOUND);
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($person);
        $em->flush();
        return new JsonResponse('ok');
    }
}
