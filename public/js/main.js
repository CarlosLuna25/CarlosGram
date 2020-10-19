var url= 'http://carlosgram.com.devel';
window.addEventListener("load", function () {
    //colocar cursor pointer
    $(".btn-like").css("cursor", "pointer");
    $(".btn-dislike").css("cursor", "pointer");

    //boton de like
    function like() {
        $(".btn-like").unbind('click').click(function () {
            console.log("like");
            $(this).addClass("btn-dislike").removeClass("btn-like");
            $(this).attr("src", url+"/images/hearts-red.png");
            $.ajax({
                url: url+'/like/'+$(this).data('id'),
                type: 'GET',
                success: function (response) {
                    if(response.like){
                        console.log('has dado like a la publicacion');
                    }
                    else{
                        console.log('error al dar like a la publicacion');
                    }
                }
            });
            dislike();
        });

    }
    like();

    //boton de dislike
    function dislike() {
        $(".btn-dislike").unbind('click').click(function () {
            console.log("dislike");
            $(this).addClass("btn-like").removeClass("btn-dislike");
            $(this).attr("src", url+"/images/hearts-grey.png");
            $.ajax({
                url: url+'/dislike/'+$(this).data('id'),
                type: 'GET',
                success: function (response) {
                    if(response.like){
                        console.log('has dado dislike a la publicacion');
                    }else{
                        console.log('error al dar dislike a la publicacion');
                    }
                }
            });
            like();
        });
    }
    dislike();
});
