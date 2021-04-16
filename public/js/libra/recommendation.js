$(function(){
    $('#filterbttn').on('click', function(e){
        e.preventDefault();
        // see line 178 -> get the value of input in the input tag. 
        var genre=$('#filterSelected').val();
        console.log(genre);
        $.ajax({
            type:'GET',
            url:'/get/book/filter',
            data:{
                'genre':genre,
            },
            dataType:'json',
            success:function(data){
                console.log(data);
                $('#book-cards').empty();
                $.each(data, function(key,value){
                    $("#book-cards").append('<div class="col-6 col-sm-4 col-lg-3 col-xl-2">'+
                    '<div class="card"><div class="card__cover"><img src="'+value.cover+'" alt="" height="230px">'+
                    '<a href="/reviews/?isbn='+value.isbn+'" class="card__play"><i class="icon ion-ios-play"></i></a></div>'+
                    '<div class="card__content"><h3 class="card__title"><a href="#">'+value.title+'</a></h3>'+
                    '<span class="card__category"><a href="#">'+value.genre+'</a>'+
                    '</span><span class="card__rate"><a href="/add/book/collection/?title='+value.title+'&desc='+value.desc+''+
                    '&isbn='+value.isbn+'&author='+value.author+'&genre='+value.genre+'&cover='+value.cover+'" target="_blank">'+
                    '<i class="icon ion-ios-add"></i>Add to shelf</span></div></div></div>');
                })
            }
        })

    })
    

})