/*
En este archivo se debe colocar código común a muchas paginas o todas.
*/

(function($) {
    var $body = $('body');

////DELETE FORMS: form con botón "delete" para eliminar el registro////////////////////////////////////////////////////
////debe lanzar un mensaje de confirmación antes de ejecutar la acción de eliminación.
    var deleteBtnSelectors = '.delete-btn, button[value="Delete"]',
        deleteFormSelector = 'form:has(' + deleteBtnSelectors + ')';

    function formWithDeleteBtnSubmit (e) {
        var $this = $(this),
            deleteBtn = $this.find(deleteBtnSelectors),
            deleteMessage = deleteBtn.data('delete-message') || '¿Esta seguro en Eliminar el Registro?';

        //if delete message is confirmed
        if (!confirm(deleteMessage)) {
            //Prevent to submit form
            e.preventDefault();
        }
    }

    $body.on('submit', deleteFormSelector, formWithDeleteBtnSubmit);
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}(jQuery));