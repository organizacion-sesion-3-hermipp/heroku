{ "collection" :
    {
        "title" : "TVSeries Database",
            "type" : "TVSeries",
            "version" : "1.0",
            "href" : "{{ path_for('tvseries')}}",
      
            "links" : [
                {"rel" : "profile" , "href" : "http://schema.org/tvseries","prompt":"Perfil"},
                {"rel" : "collection", "href" : "{{ path_for('movies') }}","prompt":"Movies"},
                {"rel" : "collection", "href" : "{{ path_for('books') }}","prompt":"Books"},
                {"rel" : "collection", "href" : "{{ path_for('musicalbums') }}","prompt":"Music Albums"},
                {"rel" : "collection", "href" : "{{ path_for('games') }}","prompt":"Videogames"},
                {"rel" : "collection", "href" : "{{ path_for('tvseries') }}","prompt":"TVSeries"}
            ],
      
            "items" : [
                {
                    "href" : "{{ path_for('tvseries') }}/{{ item.id }}",
                        "data" : [
                            {"name" : "name", "value" : "{{ item.name }}", "prompt" : "Nombre de la Serie"},
                            {"name" : "description", "value" : "{{ item.description }}", "prompt" : "Descripción de la Serie"},
                            {"name" : "platform", "value" : "{{ item.platform }}", "prompt" : "Plataforma de la Serie"},
                            {"name" : "datePublished", "value" : "{{ item.datePublished }}", "prompt" : "Fecha de lanzamiento"}
                        ]
                        } 
	  
            ],
      
            "template" : {
            "data" : [
                {"name" : "name", "value" : "", "prompt" : "Nombre de la serie"},
                {"name" : "description", "value" : "", "prompt" : "Descripción de la serie"},
                {"name" : "platform", "value" : "", "prompt" : "Plataforma de la serie"},
                {"name" : "datePublished", "value" : "", "prompt" : "Fecha de la serie"}
            ]
                }
    } 
}




