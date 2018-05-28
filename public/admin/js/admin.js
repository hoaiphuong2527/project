$(document).ready(function () {
    //check all checkbox
    $('.btn-delete-user').click(function() {   
        var userId = $(this).parent().parent().attr('user-id'); 
        $.confirm({
            title: 'Delele',
            content: 'Do you want to delete?',
            columnClass: 'small',
            buttons: {
                Yes: function () {
                    var url = window.location.pathname + '/delete/' + userId;
                    window.open(url, "_self");
                },
                No: function () {
                    
                }
            }
        });
    });

});
