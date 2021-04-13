$(function(){
	$.ajax({
        type:'GET',
        url:'/get/user/librarybook',
        dataType: 'json',
        success:function(data){
            // console.log(data);
            $.each(data[0].bookshelf, function(key,libro){
                // console.log('outer',libro.books);         
                    $('#usercataloglibrary').append(' <div class="col-6 col-sm-4 col-lg-3 col-xl-2"><div class="card">'+
                    '<div class="card__cover"><img src="'+libro.books.cover+'" alt="" id="cover_'+libro.bookshelfId+'"><a href="/reviews/?isbn='+libro.books.isbn+'" class="card__play">'+libro.books.isbn+''+
                    '<i class="icon ion-ios-play"></i></a></div><div class="card__content"><h3 class="card__title">'+
                    '<a href="#" id="title_'+libro.bookshelfId+'">'+libro.books.title+'</a></h3><span class="card__category">'+
                    '<a href="#"id="author_'+libro.bookshelfId+'">'+libro.books.author+'</a></span><span class="card__rate"><i class="icon ion-ios-star"></i>'+libro.type+'</span><br>'+
                    '<a href="#" class="favorites" data-id="'+libro.bookshelfId+'"><i class="icon ion-ios-heart"></i>Add to Favorites</a></div></div></div>');
                // });
         });
     }

 });

    $.ajax({
        type:'GET',
        url:'/book/favorites/true',
        dataType: 'json',
        success:function(data){
            console.log(data);
            $.each(data[0].bookshelf, function(key,libro){
                console.log('outer', libro.books);
               myfavoritetemplate(libro.books.cover, libro.books.isbn, libro.books.title);

        });
    }
    });

    $('#usercataloglibrary').on('click', '.favorites', function(e){
        e.preventDefault();
        var Fav=$(this).data('id');
        console.log(Fav);
        console.log($('meta[name="csrf-token"]').attr('content'));
        $.ajax({
            type:'PUT',
            url:'/favorite',
            dataType:'json',
            data:{
                'id':Fav,
            },
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success:function(data){
            myfavoritetemplate($('#cover_'+Fav).attr('src'), $('#isbn_'+Fav).text(), $('#title_'+Fav).text());
            alert('Added to Favorites');
            $('[data-id="'+Fav+'"]').hide();
        }

        })
    });
    function myfavoritetemplate(cover, isbn, title, type){
        $('#myfavorites').append('<div class="col-6 col-sm-4 col-lg-3 col-xl-2"><div class="card"><div class="card__cover"><img src="'+cover+'" alt="">'+
        '<a href="/reviews/?isbn='+isbn+'" class="card__play"><i class="icon ion-ios-play"></i></a></div> <div class="card__content">'+
        '<h3 class="card__title"><a href="#">'+title+'</a></h3>'+
        '</div></div></div>');
    }
    
});
