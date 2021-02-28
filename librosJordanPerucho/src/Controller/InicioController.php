<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class InicioController {
    /**
    * @Route("/", name="inicio")
    */
    public function inicio() {
        return new Response("Biblioteca particular");
    }
}
?>
