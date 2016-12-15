<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Todolist;

use AppBundle\Form\TodolistType;
use AppBundle\Form\TodolistEditType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MainToDoController extends Controller
{
    /**
     * @Route("/", name="todo")
     */
    public function indexAction()
    {
        $list = $this->getDoctrine()
                ->getRepository('AppBundle:Todolist')
                ->findAll();
        
        return $this->render('todolist/index.html.twig', array( 'list'=> $list));
    }
    
        
     /**
     * @Route("/todolist/description/{id}", name="description")
     */
     public function descriptionAction($id)
    {
        $description = $this->getDoctrine()
                 ->getRepository('AppBundle:Todolist')
                 ->find($id);
        return $this->render('todolist/description.html.twig', array('description'=>$description));
    }
    
    /**
     * @Route("/todolist/create", name="create")
     */
     public function createAction(Request $request)
    {
         
         
        $task = new Todolist;
        //set CreateCreate
        $task->setCreateDate(new \Datetime());
        //external form
        $form   = $this->get('form.factory')->create(TodolistType::class, $task);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($task);
                $em->flush();

                $this->addFlash('notice', 'The task is added');

                // redirect
                return $this->redirectToRoute('todo');

            }
         
        return $this->render('todolist/create.html.twig', array('form_twig'=>$form->createView()));
    }
    
    /**
     * @Route("/todolist/delete/{id}", name="delete")
     */
     public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository('AppBundle:Todolist')->find($id);
         
        $em->remove($task);
        $em->flush();
        $this->addFlash('notice', 'Task removed');
        return $this->redirectToRoute('todo');
    }
    
    /**
     * @Route("/todolist/edit/{id}", name="edit")
     */
     public function editAction($id, Request $request)
    {
        $taskedit = $this->getDoctrine()
                 ->getRepository('AppBundle:Todolist')
                 ->find($id);

        $form   = $this->get('form.factory')->create(TodolistEditType::class, $taskedit);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($taskedit);
                $em->flush();

                $this->addFlash('notice', 'The task is added');

                // redirect
                return $this->redirectToRoute('todo');

            }
        
        return $this->render('todolist/edit.html.twig', array('form_edit'=>$form->createview()));
    }

}
