<?php

// Modelo de objetos que se corresponde con la tabla de MySQL
class TVSeries extends \Illuminate\Database\Eloquent\Model
{
	public $timestamps = false;
}

// Añadir el resto del código aquí
$app->get('/tvseries', function ($req, $res, $args) {

    // Creamos un objeto collection + json con la lista de películas

    // Obtenemos la lista de películas de la base de datos y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
    $tvseries = json_decode(\TVSeries::all());

    // Mostramos la vista
    return $this->view->render($res, 'tvserieslist_template.php', [
        'items' => $tvseries
    ]);
})->setName('tvseries');


/*  Obtención de un videojuego en concreto  */
$app->get('/tvseries/{name}', function ($req, $res, $args) {

    // Creamos un objeto collection + json con el videojuego pasada como parámetro

    // Obtenemos el videojuego de la base de datos a partir de su id y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
    $p = \TVSeries::find($args['name']);  
    $serie = json_decode($p);

    // Mostramos la vista
    return $this->view->render($res, 'tvseries_template.php', [
        'item' => $serie
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
        case "platform":
            $plataf = $datos[$i]['value'];
            break;
        case "datePublished":
            $date = $datos[$i]['value'];
            break;
        }    
    }
  
    $tvseries = new TVSeries;
    $tvseries->name = $name;
    $tvseries->description = $desc;
    $tvseries->platform = $plataf;
    $tvseries->datePublished = $date;
  
    $tvseries->save();
});


//Actualizar videojuego

$app->put('/tvseries/{name}', function ($req, $res, $args) {

	// Creamos un objeto collection + json con el libro pasado como parámetro

	// Obtenemos el libro de la base de datos a partir de su id y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
	$nuevo_tvseries = \TVSeries::find($args['name']);	

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

	$nuevo_tvseries['name'] = $name;
	$nuevo_tvseries['description'] = $description;
	$nuevo_tvseries['platform'] = $platform;
	$nuevo_tvseries['datePublished'] = $datePublished;
	$nuevo_tvseries->save();

});


?>
