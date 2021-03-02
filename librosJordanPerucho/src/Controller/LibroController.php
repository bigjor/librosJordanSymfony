<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\BDPruebaLibros;
use App\Entity\Libro;
use App\Entity\Editorial;
class LibroController extends AbstractController  {
    private $libros;

    public function __construct(BDPruebaLibros $datos) {
        $this->libros = $datos->get();
    }
    
    
    /**
    * @Route("/libro/paginas/{paginas}", name="filtrar_paginas")
    */
    public function filtrarPaginas($paginas = 0) {
        $libros = [];
        try {
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery(
                'SELECT l
                FROM App:Libro l
                WHERE l.paginas > :paginas
                ORDER BY l.paginas ASC'
            )->setParameter('paginas', $paginas);

            $libros = $query->getResult();
        } catch (Exception $e) {}

        return $this->render(
            'inicio.html.twig', 
            array('libros' => $libros)
        );
    }

    /**
    * @Route("/libro/insertar", name="insertar_libro")
    */
    public function insertar() {

        /* -------------------------------------------------------------------------- */
        /*                              PRIMERA INSERCION                             */
        /* -------------------------------------------------------------------------- */

        // try {
        //     $entityManager = $this->getDoctrine()->getManager();
    
        //     $libro = new Libro();
        //     $libro->setIsbn("978-84-339-8084-7");
        //     $libro->setTitulo("Yoga");
        //     $libro->setAutor("Carrère, Emmanuel");
        //     $libro->setPaginas(200);
            
        //     $entityManager->persist($libro);
        //     $entityManager->flush();
            
        //     return new Response("Insertado correctamente");
        // } catch (Exception $e) {
        //     return new Response($e);
        // }

        /* -------------------------------------------------------------------------- */
        /*                              SEGUNDA INSERCIÓN                             */
        /* -------------------------------------------------------------------------- */

        // $libros = array(
        //     array("isbn" => "978-84-339-8084-7", "titulo" => "Yoga",        "autor" => "Carrère, Emmanuel",  "paginas" => 200),
        //     array("isbn" => "978-84-204-5432-0", "titulo" => "Miss Marte",  "autor" => "Jabois, Manuel",     "paginas" => 180),
        //     array("isbn" => "978-84-666-6441-7", "titulo" => "Reina roja",  "autor" => "Gómez-Jurado, Juan", "paginas" => 385)
        // );
        // $messages = [];

        // foreach ($libros as $key => $value) {
        //     try {
        //         $entityManager = $this->getDoctrine()->getManager();
        
        //         $libro = new Libro();
        //         $libro->setIsbn($value["isbn"]);
        //         $libro->setTitulo($value["titulo"]);
        //         $libro->setAutor($value["autor"]);
        //         $libro->setPaginas($value["paginas"]);
                
        //         $entityManager->persist($libro);
        //         $entityManager->flush();
                
        //         $messages[] = $value["titulo"] . " añadido con exito";
        //     } catch (Exception $e) {
        //         $messages[] = $value["titulo"] . " no ha sido añadido. ERROR";
        //     }
        // }

        // return new Response("Mensajes: <br/>" . implode("<br/>", $messages));
    }

    /**
    * @Route("/libro/insertarConEditorial", name="insertar_libro_editorial")
    */
    public function insertarConEditorial() {
        try {
            $entityManager = $this->getDoctrine()->getManager();
    
            $newEditorial = new Editorial();
            $newEditorial->setNombre("Bromera2");

            $entityManager = $this->getDoctrine()
                                  ->getManager();
            $repository =    $this->getDoctrine()
                                  ->getRepository(Editorial::class);
            $editorial = $repository->findOneBy(
                array('nombre' => $newEditorial->getNombre())
            );

            $libro = new Libro();
            $libro->setIsbn("8888TTTT");
            $libro->setTitulo("tu gusto");
            $libro->setAutor("Isabel Clara Simó");
            $libro->setPaginas(208);
            
            
            if ($editorial != NULL) {
                $libro->setEditorial($editorial);
            } else {
                $entityManager->persist($newEditorial);
                $libro->setEditorial($newEditorial);
            }
            
            $entityManager->persist($libro);
            $entityManager->flush();
            
            return new Response("Insertado correctamente");
        } catch (Exception $e) {
            return new Response($e);
        }
    }

    /**
    * @Route("/libro/{isbn}", name="ficha_libro")
    */
    public function ficha($isbn = "") {
        // $resultado = array_filter($this->libros, function($libro) use ($isbn) {
        //     return $libro["isbn"] == $isbn;
        // });

        // if (count($resultado) > 0) {
        //     return $this->render('ficha_libro.html.twig',
        //         array('libro' => array_shift($resultado)));
        // } 
        // return $this->render('ficha_libro.html.twig',
        //         array('libro' => NULL));

        $entityManager = $this->getDoctrine()
                              ->getManager();
        $repository =    $this->getDoctrine()
                              ->getRepository(Libro::class);
        $libro = $repository->findOneBy(
            array('isbn' => $isbn)
        );

        return $this->render(
            'ficha_libro.html.twig',
            array('libro' => $libro)
        );
    }
}
?>
