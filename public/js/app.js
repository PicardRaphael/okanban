var app = {

    init: function() {
  
      console.log('init');
  
      // J'écoute l'evenement submit sur mon formulaire d'ajout de liste
      $('#addList').on('submit', app.addList);
  
      // J'écoute l'évenement click sur mes boutons d'édition
      $('.fa-edit').on('click', app.showEditList);
  
      // J'écoute l'evenement submit sur mes formulaires d'édition
      $('.editListForm').on('submit', app.editList);
        
      //J'écoute l'evenement click sur mes boutons corbeil
      $('.fa-trash-alt').on('click', app.removeElement);

      $( ".connectedSortable" ).sortable({
          connectWith: '.connectedSortable',
          items: '.sortableItems',
          update: app.updateCardsPositions
        });
 
    },
    addList: function(evt) {
  
      // J'arrete l'execution de la soumission normale du formulaire
      evt.preventDefault();
  
      var dataToSend = $(this).serialize();
  
      $.ajax({
        url: './list/create',
        method: 'POST',
        dataType: 'json',
        data: dataToSend
  
      }).done(function(response) {
  
        if (response.code == 0) {
  
            window.location.reload();
  
        } else {
  
            alert(response.errorMsg);
        }
      }).fail(function(){
  
        alert('Une erreur est survenue...');
      });
  
    },
    showEditList: function(){
  
      var listId = $(this).parent().data('listid');
  
      $('#listName-'+listId).addClass('d-none');
      $('#listEditBtn-'+listId).addClass('d-none');
      $('#editListForm-'+listId).removeClass('d-none');
    },
    editList: function(evt) {
  
      console.log('editList');
  
      // J'arrete le traitement classique de mon évenement
      evt.preventDefault();
  
      var dataToSend = $(this).serialize();
  
      $.ajax({
        url: './list/update',
        method: 'POST',
        dataType: 'json',
        data: dataToSend
  
      }).done(function(response) {
  
        // Si tout se passe bien !
        if (response.code == 0) {
  
          // Je en réponse listId & listName
          // je réutilise donc ces valeurs pour modifier mon affichage dynamiquement
          $('#listName-'+response.listId).text(response.listName).removeClass('d-none');
          $('#listEditBtn-'+response.listId).removeClass('d-none');
          $('#editListForm-'+response.listId).addClass('d-none');
  
        } else {
  
            alert(response.errorMsg);
        }
      }).fail(function(){
  
        alert('Une erreur est survenue...');
      });
  
    },
    updateCardsPositions: function(){
        console.log('position');

    },
    removeElement: function(){
        var listId = $(this).parent().data('listid');
        $('#listContainer-'+listId).remove();

        $.ajax({
            url: './list/delete',
            method: 'POST',
            dataType: 'json',
            data: 'listId='+listId
      
          }).done(function(response) {
                // Si tout se passe bien !
                if (response.code != 0) {
        
                    alert(response.errorMsg);
                    window.location.reload();
                }

          }).fail(function(){
      
            alert('Une erreur est survenue...');
            window.location.reload();

          });
    }
  

  };
  
  $(app.init);