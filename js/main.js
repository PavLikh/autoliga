$(document).on('click', '#button1', function(){
  let txt = 'Hello';
  $.ajax({
    url: 'index.php',
    type: 'POST',
    data: txt,
    success: function(data){
     $('p.out').text(txt);
   },
    error: function(){
	console.log('ERROR');
    }
 })
})

$('.edit').on('click', function() {
//$(document).on('click', '.edit', function() {
    //var city = 'Moscow';
    var city = 'ИЩЕМ ГДЕ В BODY ЭТО ВЫВОДИТСЯ';
    $.ajax({
        url: 'detail.php',
        type: 'POST',
        data: {
            city: test,
            vehicle: vehicleId
        },
        dataType: 'html',
        success: function(data) {
            $('body').html(data); /* выведет Moscow на странице */
        }
    });
});


// $(document).ready(function(){
// alert('Ваша версия jQuery ' + jQuery.fn.jquery);
// });
