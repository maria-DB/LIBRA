$(function(){
    $.ajax({
        type:'GET',
        url:'/search/book/',
        data: {
            'book':'programming',
            'index':0,
        },
        dataType: 'json',
        success:function(data){
            $('#searchKeyword').val('programming');
            populateBookCards(data);
        }
    });

    $('#searchGoogleBook').on('click', function(e){
        e.preventDefault();
        var keyword = $('#searchKeyword').val();
        // console.log(keyword);
        if(keyword != " ") {
            $.ajax({
               type:'GET',
               url: '/search/book/',
               data: {
                   book: keyword,
                   index: 0,
               },
               dataType: 'json',
               success:function(data){
                    console.log(data);
                    populateBookCards(data);
               },
            });
        }
    });

    $('#searchBack').on('click',function(e){
        // e.preventDefault();
        var page = parseInt($('#currentPage').text()) - 1;
        var keyword = $('#searchKeyword').val();
        console.log(page);
        if(page >= 1 && keyword != ""){
            $.ajax({
                type:'GET',
                url:'/search/book/back',
                data:{
                    'page':page,
                    'index': $('#indexPage').text(),
                    'book': keyword
                },
                success:function(data){
                    console.log(data);
                    populateBookCards(data);
                    $('#currentPage').html(page);
                },
            })
        }

    });

    $('#searchNext').on('click',function(e){
        // e.preventDefault();
        var page = parseInt($('#currentPage').text()) + 1;
        var keyword = $('#searchKeyword').val();
        console.log(page);
        if(page >= 1 && keyword != ""){
            $.ajax({
                type:'GET',
                url:'/search/book/next',
                data:{
                    'page':page,
                    'index': $('#indexPage').text(),
                    'book': keyword
                },
                success:function(data){
                    console.log(data);
                    populateBookCards(data);
                    $('#currentPage').html(page);
                },
            })
        }

    });

    function populateBookCards(data) {
        $(".book-cards").empty();
        var image,isbn,author,desc = "";
        $.each(data.items, function(key,value){
            
            if(value.volumeInfo.imageLinks === undefined) {
                image = "./img/no_thumbnail.svg";
            } else {
                image = value.volumeInfo.imageLinks.thumbnail;
            }

            if(value.volumeInfo.industryIdentifiers === undefined || 
                value.volumeInfo.hasOwnProperty('industryIdentifiers') === false) 
            {
                
                isbn = "0000000000000";
            } else {
                isbn = value.volumeInfo.industryIdentifiers[0].identifier;
            }

            if(value.volumeInfo.authors === undefined || value.volumeInfo.hasOwnProperty('authors') === false) {
                author = "not available";
            } else {
                author = value.volumeInfo.authors[0];
            }
            if(value.volumeInfo.description === undefined || value.volumeInfo.hasOwnProperty('description') === false) {
                desc = "not description";
            } else {
                desc = value.volumeInfo.description;
            }

            $(".book-cards").append('<div class="col-6 col-sm-4 col-lg-3 col-xl-2">'+
            '<div class="card"><div class="card__cover"><img src="'+image+'" alt="" height="230px">'+
            '<a href="#" class="card__play"><i class="icon ion-ios-play"></i></a></div>'+
            '<div class="card__content"><h3 class="card__title"><a href="#">'+value.volumeInfo.title+'</a></h3>'+
            '<span class="card__category"><a href="#">'+value.volumeInfo.categories+'</a>'+
            '</span><span class="card__rate"><a href="/add/book/collection/?title='+value.volumeInfo.title+'&desc='+desc+''+
            '&isbn='+isbn+'&author='+author+'&genre='+value.volumeInfo.categories+'&cover='+image+'">'+
            '<i class="icon ion-ios-add"></i>Add to shelf</span></div></div></div>');
        });
    }
});