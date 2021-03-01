<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\BDPruebaLibros;
class LibroController extends AbstractController  {
    private $libros;

    public function __construct(BDPruebaLibros $datos) {
        $this->libros = $datos->get();
    }
    
    /**
    * @Route("/libro/{isbn}", name="ficha_libro")
    */
    public function ficha($isbn = "") {
        $resultado = array_filter($this->libros, function($libro) use ($isbn) {
            return $libro["isbn"] == $isbn;
        });

        if (count($resultado) > 0) {
            return $this->render('ficha_libro.html.twig',
                array('libro' => array_shift($resultado)));
        } 
        return $this->render('ficha_libro.html.twig',
                array('libro' => NULL));
    }
}
?>
