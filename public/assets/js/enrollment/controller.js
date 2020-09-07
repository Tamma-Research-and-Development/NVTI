import { api_resquest_maker } from './../util/ajaxHandler.js'; // function
import { apiEndpoints } from './../util/apiEndpoints.js';      // object
import { fileEndPoints } from './../util/fileEndPoints.js';    // object
import { components } from './../util/components.js';          // object

class enrollment {
    
    constructor() {
        this.skipsHandler();
        this.addDynamicContent();
        this.addApplicant();
        this.imageSelection();

        // setInterval(() => {
        //     console.log($("input[name='academic_status']:checked").val());
        // }, 100);
    }

    skipsHandler() {
        $(".skip").click(function() {
            const option       =  $(this).attr('name');
            const content      =  $(this).data('skip');
            const optionValue  =  $("input[name='"+option+"']:checked").val();
            if (components.homepage.skipElements[content] == "") {
                $(this).parents('.skip-container').find(".skip-section").removeClass('shadow p-3 alert-info');
            } else {
                $(this).parents('.skip-container').find(".skip-section").addClass('shadow p-3 alert-info');
            }
            $(this).parents('.skip-container').find(".skip-section").html(components.homepage.skipElements[content]);
        });
    }

    imageSelection() {
        $("#photo").change(function() {
            let file       = $(this)[0].files[0];
            let temp_image = URL.createObjectURL( file );
            $("#photo-bg").css('background-image',  'url('+temp_image+')' );
        });
    }

    addDynamicContent() {
        // auto add name to terms
        setInterval(() => {
            const first_name    =  $("#applicant_first_name").val();
            const middle_name   =  $("#applicant_middle_name").val();
            const last_name     =  $("#applicant_last_name").val();
            $("#student-name-for-terms").text( first_name +' '+ middle_name +' '+ last_name );
        }, 300);
        // auto add date
        var d = new Date();
        $("#date-for-terms").text( (d.getMonth()+1) +'/'+ d.getDate() +'/'+ d.getFullYear() );
    }

    addApplicant() {
        $("#enrollment-form").submit( (event) => {
            event.preventDefault();
            // 
            const applicant_gender           =  ( $("input[name='applicant_gender']:checked").length < 1  ) ? '': $("input[name='applicant_gender']:checked").val() ;
            const applicant_tuition_status   =  ( $("input[name='applicant_tuition_status']:checked").length < 1  ) ? '': $("input[name='applicant_tuition_status']:checked").val() ;
            const academic_status            =  ( $("input[name='academic_status']:checked").length < 1  ) ? '': $("input[name='academic_status']:checked").val() ;
            const previousVocationSchool     =  ( $("input[name='previousVocationSchool']:checked").length < 1  ) ? '': $("input[name='previousVocationSchool']:checked").val() ;

            const Emergency_Contact_gender   = ( $("input[name='Emergency_Contact_gender']:checked").length < 1 ) ? '': $("input[name='Emergency_Contact_gender']:checked").val();
 

            // 
            const Auto_CAD                =  ($("input[name='Courses_selection_Auto_CAD']:checked").length < 1)  ? 'no': $("input[name='Courses_selection_Auto_CAD']:checked").val();
            const Architectural_Drafting  =  ($("input[name='Courses_selection_Architectural_Drafting']:checked").length < 1 ) ? 'no' : $("input[name='Courses_selection_Architectural_Drafting']:checked").val();
            const Auto_Mechanic           =  ($("input[name='Courses_selection_Auto_Mechanic']:checked").length < 1 ) ? 'no':  $("input[name='Courses_selection_Auto_Mechanic']:checked").val();
            const Building_Construction   =  ($("input[name='Courses_selection_Building_Construction']:checked").length < 1 ) ? 'no':  $("input[name='Courses_selection_Building_Construction']:checked").val();
            const Blue_Print_Reading      =  ($("input[name='Courses_selection_Blue_Print_Reading']:checked").length < 1 ) ? 'no':  $("input[name='Courses_selection_Blue_Print_Reading']:checked").val();
            const Beauty_Therapy          =  ($("input[name='Courses_selection_Beauty_Therapy']:checked").length < 1 ) ? 'no':  $("input[name='Courses_selection_Beauty_Therapy']:checked").val();
            const Carpentry               =  ($("input[name='Courses_selection_Carpentry']:checked").length < 1 ) ? 'no':  $("input[name='Courses_selection_Carpentry']:checked").val();
            const Computer_Software       =  ($("input[name='Courses_selection_Computer_Software']:checked").length < 1 ) ? 'no':  $("input[name='Courses_selection_Computer_Software']:checked").val();
            const Computer_Hardware       =  ($("input[name='Courses_selection_Computer_Hardware']:checked").length < 1 ) ? 'no':  $("input[name='Courses_selection_Computer_Hardware']:checked").val();


            const Software_Professional     =   ($("input[name='Courses_selection_Computer_Software_Professional']:checked").length < 1 ) ? 'no':  $("input[name='Courses_selection_Computer_Software_Professional']:checked").val();
            const Catering                  =   ($("input[name='Courses_selection_Catering']:checked").length < 1 ) ? 'no':  $("input[name='Courses_selection_Catering']:checked").val(); 
            const Electricity               =   ($("input[name='Courses_selection_Electricity']:checked").length < 1 ) ? 'no':  $("input[name='Courses_selection_Electricity']:checked").val(); 
            const Event_Management          =   ($("input[name='Courses_selection_Event_Management']:checked").length < 1 ) ? 'no':  $("input[name='Courses_selection_Event_Management']:checked").val(); 
            const Electronic                =   ($("input[name='Courses_selection_Electronic']:checked").length < 1 ) ? 'no':  $("input[name='Courses_selection_Electronic']:checked").val(); 
            const Estimating                =   ($("input[name='Courses_selection_Estimating']:checked").length < 1 ) ? 'no':  $("input[name='Courses_selection_Estimating']:checked").val(); 
            const Fashion_Design            =   ($("input[name='Courses_selection_Fashion_Design']:checked").length < 1 ) ? 'no':  $("input[name='Courses_selection_Fashion_Design']:checked").val(); 
            const Hotel_Management          =   ($("input[name='Courses_selection_Hotel_Management']:checked").length < 1 ) ? 'no':  $("input[name='Courses_selection_Hotel_Management']:checked").val(); 
            const Interior_Decoration       =   ($("input[name='Courses_selection_Interior_Decoration']:checked").length < 1 ) ? 'no':  $("input[name='Courses_selection_Interior_Decoration']:checked").val(); 
            const Tailoring                 =   ($("input[name='Courses_selection_Tailoring']:checked").length < 1 ) ? 'no':  $("input[name='Courses_selection_Tailoring']:checked").val(); 
            const Pastry                    =   ($("input[name='Courses_selection_Pastry']:checked").length < 1 ) ? 'no':  $("input[name='Courses_selection_Pastry']:checked").val(); 
            const Plumbling                 =   ($("input[name='Courses_selection_Plumbling']:checked").length < 1 ) ? 'no':  $("input[name='Courses_selection_Plumbling']:checked").val(); 
            const Project_Managament        =   ($("input[name='Courses_selection_Project_Managament']:checked").length < 1 ) ? 'no':  $("input[name='Courses_selection_Project_Managament']:checked").val(); 




            const Terms_and_conditions    =  ($("input[name='Terms_and_conditions']:checked").length < 1 ) ? 'no':  $("input[name='Terms_and_conditions']:checked").val();

            // 
            var form = new FormData();
            form.append("photo",   $("#photo")[0].files[0] );
            form.append("Fullname",  $("#applicant_first_name").val() +' '+$("#applicant_middle_name").val()+' '+$("#applicant_last_name").val() );
            form.append("Mobile",  $("#applicant_phone").val()   );
            form.append("status",  'applicant' );
            form.append("emial",  $("#applicant_email").val()   );
            form.append("gender",  applicant_gender  );
            form.append("DOB",     $("#applicant_DOB").val()   );
            form.append("place_of_birth",   $("#applicant_Place_of_Birth").val()   );
            form.append("nationality",  $("#applicant_Nationalities").val()   );
            form.append("address",  $("#applicant_Address").val()   );
            form.append("tuition_status",  applicant_tuition_status );
            form.append("t_s_institution_or_sponsor_name",  ( $("#scholarship_provider").val() ==  undefined ) ? 'none' : $("#scholarship_provider").val() );
            form.append("t_s_phone", ( $("#scholarship_provider_phone").val() ==  undefined ) ? 'none' : $("#scholarship_provider_phone").val() );
            form.append("t_s_email", ( $("#scholarship_provider_email").val() ==  undefined ) ? 'none' : $("#scholarship_provider_email").val() );
            form.append("academic_status",  academic_status );
            form.append("first_time_attending_vocational_school",  previousVocationSchool );
            form.append("name_of_school_have_attended", ( $("#previous_vocation_school_name").val()  ==  undefined ) ? 'none' : $("#previous_vocation_school_name").val() );
            form.append("location_of_school_have_attended", ( $("#previous_vocation_school_Location").val() ==  undefined ) ? 'none' : $("#previous_vocation_school_Location").val() );
            form.append("Courses_selection_Auto_CAD",  Auto_CAD );
            form.append("Architectural_Drafting", Architectural_Drafting  );
            form.append("Auto_Mechanic",     Auto_Mechanic  );        
            form.append("Building_Construction", Building_Construction  );
            form.append("Blue_Print_Reading",  Blue_Print_Reading  );   
            form.append("Beauty_Therapy",   Beauty_Therapy );        
            form.append("Carpentry",       Carpentry );             
            form.append("Computer_Software",   Computer_Software );     
            form.append("Computer_Hardware",   Computer_Hardware );     


            form.append('Courses_selection_Computer_Software_Professional',  Software_Professional);
            form.append('Courses_selection_Catering',  Catering);
            form.append('Courses_selection_Electricity',  Electricity);
            form.append('Courses_selection_Event_Management',  Event_Management);
            form.append('Courses_selection_Electronic',  Electronic);
            form.append('Courses_selection_Estimating',  Estimating);
            form.append('Courses_selection_Fashion_Design',  Fashion_Design);
            form.append('Courses_selection_Hotel_Management',  Hotel_Management);
            form.append('Courses_selection_Interior_Decoration',  Interior_Decoration);
            form.append('Courses_selection_Tailoring',  Tailoring);
            form.append('Courses_selection_Pastry',  Pastry);
            form.append('Courses_selection_Plumbling',  Plumbling);
            form.append('Courses_selection_Project_Managament',  Project_Managament);




            form.append("Terms_and_conditions", Terms_and_conditions  ); 
            form.append("emc_first_name", $("#Emergency_Contact_first_name").val() );
            form.append("emc_last_name",  $("#Emergency_Contact_last_name").val() );
            form.append("emc_gender",     Emergency_Contact_gender );
            form.append("emc_address",    $("#Emergency_Contact_Address").val() );
            form.append("emc_phone",      $("#Emergency_Contact_Phone").val() );
            form.append("terms_agreement",  $("input[name='Terms_and_conditions']:checked").val() );

            // acquire button element
            let submitBTN                 = $("#apply-today");
            // acquire button default label
            let submitBTN_DefaultContent  =  submitBTN.html();
            // Disable/freeze button
            submitBTN.attr('disabled', 'disabled');
            // replace button label with load indicator
            submitBTN.html(`<i class="fad fa-circle-notch fa-spin"></i> Processing....`);
            
            // send applicant information to server
            $.ajax({ 
                url: apiEndpoints.student_Signup,
                method: "POST",
                timeout: 0,
                processData: false,
                mimeType: "multipart/form-data",
                contentType: false,
                data: form
            }).done(function (response) {
                let data = JSON.parse(response);
                
                console.log(data);

                // 
                if (data.status == true) {
                    components.generic.prompt({
                        notice: 'Congrats!',
                        icon: true,
                        details:  data.body.message + ' Kindly keep your lines: mobile/email open as you will be contacted with later instructions',
                        controls: false
                    });
                    // restore button label
                    submitBTN.html(submitBTN_DefaultContent);
                    // unfreeze button
                    submitBTN.removeAttr('disabled');
                    $("#enrollment-form")[0].reset();
                } else {
                    components.generic.prompt({
                        notice: 'Ops!',
                        details: data.body.message,
                        controls: false
                    });
                    // restore button label
                    submitBTN.html(submitBTN_DefaultContent);
                    // unfreeze button
                    submitBTN.removeAttr('disabled');
                    // $("#enrollment-form")[0].reset();
                }
            });

            // Display the key/value pairs
            // for (var pair of form.entries()) {
            //     console.log(pair[0]+ ', ' + pair[1]); 
            // }


        });
    }

}

new enrollment();
