$(document).ready(function() {
  /*
  sometimes it stays on the same page http://localhost:8888/web-development-8/website/dashboard 
  and all the ajax requests performed well and sometimes goes to the another page 
  http://localhost:8888/web-development-8/website/list/add 
  with showing json status either success or error. How to prevent going to another page
  */

  $('#createListModal').on('submit','#newListForm', function(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: $(this).attr('action'),
      data: $(this).serialize(),
      dataType: 'json', // to recieve JSON response
      success: function(response) {      
        // for debugging status 
        // console.log('AJAX Success Response:', response);
        // debugging html
        // console.log('Response HTML:', response.html);
        if (response.status === 'success') {
          // TODO loading spinner           
          $('#listsContainer').html(response.html);

          // hiding modal
          $('#createListModal').modal('hide');

          // backdrop isn't hidden with modal, so manually removing the backdrop element
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove(); 

          // clearing form data
          $('#newListForm')[0].reset();  // Clear form data
        } else if (response.status === 'error') {
          // rendering error messages in the modal
          $('#createListModal #modal-errors').html(response.errors.map(function(error) {
            return '<p class="error-messages">' + error + '</p>';
          }).join(''));
        }
      },
      error: function(xhr) {
        $('#createListModal .modal-body').html('<p>An internal server error occurred. Please try again later.</p>');
      }
    });
  });


  $('#listsContainer').on('click','.list-link', function(e) {
    e.preventDefault();  
    var url = $(this).attr('data-href');    
    $.ajax({
      type: 'GET',
      url: url,
      success: function(response) {
        $('#dashboard-right-content').html(response);
      },
      error: function(xhr) {
        console.error("Error fetching lists: ", xhr);
      }
    });
  });

  
  $('#listsContainer').on('click','.list-edit', function(e) { 
    e.preventDefault();   
    console.log("editing");
    
    var url = $(this).attr('data-href');    
    $.ajax({
      type: 'GET',
      url: url,
      success: function(response) {        
        $('#editListModal .modal-body').html(response);
        $('#editListModal').modal('show');
      },
      error: function(xhr) {
        console.error("Error fetching list: ", xhr);
      }
    });

  }); 
  
  var deleteUrl = '';

  // open the modal on delete button click  
  $('#listsContainer').on('click','.list-delete', function(e) { 
      e.preventDefault();
      console.log("deleting");

      deleteUrl = $(this).attr('data-href');
      $('#deleteListModal').modal('show');
  });

  // delete confirmation
  $('#listsContainer').on('click','#confirmDelete', function(e) { 
      $.ajax({
          type: 'GET',
          url: deleteUrl,
          success: function(response) {
              $('#listsContainer').html(response.html);
              $('#deleteListModal').modal('hide');
              // backdrop isn't hidden with modal, so manually removing the backdrop element
              $('body').removeClass('modal-open');
              $('.modal-backdrop').remove(); 
    
          },
          error: function(xhr) {
              console.error("Error deleting list: ", xhr);
              $('#deleteListModal').modal('hide');
          }
      });
  });



  $('#createTaskModal').on('submit','#createTaskForm', function(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: $(this).attr('action'),
      data: $(this).serialize(),
      dataType: 'json', // to recieve JSON response
      success: function(response) {      
        // for debugging status 
        // console.log('AJAX Success Response:', response);
        // debugging html
        // console.log('Response HTML:', response.html);
        if (response.status === 'success') {
          // TODO loading spinner           
          $('#dashboard-right-content').html(response.html);

          // hiding modal
          $('#createTaskModal').modal('hide');

          // backdrop isn't hidden with modal, so manually removing the backdrop element
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove(); 

          // clearing form data
          $('#createTaskForm')[0].reset();  // Clear form data
        } else if (response.status === 'error') {
          // rendering error messages in the modal
          $('#createTaskModal #modal-errors').html(response.errors.map(function(error) {
            return '<p class="error-messages">' + error + '</p>';
          }).join(''));
        }
      },
      error: function(xhr) {
        $('#createTaskModal .modal-body').html('<p>An internal server error occurred. Please try again later.</p>');
      }
    });
  });



});
