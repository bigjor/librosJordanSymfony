<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\BDPruebaLibros;
class InicioController extends AbstractController {
    private $libros;

    public function __construct($bdPrueba) {
        $this->libros = $bdPrueba->get();
    }
    
    /**
    * @Route("/", name="inicio")
    */
    public function inicio() {
        return $this->render(
            'inicio.html.twig', 
            array('libros' => $this->libros)
        );
    }
}
?>
