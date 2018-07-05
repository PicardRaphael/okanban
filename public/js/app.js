var app = {

    init: function(){

        console.log('init');
        $('#addList').on('submit', app.addList);
    },
    addList: function(evt){
        evt.preventDefault();

        //Créé formulaire en format JSON
        var dataToSend = $(this).serialize();

        $.ajax({
            
            url: './list/create',
            method: 'POST',
            dataType: 'json',
            data: dataToSend

        }).done(function(data){

            if(data.code == 0){
                alert("TODO je dois ajouter une list");
            }else{
                alert(data.errorMsg);
            }

        }).fail(function(){

            alert('Une erreur est survenue');
            
        });

    },
};

$(app.init);