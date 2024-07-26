$(document).ready(function() {
  
  $('#listsContainer').on('submit','#newListForm', function(e) {
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
        updateQuickStats();
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


  // when editing is completed, the window stops scrolling for some reason
  // edit form behaviour
  $('#listsContainer').on('submit', '#editListForm', function(e) {
    e.preventDefault(); // Prevent the default form submission
    console.log("Form submission prevented.");

    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: 'json', // Expect JSON response
        success: function(response) {
            console.log("AJAX success response:", response);
            if (response.status === 'success') {
                $('#listsContainer').html(response.html);
                $('#editListModal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                $('#editListModal').find('form')[0].reset();
            } else if (response.status === 'error') {
                $('#editListModal #modal-errors').html(response.errors.map(function(error) {
                    return '<p class="error-messages">' + error + '</p>';
                }).join(''));
            }
        },
        error: function(xhr) {
            console.error("AJAX error:", xhr);
            $('#editListModal .modal-body').html('<p>An internal server error occurred. Please try again later.</p>');
        }
    });
});



  
  let deleteUrl = '';

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
            if (response.status === 'success') {
                $('#deleteListModal').modal('hide');
                $('#listsContainer').html(response.html);  
                location.reload(true);            
            } else if (response.status === 'error') {
              $('#errorModal .modal-body').html(response.errors.map(function(error) {
                return '<p class="error-messages">' + error + '</p>';
              }).join(''));
                $('#errorModal').modal('show');
                $('#deleteListModal').modal('hide');              
            }
          },
          error: function(xhr) {
              console.error("Error deleting list: ", xhr);
              var errorHtml = '<p>There was an error deleting the list. Please try again later.</p>';
              $('#errorModal .modal-body').html(errorHtml);
              $('#errorModal').modal('show');
              $('#deleteListModal').modal('hide');
          }
      });
  });

  // Ensure error modal can be closed
  $('#errorModal').on('hidden.bs.modal', function() {
    $('#errorModal .modal-body').html(''); // Clear modal content on close
  });



  $('#dashboard-right-content').on('submit','#createTaskForm', function(e) {
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
          $('#dashboard-right-content').html(response.html);               
          updateQuickStats();

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



  // change status of completed or uncompleted task
  $('#dashboard-right-content').on('click', '.completed-icon', function() {
    // determine the new status of task completion
    let newStatus;
    if ($(this).find('i').hasClass('bi-check-circle-fill')){      
      newStatus=0;
      console.log("check-circle-fill=1 : opposite: " + newStatus);
    } else if ($(this).find('i').hasClass('bi-circle')){  
      newStatus=1;    
      console.log("circle=0 : opposite: " + newStatus);
    }
    let task_id=$('.task-item-in-list-group').attr('data-id');
    let list_id=$('.task-item-in-list-group').attr('data-list');

    let url = $(this).attr('data-href') + "?list_id="+list_id;
    $.ajax({
      type: 'GET',
      url: url,
      success: function(response) {        
        // console.log("response " + response);
        if (response.status === 'success') {
          // console.log("response.html = " + response.html);
          $('#dashboard-right-content').html(response.html);              
          updateQuickStats();
          
        } else if (response.status === 'error'){
          
          $('#errorModal .modal-body').html(response.errors.map(function(error) {
            return '<p class="error-messages">' + error + '</p>';
          }).join(''));
            $('#errorModal').modal('show');    
        }
      },
      error: function(xhr) {
        console.error("Error fetching list: ", xhr);
      }
    });
  });


  
  // update importance
  $('#dashboard-right-content').on('click', '.important-icon', function() {
    // determine the new status of task completion
    let newStatus;
    if ($(this).find('i').hasClass('bi-check-circle-fill')){      
      newStatus=0;
      // console.log("check-circle-fill=1 : opposite: " + newStatus);
    } else if ($(this).find('i').hasClass('bi-circle')){  
      newStatus=1;    
      // console.log("circle=0 : opposite: " + newStatus);
    }
    let task_id=$('.task-item-in-list-group').attr('data-id');
    let list_id=$('.task-item-in-list-group').attr('data-list');

    let url = $(this).attr('data-href') + "?list_id="+list_id;
    $.ajax({
      type: 'GET',
      url: url,
      success: function(response) {        
        // console.log("response " + response);
        if (response.status === 'success') {
          // console.log("response.html = " + response.html);
          $('#dashboard-right-content').html(response.html);              
          updateQuickStats();
          
        } else if (response.status === 'error'){
          
          $('#errorModal .modal-body').html(response.errors.map(function(error) {
            return '<p class="error-messages">' + error + '</p>';
          }).join(''));
            $('#errorModal').modal('show');    
        }
      },
      error: function(xhr) {
        console.error("Error fetching list: ", xhr);
        $('#errorModal .modal-body').html("Error fetching list: ", xhr);
      }
    });
  });


  // to show Modal for editing task
  $('#dashboard-right-content').on('click', '.task-info', function(e) {
    console.log('editing task initiated');
    e.preventDefault();   
    
    var url = $(this).attr('data-href');    
    $.ajax({
      type: 'GET',
      url: url,
      success: function(response) {        
        $('#editTaskModal .modal-body').html(response);
        $('#editTaskModal').modal('show');
      },
      error: function(xhr) {
        console.error("Error fetching list: ", xhr);
      }
    });
  });

  
  $('#dashboard-right-content').on('submit','#editTaskForm', function(e) {
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
          $('#dashboard-right-content').html(response.html);               
          updateQuickStats();

          // hiding modal
          $('#editTaskModal').modal('hide');

          // backdrop isn't hidden with modal, so manually removing the backdrop element
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove(); 

        } else if (response.status === 'error') {
          // rendering error messages in the modal
          $('#editTaskModal #modal-errors').html(response.errors.map(function(error) {
            return '<p class="error-messages">' + error + '</p>';
          }).join(''));
        }
      },
      error: function(xhr) {
        $('#editTaskModal .modal-body').html('<p>An internal server error occurred. Please try again later.</p>');
      }
    });
  });



  
  // delete task
  $('#dashboard-right-content').on('click','.delete-task-button', function(e) {     
    let list_id=$(this).attr('data-list');
    let deleteUrlTask=$(this).attr('data-href');
    console.log('list_id:' + list_id + ' deleteUrlTask:' + deleteUrlTask);
    
    $.ajax({
        type: 'GET',
        url: deleteUrlTask + "?list_id=" + list_id,
        success: function(response) {
          if (response.status === 'success') {              
             $('#editTaskModal').modal('hide');
              $('#dashboard-right-content').html(response.html);  
          } else if (response.status === 'error') {
            $('#errorModal .modal-body').html(response.errors.map(function(error) {
              return '<p class="error-messages">' + error + '</p>';
            }).join(''));
              $('#errorModal').modal('show');
              $('#deleteListModal').modal('hide');              
          }
        },
        error: function(xhr) {
            console.error("Error deleting list: ", xhr);
            var errorHtml = '<p>There was an error deleting the list. Please try again later.</p>';
            $('#errorModal .modal-body').html(errorHtml);
            $('#errorModal').modal('show');
            $('#deleteListModal').modal('hide');
        }
    });
    
});




  /**
   * Updating all counts in quick statistics panel at once
   */
  function updateQuickStats(){               
    updateCount('#total-stats-for-list');     
    updateCount('#important-stats-for-list');
    updateCount('#complete-stats-for-list');
  }

   /**
   * Update the count displayed in the specified jQuery selector
   * 
   * @param {*} jqueryselector 
   * @param {*} url    * 
   * @param {string} jqueryselector - The jQuery selector of the element to update
   */
  
   function updateCount(jqueryselector){
    let url = $(jqueryselector).attr('data-href');
    $.ajax({
      type: 'GET',
      url: url,
      success: function(response) {
          // console.log(response.status);
          if (response.status === 'success') {
              $(jqueryselector).text(response.count);
          } else {
              console.error(response.error);
          }
      },
      error: function(xhr) {
          console.error("Error fetching count: ", xhr);
      }
    });
   }


});


