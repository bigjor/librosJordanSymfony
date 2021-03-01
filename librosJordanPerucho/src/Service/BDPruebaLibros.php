<?php
namespace App\Service;
class BDPruebaLibros {
    private $libros = array(
        array("isbn" => "978-84-16327-81-2", 
              "titulo" => "El duque y yo (Bridgerton 1)", 
              "autor" => "Quinn, Julia", 
              "paginas" => 110),
        array("isbn" => "978-84-16327-82-9", 
              "titulo" => "El vizconde que me amó (Bridgerton 2)", 
              "autor" => "Quinn, Julia", 
              "paginas" => 120),
        array("isbn" => "978-84-322-3773-7", 
              "titulo" => "Llévame a casa", 
              "autor" => "Carrasco, Jesús", 
              "paginas" => 350),
        array("isbn" => "978-84-233-5868-7", 
              "titulo" => "Los privilegios del ángel", 
              "autor" => "Redondo, Dolores", 
              "paginas" => 200)
    );

    public function get() {
        return $this->libros;
    }
}
?>