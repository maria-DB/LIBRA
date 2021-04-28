$(function(){
    
    var isbn= new window.URLSearchParams(window.location.search);
    console.log(isbn.get('isbn'));
    var bookDetails =  new Object();
    
    $.ajax({
        type:'GET',
        url:'/reviews/get/?'+isbn,
        dataType: 'json',
        success:function(data){
            // console.log(data);

            // populating data
            details(data);
            bookComments(data);
            addReviews(data);
            userRatings(data);

            // add to database
            addBook();

            //get recommended
            getRecommended();
        },
    });

    $('#postComment').on('click',function(e){
        e.preventDefault();
        var userComment = $('#userComment').val();

        if(userComment != ""){
            $.ajax({
                type:'POST',
                url: '/add/book/comment',
                data:{
                    'comment':userComment,
                    'isbn':bookDetails.isbn,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data){
                    if(data != 0){
                        // console.log('comment if',data);
                        commentTemplate(data[0].user.username, data[0].updated_at, data[0].comment,data[0].user.photo);
                        $('#userComment').val('');
                    }
                },
            });
        }
    });

    function addBook(){
        $.ajax({
            type:'GET',
            url:'/add/book/collection/?isbn='+bookDetails.isbn+'&title='+bookDetails.title+'&desc='+bookDetails.desc+''+
                '&author='+bookDetails.author+'&genre='+bookDetails.genre+'&cover='+bookDetails.cover+'',
            success:function(data){
                console.log('book added',data);
            },
            error:function(e){
                console.log('error saan', e);
            }
        });
    };

    function details(data){
        var desc,author,cover,genre = "";
        $.each(data[0].items,function(key, book){   
            var title = book.volumeInfo.title;

            if(book.volumeInfo.imageLinks === undefined) {
                cover = "./img/no_thumbnail.svg";
            } else {
                cover = book.volumeInfo.imageLinks.thumbnail;
            }
            if(book.volumeInfo.authors === undefined || book.volumeInfo.hasOwnProperty('authors') === false) {
                author = "not available";
            } else {
                author = book.volumeInfo.authors;
            }
            if(book.volumeInfo.description === undefined || book.volumeInfo.hasOwnProperty('description') === false) {
                desc = "not description";
            } else {
                desc = book.volumeInfo.description;
            }
            if(book.volumeInfo.categories === undefined || book.volumeInfo.hasOwnProperty('categories') === false) {
                genre = "no genre"
            } else {
                genre = book.volumeInfo.categories[0];
            }

            bookDetails.title = title;
            bookDetails.cover = cover;
            bookDetails.genre = genre;
            bookDetails.author = author;
            bookDetails.desc = desc;
            bookDetails["isbn"] = isbn.get('isbn');

            $('#bookdetails').html(
                '<div class="col-12"><h1 class="details__title">'+title+'</h1>'+
                '</div><div class="col-10"><div class="card card--details card--series">'+
                '<div class="row"><div class="col-12 col-sm-4 col-md-4 col-lg-3 col-xl-3"><div class="card__cover">'+
                '<img src="'+cover+'" alt=""></div></div><div class="col-12 col-sm-8 col-md-8 col-lg-9 col-xl-9">'+
                '<div class="card__content"><div class="card__wrap"><ul class="card__list"><li>Type: '+book.volumeInfo.printType+'</li>'+
                '<li>Language: '+book.volumeInfo.language+'</li><li>'+genre+'</li></ul>'+
                '</div><ul class="card__meta"><li><span>Genre:</span><a href="#">'+genre+'</a></li><li>'+
                '<span>Author/s:</span>'+ $.each(author, function(authors){authors})+'</li>'+
                '<li><span>Publisher:</span>'+book.volumeInfo.publisher+'</li>'+
                '<li><span>Release year:</span>'+book.volumeInfo.publishedDate+'</li>'+
                '</ul><div class="card__description card__description--details">'+desc+'</div></div></div></div>');
        });
    };

    function bookComments(data)
    {
        $.each(data[2],function(key,value){
            commentTemplate(value.user.username,value.updated_at,value.comment,value.user.photo);
        }); 
    }

    function commentTemplate(username,updated_at,comment,image){
        $('#comments').append('<li class="comments__item"><div class="comments__autor">'+
        '<img class="comments__avatar" src="../storage/'+image+'" alt="">'+
        '<span class="comments__name">'+username+'</span>'+
        '<span class="comments__time">'+dateConverter(updated_at)+'</span>'+
        '</div><p class="comments__text">'+comment+'</p><div class="comments__actions">'+
        '</div></div></li>'
        );

        // <div class="comments__rate"><button type="button"><i class="icon ion-md-thumbs-up"></i>12</button>'+
        // {/* '<button type="button">7<i class="icon ion-md-thumbs-down"></i></button> */}

    }

    function dateConverter(comment_time){
        var date = new Date(comment_time).toDateString();
        return date;
    }

    // REVIEWS/RATING FUNCTIONS
    $('#addRating').on('click',function(e){
        e.preventDefault();
        var userRating = $('#userRating').val();
        if(userRating != ""){
            console.log(userRating);
            $.ajax({
                type:'POST',
                url: '/add/book/rating',
                data:{
                    'text':userRating,
                    'isbn':bookDetails.isbn,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data){
                    reviewTemplate(data[0].user.username,dateConverter(data[0].updated_at),bookDetails.title,data[0].rating);
                },
                complete:function(data){
                    $('#formRating').hide();
                }
            })
        }
    });
    
    function userRatings(data){
        $.each(data[3], function(key, value){
            reviewTemplate(value.user.username,dateConverter(value.updated_at),bookDetails.title,value.rating);
        });
    }

    function addReviews(data){
        $.each(data[1].results, function(key, value){
            reviewTemplate(value.byline,value.publication_d,value.book_title,value.summary,value.url);
        });
    }

    function reviewTemplate(name,pubdate,title,summary,url="#"){
        $('#reviews').append('<li class="reviews__item"><div class="">'+
                            '<span class="reviews__name">'+name+'</span>'+
                            '<span class="reviews__time">'+pubdate+' to '+title+'</span>'+
                            '</div><p class="reviews__text">'+summary+' '+
                            '<a href="'+url+'">see more at...</a></p></li>');
    }


    // RECOMMENDATION FUNCTIONS
    function getRecommended(){
        $.ajax({
            type:'GET',
            url:'/reviews/get/recommended/',
            data:{
                'isbn':isbn.get('isbn'),
            },
            dataType:'json',
            success:function(data){
                // console.log(data);
                $.each(data.data, function(key,value){
                    recoTemplate(value.title,value.isbn, value.cover, value.genre);
                    $('#seeMore').attr('data-isbn', value.isbn);
                });
                $('#moreLink').val(data.next_page_url);
                $('#seeMore').attr('data-link', data.next_page_url);
            },
        });
    }
        
    $('#seeMore').on('click', function(e){
        e.preventDefault();
        if($('#moreLink').val() === ""){
            $(this).hide();
        } else {           
            $.ajax({
                type:'GET',
            url: $('#moreLink').val(),
            data:{
                'isbn':isbn.get('isbn'),
            },
            dataType:'json',
            success:function(data){
                // console.log('see more', data);
                $.each(data.data, function(key,value){
                    recoTemplate(value.title,value.isbn, value.cover, value.genre);
                });
                $('#seeMore').attr('data-link', data.next_page_url);
                if(data.next_page_url !== "null"){
                    $('#moreLink').val(data.next_page_url);
                }
                },
            });
        }
    });

    function recoTemplate(title,isbn,cover,genre){
        $('#recommend').append('<div class="col-6 col-sm-4 col-lg-6"><div class="card"><div class="card__cover">'+
                                '<img src="'+cover+'" alt=""><a href="/reviews/?isbn='+isbn+'" class="card__play">'+
                                '<i class="icon ion-ios-play"></i></a></div><div class="card__content">'+
                                '<h3 class="card__title"><a href="#">'+title+'</a></h3>'+
                                '<span class="card__category"><a href="#">'+genre+'</a></span></div></div></div>');
    }

});