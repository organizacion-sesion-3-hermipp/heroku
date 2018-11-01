{ "collection" :
    {
        "title" : "VideoGame Database",
            "type" : "VideoGame",
            "version" : "1.0",
            "href" : "{{ path_for('games')}}",

            "links" : [
                {"rel" : "profile" , "href" : "http://schema.org/videogames","prompt":"Perfil"},
                {"rel" : "collection", "href" : "{{ path_for('movies') }}","prompt":"Movies"},
                {"rel" : "collection", "href" : "{{ path_for('books') }}","prompt":"Books"},
                {"rel" : "collection", "href" : "{{ path_for('musicalbums') }}","prompt":"Music Albums"},
                {"rel" : "collection", "href" : "{{ path_for('games') }}","prompt":"Videogames"},
                {"rel" : "collection", "href" : "{{ path_for('tvseries') }}","prompt":"TVSeries"}
            ],
      
            "items" : [
                {% for item in items %}
	  
                {
                    "href" : "{{ path_for('tvseries') }}/{{ item.id }}",
                        "data" : [
                            {"name" : "name", "value" : "{{ item.name }}", "prompt" : "Nombre de la serie"}
                        ]
                        } {% if not loop.last %},{% endif %}
	  
                {% endfor %}
	  
            ],
      
            "template" : {
            "data" : [
                {"name" : "name", "value" : "{{ item.name }}", "prompt" : "Nombre de la serie"},
                {"name" : "description", "value" : "{{ item.description }}", "prompt" : "Descripción de la serie"},
                {"name" : "platform", "value" : "{{ item.platform }}", "prompt" : "Plataforma de la serie"},
                {"name" : "datePublished", "value" : "{{ item.datePublished }}", "prompt" : "Fecha de lanzamiento"}              
            ]
                }
    } 
}




