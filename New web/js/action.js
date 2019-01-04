function userdata()
      {
       var action = 'fetchdata';
       $.ajax({
        url:'/AdminUser.php',
        method:'POST',
        data:{action:action},
        success:function(data)
        {
         $('#user_data').html(data);
        }
       });
      }

      $(document).on('click', '.action', function()) {
       var user_id = $(this).data('userid');
       var user_status = $(this).data('status');
       var action = 'change';
       $('#message').html('');
       if(confirm("Do you want to banned this user account "))
       {
        $.ajax({
         url:'/AdminUser.php',
         method:'POST',
         data:{userid:userid, status:status, action:action},
         success:function(data)
         {
          if(data != '')
          {
           userdata();
           $('#message').html(data);
          }
         }
        });
       }
       else
       {
        return false;
       }
      });

     });
