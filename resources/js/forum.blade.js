$(document).ready(function(){

    $.ajaxSetup({
        beforeSend: function(xhr, type) {
            if (!type.crossDomain) {
                xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
            }
        },
    });

    $('.like').on('click', function(event){
        event.preventDefault();
        console.log('clicked');
        var isLiked = event.target.previousElementSibling == null;
        var postId = event.target.parentNode.parentNode.dataset['postid'];
        
        $.ajax({
            method: 'POST',
            data: JSON.stringify({isLiked: isLiked, postId: postId}),
            url: '/like',
            contentType: "application/json;charset=utf-8",
            success: function(){
                console.log('success');
            },
            error: function(){
                console.log('error!');
            } 
        })
            .done(function(){
                if (isLiked) {
                    switch(event.target.textContent) {
                        case 'Like':
                            event.target.textContent = 'You like this post';
                            event.target.nextElementSibling.textContent = 'Dislike';
                            break;
                        case 'You like this post':
                            event.target.textContent = 'Like';
                            event.target.nextElementSibling.textContent = 'Dislike';
                            break;
                    }
                } else {
                    switch(event.target.textContent) {
                        case 'Dislike':
                            event.target.textContent = 'You dislike this post'; 
                            event.target.previousElementSibling.textContent = 'Like';
                            break;
                        case 'You dislike this post':
                            event.target.textContent = 'Dislike';
                            event.target.previousElementSibling.textContent = 'Like';
                            break;
                }
            }
        });
    })
});