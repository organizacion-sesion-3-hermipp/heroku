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
                {% for item in items %}
	  
                {
                    "href" : "{{ path_for('games') }}/{{ item.id }}",
                        "data" : [
                            {"name" : "name", "value" : "{{ item.name }}", "prompt" : "Nombre de la Serie"}
                        ]
                        } {% if not loop.last %},{% endif %}
	  
                {% endfor %}
	  
            ],
      
            "template" : {
            "data" : [
                {"name" : "name", "value" : "{{ item.name }}", "prompt" : "Nombre del Juego"},
                {"name" : "description", "value" : "{{ item.description }}", "prompt" : "Descripción del Juego"},
                {"name" : "platform", "value" : "{{ item.director }}", "prompt" : "Plataforma del Juego"},
                {"name" : "datePublished", "value" : "{{ item.datePublished }}", "prompt" : "Fecha de lanzamiento"}
            ]
                }
    } 
}




