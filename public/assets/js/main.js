// fetch API endpoints
$.get("../../src/classes/ControllerAid/ControllerAid.class.php", {
    FetchEndPoints: true
});


// disable and enable employee form  in the employee manager widget 
$("#editForm").click(function(){
    let editButton = $(this);
    editButton.fadeOut(250, function(){
        let form = editButton.parents('form');
        form.find('input, select').removeAttr('disabled');
        form.find('.save-staff').removeClass('d-none').hide(0, function(){
            $(this).slideDown(250)
        })
    }); 
});
$('body').on('click', '.cancel-staff-editing', function(){
    let cancelButton = $(this);
    cancelButton.parent().fadeOut(250, function() {
        let form = cancelButton.parents('form');
        form.find('input, select').removeAttr('disabled');
        form.find('#editForm').slideDown(250);
        
    }); 
});