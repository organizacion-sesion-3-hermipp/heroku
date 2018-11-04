<?php

// Modelo de objetos que se corresponde con la tabla de MySQL
class Tvserie extends \Illuminate\Database\Eloquent\Model
{
	public $timestamps = false;
}

// Añadir el resto del código aquí
$app->get('/tvseries', function ($req, $res, $args) {

    // Creamos un objeto collection + json con la lista de películas

    // Obtenemos la lista de películas de la base de datos y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
    $tvseries = json_decode(\Tvserie::all());

    // Mostramos la vista
    return $this->view->render($res, 'tvserielist_template.php', [
        'items' => $tvseries
    ]);
})->setName('tvseries');


/*  Obtención de un videojuego en concreto  */
$app->get('/tvseries/{name}', function ($req, $res, $args) {

    // Creamos un objeto collection + json con el videojuego pasada como parámetro

    // Obtenemos el videojuego de la base de datos a partir de su id y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
    $p = \Tvserie::find($args['name']);  
    $serie = json_decode($p);

    // Mostramos la vista
    return $this->view->render($res, 'tvserie_template.php', [
        'item' => $serie
    ]);

});

/*  Eliminacion de un videojuego en concreto  */
$app->delete('/tvseries/{name}', function ($req, $res, $args) {
	
    // Obtenemos el videojuego de la base de datos a partir de su id y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
    $p = \Tvserie::find($args['name']); 
    $p->delete();

});

/*Crea un nuevo videojuego con los datos recibidos*/
$app->post('/tvseries', function ($req, $res, $args) {
    //Código para peticiones de POST (creación de items)
    $template = $req->getParsedBody();
    $datos = $template['template']['data'];  

    $longitud = count($datos);
    for($i=0; $i<$longitud; $i++)
    {
        switch ($datos[$i]['name']){
        case "name":
            $name = $datos[$i]['value'];
            break;
        case "description":
            $desc = $datos[$i]['value'];
            break;
        case "platform":
            $plataf = $datos[$i]['value'];
            break;
        case "datePublished":
            $date = $datos[$i]['value'];
            break;
        }    
    }
  
    $tvserie = new Tvserie;
    $tvserie->name = $name;
    $tvserie->description = $desc;
    $tvserie->platform = $plataf;
    $tvserie->datePublished = $date;
  
    $tvserie->save();
});


//Actualizar videojuego

$app->put('/tvseries/{name}', function ($req, $res, $args) {

	// Creamos un objeto collection + json con el libro pasado como parámetro

	// Obtenemos el libro de la base de datos a partir de su id y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
	$nueva_serie = \Tvserie::find($args['name']);	

    $template = $req->getParsedBody();

	$datos = $template['template']['data'];
  	foreach ($datos as $item)
  	{ 
		switch($item['name'])
		{
        case "name":
            $name = $item['value'];
            break;
        case "description":
            $description = $item['value'];
            break;
        case "platform":
            $platform = $item['value'];
            break;
		case "datePublished":
            $datePublished = $item['value'];
            break;
		}
	}

	$nueva_serie['name'] = $name;
	$nueva_serie['description'] = $description;
	$nueva_serie['platform'] = $platform;
	$nueva_serie['datePublished'] = $datePublished;
	$nueva_serie->save();

});


?>
