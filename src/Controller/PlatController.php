<?php
namespace App\Controller ;

use App\Entity\Plat;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;   
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use App\Service\PlatService as ServicePlat;


class PlatController extends AbstractController {

    /**
     * @Route("/plat", name="plat_list")
     * @Method ({"GET"})
     */
    public function plat(){

        $plat  = new ServicePlat($this->getDoctrine()->getManager(),Plat::class);
        $plats = $plat->getAllplats();
        return $this->render('plats/index.html.twig', array
        ('plats' => $plats));
    }

    /**
     * @Route ("/plat/new", name="new_article")
     * Method ({"GET", "POST"})
     */
    public function new(Request $request){
        $plat = new Plat();

        $form = $this->createFormBuilder($plat)
            ->add('libelle', TextType::class, array('attr' =>array('class' => 'form-control')))
            ->add('prix', TextType::class, array('required' =>false,
                'attr' =>array('class' =>'form-control')))
            ->add('save', SubmitType::class, array(
                'label' =>'Create',
                'attr' =>array('class'=>'btn btn-primary mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $plat = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($plat);
            $entityManager->flush();

            return $this->redirectToRoute('plat_list');
        }

        return $this->render('plats/new.html.twig',array(
            'form'=>$form->createView()
        ));
    }

    /**
     * @Route ("/plat/{id}", name= "plat_show")
     * @Method ({"GET"})
     */

    public function show($id){
        $plat  = new ServicePlat($this->getDoctrine()->getManager(),Plat::class);
        $plat = $plat->getPlat($id);
        return $this->render('plats/show.html.twig', array('plat' =>$plat));

    }

    /**
     * @Route ("/plat/update/{id}", name="update_plat")
     * Method ({"GET", "POST"})
     */

    public function update(Request $request, $id){

        $plat = $this->getDoctrine()->getRepository(Plat::class)->find($id);

        $form = $this->createFormBuilder($plat)
            ->add('libelle', TextType::class, array('attr' =>array('class' => 'form-control')))
            ->add('prix', TextType::class, array('required' =>false,
                'attr' =>array('class' =>'form-control')))
            ->add('save', SubmitType::class, array(
                'label' =>'Update',
                'attr' =>array('class'=>'btn btn-primary mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $plat = new ServicePlat($this->getDoctrine()->getManager(),Plat::class);
            $plat->addPlat();

            return $this->redirectToRoute('plat_list');
        }

        return $this->render('plats/update.html.twig',array(
            'form'=>$form->createView()
        ));
    }

    /**
     * @Route ("/plat/delete/{id}")
     * @Method ({"DELETE"})
     */

    public function delete(Request $request, $id){

        $plat  = new ServicePlat($this->getDoctrine()->getManager(),Plat::class);
        $plat->deletePlat($id);

        return $this->redirectToRoute('plat_list');
    }
}

