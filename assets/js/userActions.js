function subscribe(userTo, userFrom, button){

    if(userTo == userFrom){
        alert("Du kannst dich nicht selber Abonnieren!");
        return;
    }

    $.post("ajax/subscribe.php", { userTo: userTo, userFrom: userFrom})
    .done(function(count){
        if(count != null){
            $(button).toggleClass("subscribe unsubscribe");

            var buttonText= $(button).hasClass("subscribe") ? "ABONNIEREN" : "ABONNIERT";
            $(button).text(buttonText+ " " + count);
        }
        else{
            alert("Ups. Something went wrong");
        }
    });
}