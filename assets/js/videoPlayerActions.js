function likeVideo(button, videoId){
    // AJAX POST call to transfer data without reloading page
    $.post("ajax/likeVideo.php", {videoId: videoId})
    .done(function(data){

        // get reference to Buttons
        var likeButton = $(button);
        var dislikeButton = $(button).siblings(".dislikeButton");

        // Add Button Class 
        likeButton.addClass("active");
        dislikeButton.removeClass("active");

        var result = JSON.parse(data);
        updateLikesValue(likeButton.find(".text"), result.likes);
        updateLikesValue(dislikeButton.find(".text"), result.dislikes);

        // Change Thumb image
        if(result.likes<0){
            likeButton.removeClass("active");
            likeButton.find("img:first").attr("src", "assets/images/icons/like.png")
        }
        else{
            likeButton.find("img:first").attr("src", "assets/images/icons/liked.png")
        }

        dislikeButton.find("img:first").attr("src", "assets/images/icons/dislike.png")
    });
}

//////////////////////////////////////////////////////////////////////////////
function disLikeVideo(button, videoId){
    // AJAX POST call to transfer data without reloading page
    $.post("ajax/dislikeVideo.php", {videoId: videoId})
    .done(function(data){

        // get reference to Buttons
        var dislikeButton = $(button);
        var likeButton = $(button).siblings(".likeButton");

        // Add Button Class 
        dislikeButton.addClass("active");
        likeButton.removeClass("active");

        var result = JSON.parse(data);
        updateLikesValue(likeButton.find(".text"), result.likes);
        updateLikesValue(dislikeButton.find(".text"), result.dislikes);

        // Change Thumb image
        if(result.dislikes<0){
            dislikeButton.removeClass("active");
            dislikeButton.find("img:first").attr("src", "assets/images/icons/dislike.png")
        }
        else{
            dislikeButton.find("img:first").attr("src", "assets/images/icons/disliked.png")
        }

        likeButton.find("img:first").attr("src", "assets/images/icons/like.png")
    });
}

function updateLikesValue(element, num){
    var likesCountVal= element.text() || 0;
    element.text(parseInt(likesCountVal) + parseInt(num));
}