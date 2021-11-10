$(document).ready(function() {  
    $(document).pjax('a', '#pjax');
    // if ($.support.pjax) {
    //     $.pjax.defaults.timeout = 500; // time in milliseconds
    // }
    $('ul.nav li.nav-item').click(function(){
        $(this).find('a').addClass('active');
        $(this).siblings().find('a').removeClass('active');
    });
    reloadPjax();
});

function reloadPjax(){
    const pathArray = window.location.pathname.split("/");
    let segment2 = pathArray[2];
    if(segment2 == undefined){
        $.pjax.reload('#pjax');
    }
}


