$(document).ready(function() {
    $('.nav').onePageNav();
    
    // нажатие на кнопку - выпадает модальное окно
    $('a.btn.btn-primary.md').click(function(event){
        event.preventDefault();
         

        var url = 'showclaim';
        var clickedbtn = $(this);
        //var UserID = clickedbtn.data("userid");
         
        var modalContainer = $('#my-modal');
        var modalBody = modalContainer.find('.modal-body');
        //modalContainer.modal({show:true});
        var insidemodalBody = modalContainer.find('.claim-form-wrapper');
        $('#success').hide();
        $('#claim-phone').val('');
        $('#claim-text').val('');
        insidemodalBody.show();
    });

    // Отправим форму
    $(document).on("submit", '.claim-form', function (e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            //url: "?r=claim/create",
            url: "?r=claim/create",
            type: "POST",
            data: form.serialize(),
            success: function (result) {
                console.log(result);
                var modalContainer = $('#my-modal');
                var modalBody = modalContainer.find('.modal-body');
                var insidemodalBody = modalContainer.find('.claim-form-wrapper');

                if (result) {
                    //insidemodalBody.html(result).hide(); // 
                    insidemodalBody.hide(); // 
                    //$('#my-modal').modal('hide');
                    $('#success').html("<div class='alert alert-success'>");
                    $('#success > .alert-success').append("<strong>Thank you! Your message has been sent.</strong>");
                    $('#success > .alert-success').append('</div>');
                    $('#success').show();

                    setTimeout(function() { // скрываем modal через 4 секунды
                        $("#my-modal").modal('hide');
                        location.href = "?r=claim/index";
                    }, 4000);
                }
                else {
                    //return false;
                    //modalBody.html(result).hide().fadeIn();
                }
            }
        });
    }); 
});
