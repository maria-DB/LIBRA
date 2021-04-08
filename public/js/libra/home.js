$(function(){
	$.ajax({
        type:'GET',
        url:'/home/popular',
        dataType: 'json',
        success:function(data){
            console.log(data);
        $.each(data.results.books, function(key,value){
            $('#newest').append('<div class="col-6 col-sm-12 col-lg-6"><div class="card card--list"><div class="row">'+
            '<div class="col-12 col-sm-4"><div class="card__cover"><img src="'+value.book_image+'" alt=""><a href="#" class="card__play">'+
            '<i class="icon ion-ios-play"></i></a></div></div><div class="col-12 col-sm-8"><div class="card__content">'+
            '<h3 class="card__title"><a href="#">'+value.title+'</a></h3><span class="card__category"><a href="#">'+value.author+'</a></span>'+
            '<div class="card__wrap"><span class="card__rate"><i class="icon ion-ios-star"></i>8.4</span><ul class="card__list">'+
            '<li>Book</li><li>16+</li></ul></div><div class="card__description"><p>'+value.description+'</p></div></div></div></div></div></div>');

        });
     }

 });
});
