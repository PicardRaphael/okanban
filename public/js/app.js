var app = {

  init: function() {

    console.log('init');

    // J'écoute l'evenement submit sur mon formulaire d'ajout de list
    $('#addList').on('submit', app.addList);

    // J'écoute l'évenement click sur mes boutons d'édition
    $('.editL').on('click', app.showEditList);

    // J'écoute l'évenement click sur mon bouton de suppression
    $('.deleteL').on('click', app.removeElement);

    // J'écoute l'evenement submit sur mes formulaires d'édition list
    $('.editListForm').on('submit', app.editList);

    // J'ajoute la possibilité de déplacer mes elements au seins des listes
    $('.connectedSortable').sortable({
      connectWith: '.connectedSortable',
      items: '.sortableItems',
      update:  app.updateCardsPositions
    });

    // J'écoute l'évenement click sur mon bouton d'ajout de card
    $('.addCardBtn').on('click', app.showAddCard);

    // J'écoute l'évenement submit mon formulaire d'ajout de card
    $('.addCard').on('submit',app.addCard);

    // J'écoute l'evenement submit sur mes formulaires d'édition card
    $('.editCard').on('submit',app.editCard);
      
    // J'écoute l'evenement click sur mes boutons d'édition
    $('.editC').on('click',app.showEditCard);

    // J'écoute l'évenement click sur mon bouton de suppression
    $('.deletC').on('click',app.removeCard);

    // J'écoute l'évenement click sur mon bouton palette color
    $('.fa-palette').on('click', app.showColorCard);
    
    // J'écoute l'evenement submit sur mon formulaire d'edit' de carde
    $('.editColorCard').on('submit', app.editColorCard);

  },

  
  /* ---LIST--- */
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
      
      // Si tout se passe bien !
      if (response.code == 0) {

        // Pas AJAX donc à ne pas privilegier mais plus rapide pour nous ;-)
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

    evt.preventDefault();

    var dataToSend = $(this).serialize();

    $.ajax({
      url: './list/update',
      method: 'POST',
      dataType: 'json',
      data: dataToSend

    }).done(function(response) {

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

  updateCardsPositions: function() {

    console.log('coucou');
  },

  removeElement: function() {

    var listId = $(this).parent().data('listid');

    $.ajax({
      url: './list/delete',
      method: 'POST',
      dataType: 'json',
      data: 'listId='+listId

    }).done(function(response) {

      if (response.code != 0) {
        alert(response.errorMsg);
        window.location.reload();
      }else {
        $('#listContainer-'+listId).remove();
      }
    }).fail(function(){

      alert('Une erreur est survenue...');
      window.location.reload();
    });
  },


  /* ---CARD--- */
  showAddCard: function(){

    var listId = $(this).data('listid');

    $(this).addClass('d-none');
    $('#addCard-'+listId).removeClass('d-none');
  },

  addCard: function(evt){

    evt.preventDefault();

    var dataToSend = $(this).serialize();
    console.log(dataToSend);
    $.ajax({
      url: './list/card/create',
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

  showEditCard: function(){
    
    console.log('ok');
    var cardId = $(this).parent().data('cardid');
    console.log(cardId);
    $('#editCardTitle-'+cardId).addClass('d-none');
    $('#cardEditBtn-'+cardId).addClass('d-none');
    $('#editCard-'+cardId).removeClass('d-none');
  },

  editCard: function(evt){

    evt.preventDefault();

    var dataToSend = $(this).serialize();
    console.log(dataToSend);
    $.ajax({
      url: './list/card/update',
      method: 'POST',
      dataType: 'json',
      data: dataToSend

    }).done(function(response) {

      if (response.code == 0) {

        $('#editCardTitle-'+response.cardId).text(response.cardTitle).removeClass('d-none');
        $('#cardEditBtn-'+response.cardId).removeClass('d-none');
        $('#editCard-'+response.cardId).addClass('d-none');

      } else {

          alert(response.errorMsg);
      }
    }).fail(function(){

      alert('Une erreur est survenue...');
    });
  },

  showColorCard: function(){
    var cardId = $(this).parent().data('cardid');
    $('#editCardTitle-'+cardId).addClass('d-none');
    $('#cardEditBtn-'+cardId).addClass('d-none');
    $('#editColorCard-'+cardId).removeClass('d-none');
  },

  editColorCard: function(evt){
    
    evt.preventDefault();

    var dataToSend = $(this).serialize();
    
    $.ajax({
      url: './list/card/color',
      method: 'POST',
      dataType: 'json',
      data: dataToSend

    }).done(function(response) {
      console.log(response.cardId);

      if (response.code == 0) {

        $('#editCardTitle-'+response.cardId).removeClass('d-none');
        $('#cardEditBtn-'+response.cardId).removeClass('d-none');
        $('#editColorCard-'+response.cardId).addClass('d-none');

        $('#editCardTitle-'+response.cardId).parent().css({'background-color': $('.inputColorCard').val()}); 
        
        window.location.reload();

      } else {

          alert(response.errorMsg);
      }
    }).fail(function(){

      alert('Une erreur est survenue...');
    });
         
  },

  removeCard: function() {
    
    var cardId = $(this).parent().data('cardid');
    
    $.ajax({
      url: './list/card/delete',
      method: 'POST',
      dataType: 'json',
      data: 'cardId='+cardId

    }).done(function(response) {

      if (response.code != 0) {
        
        alert(response.errorMsg);
        window.location.reload();
      
      }else {
       
        $('#cardContainer-'+cardId).remove();
      }
    }).fail(function(){

      alert('Une erreur est survenue...');
      window.location.reload();
    });
  },

};

$(app.init);
