$(document).ready(function () {
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

    $('.btn-delete-book').click(function() {   
        var bookId = $(this).parent().parent().attr('book-id'); 
        $.confirm({
            title: 'Delele',
            content: 'Do you want to delete?',
            columnClass: 'small',
            buttons: {
                Yes: function () {
                    var url = window.location.pathname + '/delete/' + bookId;
                    window.open(url, "_self");
                },
                No: function () {
                    
                }
            }
        });
    });

    $('.btn-delete-categories').click(function() {   
        var cateId = $(this).parent().parent().attr('cate-id'); 
        $.confirm({
            title: 'Delele',
            content: 'Do you want to delete?',
            columnClass: 'small',
            buttons: {
                Yes: function () {
                    var url = window.location.pathname + '/delete/' + cateId;
                    window.open(url, "_self");
                },
                No: function () {
                    
                }
            }
        });
    });

    $('.btn-delete-order').click(function() {   
        var orderId = $(this).parent().parent().attr('order-id'); 
        $.confirm({
            title: 'Delele',
            content: 'Do you want to delete?',
            columnClass: 'small',
            buttons: {
                Yes: function () {
                    var url = window.location.pathname + '/delete/' + orderId;
                    window.open(url, "_self");
                },
                No: function () {
                    
                }
            }
        });
    });

});
