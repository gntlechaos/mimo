AuthorPublicationData = false;

avoidDatabaseRequest = true;

$(document).ready(function(){
    console.log("mimo: Bem-vindo ao mimo, sistema interno da Interposto!");

    // BARRA LATERAL

    if(!avoidDatabaseRequest){
        var sidabar_container = $('#sidebar-projects');
        var loading_element = sidabar_container.find('#loading');
        
        requestSideBarData();

        function requestSideBarData(){
            $.ajax({
                url: 'php/getAuthorPublications.php', 
                type: 'POST', 
                dataType: 'json',
                beforeSend: function() {
                    console.log("mimo: Requisitando informações sobre publicações em que o usuário é colaborador.");
                    sidabar_container.find("> :not(#loading)").remove();
                    loading_element.show();
                },
                success: function(response) {
                    // This function will be executed on a successful request
                    if (response.success) {
                        console.log("mimo: Informações recebidas com sucesso.");
                        AuthorPublicationData = response.data;
                        loadSideBar();
                    } else {
                        console.log('mimo: Nenhum dado foi encontrado.');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // This function will be executed if the request fails
                    console.log('mimo: Houve um erro na aquisição de dados. Detalhes: \n\n ' + textStatus, errorThrown);
                }
            });
        }


        

        function loadSideBar(data, query = false){

            if(!query){
                data = AuthorPublicationData;
            } 

            if(data){
                sidabar_container.find("> :not(#loading)").remove();
                $.each(data, function(i, publication) {

                    var pub_container = $('<li></li>');
                    var author_container = $('<div class="project-author"></div>');
                    var author_tooltip_container = $('<span class="author-info-popup"></span>');
                    var author_tooltip_list_container= $('<ul></ul>');  
                    var project_name_container = $('<span class="project-name"><a href="edit.php?url='+publication.url+'">'+publication.pub_title+'</a></span>');    

                    var author_ids = publication.author_ids.split(",");
                    var author_names = publication.author_names.split(",");
                    $.each(author_ids, function(i, author_id) {
                        var img = $('<img width="16px" height="16px" src="images/avatars/'+author_id+'.jpg"/>');
                        author_container.append(img);

                        var author_name = $('<li>'+author_names[i]+'</li>');
                        author_tooltip_list_container.append(author_name);
                    });

                    author_tooltip_container.append(author_tooltip_list_container);
                    author_container.append(author_tooltip_container);

                    project_name_container.append('')

                    pub_container.append(author_container);
                    pub_container.append(project_name_container);
                    sidabar_container.append(pub_container);
                });

                loading_element.hide();

            } else{
                console.log('mimo: Houve um erro ao processar os dados.');
            }
        
        }
        
        // Busca da barra lateral
        var typingTimer;
        $("#project-search").on('input',function(){

            var query =  $(this).val();
            var inputLength = query.length;
            if(inputLength > 2){
                clearTimeout(typingTimer);
                typingTimer = setTimeout(function() {
                    $.ajax({
                        url: 'php/searchAuthorPublications.php?q='+query, 
                        type: 'GET', 
                        dataType: 'json',
                        beforeSend: function() {
                            console.log("mimo: Realizando busca.");
                            sidabar_container.find("> :not(#loading)").remove();
                            loading_element.show();
                        },
                        success: function(response) {
                            // This function will be executed on a successful request
                            if (response.success) {
                                console.log("mimo: Informações recebidas com sucesso.");
                                sidabar_container.find("> :not(#loading)").remove();
                                loadSideBar(response.data,true);
                            } else {
                                sidabar_container.find("> :not(#loading)").remove();
                                loading_element.hide();
                                console.log('mimo: Nenhum dado foi encontrado.');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            // This function will be executed if the request fails
                            console.log('mimo: Houve um erro na aquisição de dados. Detalhes: \n\n ' + textStatus, errorThrown);
                        }
                    });
                }, 500);
            }
            if(inputLength == 0){
            clearTimeout(typingTimer);
            requestSideBarData();

            }

        });

        
    }
});
