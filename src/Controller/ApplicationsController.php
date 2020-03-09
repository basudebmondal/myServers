<?php

namespace App\Controller;

use App\Entity\Applications;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use League\Csv\Writer;


class ApplicationsController extends AbstractController {
    /**
     * @Route("/", name="application_list")
     * @Method({"POST"})
     */
    public function applications() {
        
        $applications = $this->getDoctrine()->getRepository(Applications::class)->findAll();

        return $this->render('applications/index.html.twig', array('applications' => $applications));
    }

    /**
     * @Route("/application/add-new", name="addnew_application")
     * Method({"POST"})
     */
    public function addNew(Request $request) {
        $application = new Applications();

        $form = $this->createFormBuilder($application)
        ->add('application_name', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('application_version', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('application_description', TextareaType::class, array(
          'required' => false,
          'attr' => array('class' => 'form-control')
        ))
        ->add('save', SubmitType::class, array(
          'label' => 'Create',
          'attr' => array('class' => 'btn btn-primary mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $applications = $form->getData();
    
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($application);
            $entityManager->flush();
    
            return $this->redirectToRoute('application_list');
        }

        return $this->render('applications/addnew.html.twig', array(
            'form' => $form->createView()
          ));
    }

    /**
     * @Route("/application/edit/{id}", name="edit_application")
     * Method({"POST"})
     */
    public function edit(Request $request, $id) {

      $application = $this->getDoctrine()->getRepository(Applications::class)->find($id);

      $form = $this->createFormBuilder($application)
        ->add('application_name', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('application_version', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('application_description', TextareaType::class, array(
          'required' => false,
          'attr' => array('class' => 'form-control')
        ))
        ->add('save', SubmitType::class, array(
          'label' => 'Update',
          'attr' => array('class' => 'btn btn-primary mt-3')
        ))
        ->getForm();

      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()) {
  
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->flush();
  
          return $this->redirectToRoute('application_list');
      }

      return $this->render('applications/edit.html.twig', array(
          'form' => $form->createView()
        ));
  }

    /**
     * @Route("/application/{id}", name="application_details")
     */
    public function details ($id) {
      $application = $this->getDoctrine()->getRepository(Applications::class)->find($id);

      return $this->render('applications/details.html.twig', array('application' => $application));
    }

    /** 
    * @Route("/application/delete/{id}", name="application_delete") 
    */ 
    public function delete($id) { 
      $entityManager = $this->getDoctrine()->getManager(); 
      $application = $this->getDoctrine()->getRepository(Applications::class)->find($id);
      
      if (!$application) { 
        throw $this->createNotFoundException('No application found for id '.$id); 
      } 
      $entityManager->remove($application); 
      $entityManager->flush(); 
      return $this->redirectToRoute('application_list'); 
    }

    /**
     * @Route("/export", name="application_export")
     */

    public function export () {
      $entityManager = $this->getDoctrine()->getManager(); 
      $applications = $entityManager->getRepository(Applications::class)->findAll();

      $header = ['Application Name', 'Version', 'Description'];

      //we create the CSV into memory
      $csv = Writer::createFromFileObject(new \SplTempFileObject);

      //insert the header
      $csv->insertOne($header);

      foreach($applications as $application) {
        $csv->insertOne([$application->getApplicationName(), $application->getApplicationVersion(), $application->getApplicationDescription()]);
      }

      $csv->output('applications.csv');
      die;
    }

    
}

