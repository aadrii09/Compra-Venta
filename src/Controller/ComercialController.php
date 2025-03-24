<?php

namespace App\Controller;

use App\Entity\Comercial;
use App\Form\ComercialFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ComercialController extends AbstractController
{
    //Ver historial de anuncios, donde se mostrarán todos los anuncios independientemente de si han sido vendidos o no.
    //Aquí debemos mostrar de algún modo que el producto fue vendido, además de la fecha de venta.
    #[Route('/list', name: 'listar')]
    public function listarComercial(EntityManagerInterface $entityManagerInterface ): Response
    {

        $listaComercial=$entityManagerInterface->getRepository(Comercial::class)->findAll();
        


        return $this->render('comercial/index.html.twig', [
            'listaComercial'=>$listaComercial,

        ]);
    }
    //Visualizar una lista con los anuncios que aún no han sido vendidos. 
    //Esta página es la que se debe cargar en el navegador en la ruta por defecto. 
    //En esta página solo debemos ver el nombre, la fecha de publicación y el precio.
    #[Route('/nocomercial', name: 'comercial_no_vendidos')]
    public function listarNoVendidos(EntityManagerInterface $entityManagerInterface): Response
    {
    $comercialesNoVendidos = $entityManagerInterface->getRepository(Comercial::class)->findBy(['vendido' => false]);
    
    return $this->render('comercial/no_vendidos.html.twig', [
        'anuncios' => $comercialesNoVendidos,
    ]);
    }
    //Crear un nuevo anuncio. Esta acción debe inicializar con nulo los datos de la venta (fecha y precio) 
    //y marcar que el producto no está vendido.
    #[Route('/comercial/crear', name: 'crear_comercial')]
    public function crear(Request $request , EntityManagerInterface $entityManagerInterface): Response
    {
        $crearComercial=new Comercial;
        $form=$this->createForm(ComercialFormType::class, $crearComercial);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $entityManagerInterface->persist($crearComercial);
            $entityManagerInterface->flush();
            return $this->redirectToRoute("listar");
        }
        return $this->render('comercial/crearform.html.twig', [
            "form"=>$form->createView(),
        ]);
    }
    //Ver los detalles de un anuncio. Esta acción debe llevar a una página donde se pueda ver toda la información sobre un anuncio determinado. 
    //Se podrá acceder a esta vista tanto desde la lista de anuncios no vendidos como desde la lista del historial de anuncios.
    #[Route('/comercial/detalle/{id}', name: 'detalle_comercial')]
    public function detalleComercial(EntityManagerInterface $entityManager, Comercial $comercial): Response
        {
    return $this->render('comercial/detalle.html.twig', ['comercial' => $comercial,]);
    }
    //Permitir marcar como vendido un anuncio. Isto pode facerse mediante un botón que leve a un formulario no que o usuario só poderá escoller o prezo e a data da venda. 
    //Só se poden marcar produtos como vendidos nos anuncios que estean marcados como non vendidos.
    #[Route('/comercial/editar/{id}', name: 'editar_comercial')]
    public function editar(Comercial $comercial, Request $request , EntityManagerInterface $entityManagerInterface): Response
    {
       
        $form=$this->createForm(ComercialFormType::class, $comercial);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $entityManagerInterface->flush();
            return $this->redirectToRoute("listar");
        }
        return $this->render('comercial/editarform.html.twig', [
            "form"=>$form->createView(),
        ]);
    }
}
