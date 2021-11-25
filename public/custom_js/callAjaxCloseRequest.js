function callAPI(_this){
  let li_tag = $(_this).closest("li");
  let _report_id = $(li_tag).attr('id')
  let _token = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
      url: "/closehelprequest/closeRequest",
      type:'POST',
      data: {_token:_token, report_id:_report_id},
      success: function(data) {
        if(data == true){
            $(li_tag).remove();
            swal.fire({
              icon: 'success',
              title: 'Success!',
              html: `Close Success!`
          });
        }else{
          swal.fire({
              icon: 'error',
              title: 'Oops...',
              html: `Close Fail!`
          });
        }
      },
      error: function(err){
        swal.fire({
          icon: 'error',
          title: 'Oops...',
          html: `Close Fail!`
      });
    }
  });
}