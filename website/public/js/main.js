$(document).ready(function() {
  $('#newListForm').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: $(this).attr('action'),
      data: $(this).serialize(),
      dataType: 'json', // to recieve JSON response
      success: function(response) {      
        // for debugging status 
        console.log('AJAX Success Response:', response);
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

          // clearing form dat
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



  $('.list-link').on('click', function(e) {
    e.preventDefault(); // Prevent the default link behavior
    
    var url = $(this).attr('href');
    
    $.ajax({
      type: 'GET',
      url: url,
      success: function(response) {
        $('#dashboard-right-content').html(response);
      },
      error: function(xhr) {
        console.error("Error fetching list tasks: ", xhr);
      }
    });
  });

  

});