$(document).ready(function() {
  const inputNumber = $('#input-number');

  $('.minus').on('click', function() {

    $myval = $(this).parent().find('input').val();

    $price = $(this).closest('.Price').find('.MyPrice').val();

    $count = $(this).closest('.Price').find('.InMuber').val();
    
    console.log($price*$count);

    $("#totalPrice").val($price*$count);

    if($myval > 1) {
      $(this).parent().find('input').val( parseInt($myval)-1);
      $price = $(this).closest('.Price').find('.MyPrice').val();
      $count = $(this).closest('.Price').find('.InMuber').val();
      console.log($price*$count);
      $("#totalPrice").val($price*$count);
    }

  });

  $('.plus').on('click', function() {
    $myval = $(this).parent().find('input').val();
        $(this).parent().find('input').val( parseInt($myval)+1);
        $myval = $(this).parent().find('input').val();

        $price = $(this).closest('.Price').find('.MyPrice').val();
    
        $count = $(this).closest('.Price').find('.InMuber').val();
        
        console.log($price*$count);
    
        $("#totalPrice").val($price*$count);
    
  });



  $(".number-input button").attr("disabled", true);





  $('.SelectSUb').on('click', function() {
    $('.Price').find('button').attr("disabled", true);
    $(this).parent().parent().parent().parent(3).parent().find('button').attr("disabled", false);
    console.log($('Price').find('button').html() );
  });

  $('.SelectSUb').on('click', function() {
    $price = $(this).closest('.Price').find('.MyPrice').val();
    $count = $(this).closest('.Price').find('.InMuber').val();
    console.log($price*$count);
    $("#totalPrice").val($price*$count);
  });



});
