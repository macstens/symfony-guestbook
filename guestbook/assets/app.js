/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';
require('bootstrap');

$.ajax(
    '/guestbook/form', 
    { 
        success : function(data, textStatus, jqXHR) {
            let form = $(data).find('#create-form');
            $('#form-guestbook-new').html(form).on('submit', function(){
                let formContainer = $(this);
                formContainer.find('#create-new-submit-button').attr('disabled', 'disabled').find('.spinner-border').removeClass('d-none').end().find('.text-state').hide();
                $.ajax('/guestbook/new',
                {
                    method: 'POST',
                    data: formContainer.find('form').serializeArray(),
                    success : function(data, textStatus, jqXHR) {
                        formContainer.find('#create-new-submit-button').removeAttr('disabled')
                            .find('.spinner-border').addClass('d-none').end()
                            .find('.text-state').show().end().end()
                            .find('form').trigger('reset');
                        $("#formToastSuccess").removeClass('hide').addClass("show");
                    }
                });
                return false;
            });
        }
    }
);