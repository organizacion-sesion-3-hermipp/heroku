<?php

// Modelo de objetos que se corresponde con la tabla de MySQL
class TVSeries extends \Illuminate\Database\Eloquent\Model
{
	public $timestamps = false;
}

// Añadir el resto del código aquí
$app->get('/tvseries', function ($req, $res, $args) {

    // Creamos un objeto collection + json con la lista de series

    // Obtenemos la lista de series de la base de datos y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
    $juegos = json_decode(\TVSeries::all());

    // Mostramos la vista
    return $this->view->render($res, 'tvserieslist_template.php', [
        'items' => $tveseries
    ]);
})->setName('tvseries');


/*  Obtención de un videojuego en concreto  */
$app->get('/tvseries/{name}', function ($req, $res, $args) {

    // Creamos un objeto collection + json con la serie pasada como parámetro

    // Obtenemos el videojuego de la base de datos a partir de su id y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
    $p = \TVSeries::find($args['name']);  
    $juego = json_decode($p);

    // Mostramos la vista
    return $this->view->render($res, 'tvseries_template.php', [
        'item' => $tvseries
    ]);

});

/*  Eliminacion de un videojuego en concreto  */
$app->delete('/tvseries/{name}', function ($req, $res, $args) {
	
    // Obtenemos el videojuego de la base de datos a partir de su id y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
    $p = \TVSeries::find($args['name']); 
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
        case "gamePlatform":
            $plataf = $datos[$i]['value'];
            break;
        case "applicationSubCategory":
            $category = $datos[$i]['value'];
            break;
        case "screenshot":
            $screenshot = $datos[$i]['value'];
            break;
        case "datePublished":
            $date = $datos[$i]['value'];
            break;
        case "embedUrl":
            $embedUrl = $datos[$i]['value'];
            break;		
        }    
    }
  
    $serie = new TVSeries;
    $serie->name = $name;
    $serie->description = $desc;
    $serie->gamePlatform = $plataf;
    $serie->applicationSubCategory = $category;
    $serie->screenshot =  $screenshot;
    $serie->datePublished = $date;
    $serie->embedUrl = $embedUrl;
  
    $serie->save();
});


//Actualizar videojuego

$app->put('/tvseries/{name}', function ($req, $res, $args) {

	// Creamos un objeto collection + json con el libro pasado como parámetro

	// Obtenemos el libro de la base de datos a partir de su id y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
	$nueva_serie = \TVSeries::find($args['name']);	

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
        case "gamePlatform":
            $gamePlatform = $item['value'];
            break;

        case "applicationSubCategory":
            $applicationSubCategory = $item['value'];
            break;

        case "screenshot":
            $screenshot = $item['value'];
            break;
				
        case "embedUrl":
            $embedUrl = $item['value'];
            break;
        case "datePublished":
            $datePublished = $item['value'];
            break;
		}
	}

	$nueva_serie['name'] = $name;
	$nueva_serie['description'] = $description;
	$nueva_serie['gamePlatform'] = $gamePlatform;
	$nueva_serie['applicationSubCategory'] = $applicationSubCategory;
	$nueva_serie['screenshot'] = $screenshot;
	$nueva_serie['embedUrl'] = $embedUrl;
	$nueva_serie['datePublished'] = $datePublished;
	$nueva_serie->save();

});


?>
