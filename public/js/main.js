$(document).ready(function() {


 



  const inputNumber = $('#input-number');

  $('.minus').on('click', function() {

    $myval = $(this).parent().find('input').val();

    $price = $(this).closest('.Price').find('.MyPrice').val();

    $count = $(this).closest('.Price').find('.InMuber').val();
    
    console.log($price*$count);

    $("#totalPrice").val($price*$count);

    if($myval > 1) {
      $(this).parent().find('input').attr( "value", parseInt($myval)-1 );
      $price = $(this).closest('.Price').find('.MyPrice').val();
      $count = $(this).closest('.Price').find('.InMuber').val();
      console.log($price*$count);
      $("#totalPrice").val($price*$count);
    }

  });

  $('.plus').on('click', function() {
    $myval = $(this).parent().find('input').val();
        $(this).parent().find('input').attr( "value", parseInt($myval)+1 );
        $myval = $(this).parent().find('input').val();

        $price = $(this).closest('.Price').find('.MyPrice').val();
     
        $count = $(this).closest('.Price').find('.InMuber').val();
        
        console.log($price*$count);
    
        $("#totalPrice").val($price*$count);
    
  });



  $(".number-input button").attr("disabled", true);

  $('.RemoveElement').on('click', function() {
    var myid = $(this).data('id') ?? 0;
    $(this).closest('.OneCart').css({"display":"none"});
    console.log($(this).closest('.OneCart'));
    $.ajax({
    type: 'GET',
    url: `removeElement/${myid}`,
    success: function (data) {
      location.reload();
    },
    error: function (data) {

    }
});

});




  $('.SelectSUb').on('click', function() {

    $('.Price').find('button').attr("disabled", true);

    $(this).parent().parent().parent().parent(3).parent().find('button').attr("disabled", false);

    $(this).parent().parent().parent().parent(3).parent().find('input').attr("disabled", false);
    
    console.log($('Price').find('button').html() );
  });

  $('.SelectSUb').on('click', function() {
    $price = $(this).closest('.Price').find('.MyPrice').val();
    $count = $(this).closest('.Price').find('.InMuber').val();
    console.log($price*$count);
    $("#totalPrice").val($price*$count);
  });

  $(document).ready(function() {
    $(window).keydown(function(event){
      if(event.keyCode == 13) {
        event.preventDefault();
        return false;
      }
    });
  });
  

});
