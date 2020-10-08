function postComment(button, postedBy, videoId, replyTo, containerClass){
    var textarea= $(button).siblings("textarea");
    var commentText= textarea.val();
    textarea.val("");

    if(commentText){

        $.post("ajax/postComment.php", { commentText: commentText, postedBy: postedBy, videoId: videoId, responseTo: replyTo})
        .done(function(comment){

            if(!replyTo){
                $("." + containerClass).prepend(comment);
            }
            else{
                $(button).parent().siblings("." + containerClass).append(comment);
            }
        });
    }
    else{
        // no comment text, no work to do
    }
}

function toggleReply(button){
    var parent= $(button).closest(".itemContainer");
    var commentForm= parent.find(".commentForm").first();

    commentForm.toggleClass("hidden");
}


///////////////////////////////////////////////////////////////////////

function likeComment(commentId, button, videoId){
    // AJAX POST call to transfer data without reloading page
    $.post("ajax/likeComment.php", {commentId: commentId, videoId: videoId})
    .done(function(numToChange){

        // get reference to Buttons
        var likeButton = $(button);
        var dislikeButton = $(button).siblings(".dislikeButton");

        // Add Button Class 
        likeButton.addClass("active");
        dislikeButton.removeClass("active");

        var likesCount= $(button).siblings(".likesCount");
        updateLikesValue(likesCount, numToChange);

        // Change Thumb image
        if(numToChange<0){
            likeButton.removeClass("active");
            likeButton.find("img:first").attr("src", "assets/images/icons/like.png")
        }
        else{
            likeButton.find("img:first").attr("src", "assets/images/icons/liked.png")
        }

        dislikeButton.find("img:first").attr("src", "assets/images/icons/dislike.png")
    });
}


function dislikeComment(commentId, button, videoId){
    // AJAX POST call to transfer data without reloading page
    $.post("ajax/dislikeComment.php", {commentId: commentId, videoId: videoId})
    .done(function(numToChange){

        // get reference to Buttons
        var dislikeButton = $(button);
        var likeButton = $(button).siblings(".likeButton");

        // Add Button Class 
        dislikeButton.addClass("active");
        likeButton.removeClass("active");

        var likesCount= $(button).siblings(".likesCount");
        updateLikesValue(likesCount, numToChange);

        // Change Thumb image
        if(numToChange>0){
            dislikeButton.removeClass("active");
            dislikeButton.find("img:first").attr("src", "assets/images/icons/dislike.png")
        }
        else{
            dislikeButton.find("img:first").attr("src", "assets/images/icons/disliked.png")
        }

        likeButton.find("img:first").attr("src", "assets/images/icons/like.png")
    });
}

/////////////////////////////////////////////////////////////////////

function updateLikesValue(element, num){
    var likesCountVal= element.text() || 0;
    element.text(parseInt(likesCountVal) + parseInt(num));
}

function getReplies(commentId, button, videoId){
    $.post("ajax/getCommentReplies.php", { commentId: commentId, videoId: videoId})
    .done(function(comments){
        var replies= $("<div>").addClass("repliesSection");
        replies.append(comments);

        $(button).replaceWith(replies);
    })
}