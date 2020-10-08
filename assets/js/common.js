$(document).ready(function(){
    
    // show/ hide menu button function
    $(".navShowHide").on("click", function(){
        var main = $("#mainSectionContainer");
        var nav = $("#sideNavContainer");

        // hide or show content
        if(main.hasClass("leftPadding")){
            nav.hide();
        }
        else {
            nav.show();
        }

        // toggle leftPadding
        main.toggleClass("leftPadding");
    });

});

function notSignedIn(){
    alert("Bitte anmelden um diese Funktion zu nutzen");
}