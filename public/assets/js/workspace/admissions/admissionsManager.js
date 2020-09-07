import { api_resquest_maker } from './../../util/ajaxHandler.js';
import { apiEndpoints } from './../../util/apiEndpoints.js';
import { fileEndPoints } from './../../util/fileEndPoints.js';
import { components } from './../../util/components.js';

let instance;
let applicantInstance;
let studentInstance;
let applicantMetaData =  {};
let studentMetaData   =  {};
let arrr              =  [];


export class admissionsManager {
    constructor() {
        instance = this;
        this.bulletin();
        this.promotion();
        new applicantManager();
        new studentManager();
    }

    bulletin() {
        api_resquest_maker(apiEndpoints.FetchBulletinItems, 'GET', {}, { audiance: 'admin' }, (data, status) => {
            if (data.status == true) {
                const content = data.body.dataset[0];
                // 
                for (let index = 0; index < content.length; index++) {
                    const contents = content[index];
                    // 
                    components.generic.staffBulletin({
                        destination: "#admission-bulltin-board",
                        title:       contents.title,
                        date:        contents.postedOn,
                        body:        contents.details,
                    });
                }
                // 
                instance.bulletinToggler();
            } else {
                components.generic.message('alert-warning',  data.body.message);
            }
        }, this.errorFunction );
    }

    // 
    students() {
    }

    // 
    promotion() {
        // show class student list
        $(".go-to-student-list").click(function() {
            $("#classes-cards-list").fadeOut(0, function() {
                $("#student-class-list").fadeIn(0);
            });
        });
        // revert to class card list
        $("#exit-student-class-list").click(function() {
            $("#student-class-list").fadeOut(0, function() {
                $("#classes-cards-list").fadeIn(0);
            });
        });
        // 
        $(".show-student-details-for-promotion").click(function() {
            components.generic.modal(
                "<b>Promotion Panel</b>", 
                components.studentPromotion, 
                'lg', {
                    auto: true
                }
            );
        });
    }

    bulletinToggler() {
        $(".toggle-none-admin-bulletin").click(function() {
            const height = $(this).parents('.card').find(".user-bulletin-content");
            if (height.css('height') == '176px') {
                $(this).html('read Less  <i class="fad fa-chevron-up"></i> ');
                height.css('height', height.prop('scrollHeight')+'px');
            } else {
                height.css('height', '176px');
                $(this).html('read more  <i class="fad fa-chevron-down"></i> ');
            }
        });
    }

    errorFunction(response) {
        components.generic.fullPageLoader('hide');
        let erMsg = '<b>Error:</b> ' + response.status +' - '+ response.statusText;
        components.generic.message('alert-warning', erMsg);
    }
}




class studentManager {
    constructor() {
        studentInstance = this;
        this.orginalFile;
        this.displayListOfStudents();
        this.ShowStudentsDetailsWidget();
        this.StudentsDetailsFormQuestionSkipper();
        this.updateStudentTextualInfo();
        this.updateStudentGraphicalInfo();
        this.deleteStudentInfo();
        this.searchStudent();
    }

    searchStudent() {
        $(".search-student").on('search', function() {
            studentInstance.displayListOfStudents( $(this).val() );
        });
        // 
        $(".search-student-btn").click(function() {
            studentInstance.displayListOfStudents( $(".search-student").val() );
        });
    }

    displayListOfStudents(phrase=0) {
        api_resquest_maker(apiEndpoints.fetchStudentList, 'GET', {}, (phrase==0)?{}:{searchPhrase:phrase}, (data, status) => {
            // 
            if (data.status == true) {
                const content = data.body.dataset[0];
                // 
                $("#student-tbl-list").find(".custom-table-data-section").remove();
                // 
                for (let index = 0; index < content.length; index++) {
                    const contents = content[index];
                    // set and display applicants partial data in table 
                    components.generic.studentTbl({
                        destination:   "#student-tbl-list",
                        id:             contents.id,
                        image:          fileEndPoints.img.students + contents.photo,
                        fullname:       contents.Fullname
                    });
                }
            } else {
                // components.generic.message('alert-warning', data.body.message );
            }
        }, studentInstance.errorFunction );
    }

    ShowStudentsDetailsWidget() {
        // call students details widget  
        $("body").on('click', '.show-students-details', function() {
            const potential_student_detail_btn   = $(this)
            const btnIconHolder                  = $(this).find('.show-student-details-spinner');
            const btnIcon                        = btnIconHolder.html();
            // 
            btnIconHolder.html(`<i class="fad fa-circle-notch fa-spin"></i>`);
            // 
            api_resquest_maker(apiEndpoints.fetchStudentList, 'GET', {}, { id: $(this).attr('atlas-id') }, (data, status) => {
                console.log(data);
                // 
                if (data.status == true) {
                    const content = data.body.dataset[0][0];
                    // set applicant meta data
                    studentInstance.studentMetaData(content);
                    // call modal
                    components.generic.modal(
                        `<b>Preview Of:</b> <i>${content.Fullname}</i>`, 
                        `<div id="tester"></div>`, 
                        'lg', 
                        {auto: true}
                    );
                    // set and display selected applicant details 
                    components.generic.studentDetailFormFields({
                        destination:                                 "#tester",
                        id:                                          content.id,
                        photo:                                       fileEndPoints.img.students+content.photo,
                        Fullname:                                    content.Fullname,
                        Mobile:                                      content.Mobile,
                        status:                                      content.status,
                        emial:                                       content.emial,
                        gender:                                      content.gender,
                        DOB:                                         content.DOB,
                        place_of_birth:                              content.place_of_birth,
                        nationality:                                 content.nationality,
                        address:                                     content.address,
                        tuition_status:                              content.tuition_status,
                        t_s_institution_or_sponsor_name:             content.t_s_institution_or_sponsor_name,
                        t_s_phone:                                   content.t_s_phone,
                        t_s_email:                                   content.t_s_email,
                        academic_status:                             content.academic_status,
                        first_time_attending_vocational_school:      content.first_time_attending_vocational_school,
                        name_of_school_have_attended:                content.name_of_school_have_attended,
                        location_of_school_have_attended:            content.location_of_school_have_attended,
                        emc_first_name:                              content.emc_first_name,
                        emc_last_name:                               content.emc_last_name,
                        emc_gender:                                  content.emc_gender,
                        emc_address:                                 content.emc_address,
                        emc_phone:                                   content.emc_phone,
                        terms_agreement:                             content.terms_agreement,
                        Auto_CAD:                                    content.Auto_CAD,
                        Architectural_Drafting:                      content.Architectural_Drafting,
                        Auto_Mechanic:                               content.Auto_Mechanic,
                        Building_Construction:                       content.Building_Construction,
                        Blue_Print_Reading:                          content.Blue_Print_Reading,
                        Beauty_Therapy:                              content.Beauty_Therapy,
                        Carpentry:                                   content.Carpentry,
                        Computer_Software:                           content.Computer_Software,
                        Computer_Hardware:                           content.Computer_Hardware,
                        Computer_Software_Professional:              content.Computer_Software_Professional,
                        Catering:                                    content.Catering,
                        Electricity:                                 content.Electricity,
                        Event_Management:                            content.Event_Management,
                        Electronic:                                  content.Electronic,
                        Estimating:                                  content.Estimating,
                        Fashion_Design:                              content.Fashion_Design,
                        Hotel_Management:                            content.Hotel_Management,
                        Interior_Decoration:                         content.Interior_Decoration,
                        Tailoring:                                   content.Tailoring,
                        Courses_selection_Pastry:                    content.Courses_selection_Pastry,
                        Plumbling:                                   content.Plumbling,
                        Project_Managame:                            content.Project_Managame,

                        t_s_institution_or_sponsor_name:             content.t_s_institution_or_sponsor_name,
                        t_s_phone:                                   content.t_s_phone,
                        t_s_email:                                   content.t_s_email

                    });
                    // replace btn load indicator with default long arrow
                    btnIconHolder.html(btnIcon);
                } else {
                }
            }, studentInstance.errorFunction );
        });
    }  

    updateStudentTextualInfo() {
        $('body').on('submit', '#enrollment-form', function(e) {
            e.preventDefault();
            // update textual info
            api_resquest_maker(apiEndpoints.updateStudentInfo, 'POST', {}, {
                user_id:                                   $(this).attr('user-id'),
                Fullname:                                  $("#applicant_first_name").val(),
                DOB:                                       $("#applicant_DOB").val(),
                place_of_birth:                            $("#applicant_Place_of_Birth").val(),
                nationality:                               $("#applicant_Nationalities").val(),
                gender:                                    $("input[name='applicant_gender']:checked").val(),
                Mobile:                                    $("#applicant_phone").val(),
                emial:                                     $("#applicant_email").val(),
                address:                                   $("#applicant_Address").val(),
                tuition_status:                            $("input[name='applicant_tuition_status']:checked").val(),
                t_s_institution_or_sponsor_name:           ( $("#scholarship_provider").val()       == '') ? '' :  $("#scholarship_provider").val(),
                t_s_phone:                                 ( $("#scholarship_provider_phone").val() == '') ? '' :  $("#scholarship_provider_phone").val(),
                t_s_email:                                 ( $("#scholarship_provider_email").val() == '') ? '' :  $("#scholarship_provider_email").val(),
                academic_status:                           $("input[name='academic_status']:checked").val(),
                emc_first_name:                            $("#Emergency_Contact_first_name").val(),
                emc_last_name:                             $("#Emergency_Contact_last_name").val(),
                emc_gender:                                $("input[name='applicant_gender']:checked").val(),
                emc_address:                               $("#Emergency_Contact_Address").val(),
                emc_phone:                                 $("#Emergency_Contact_Phone").val(),
                first_time_attending_vocational_school:    $("input[name='previousVocationSchool']:checked").val(),
                name_of_school_have_attended:              $("#previous_vocation_school_name").val(),
                location_of_school_have_attended:          $("#previous_vocation_school_Location").val(),

                Auto_CAD:                           ( $("input[name='Courses_selection_Auto_CAD']:checked").length < 1 )                        ? 'no' : $("input[name='Courses_selection_Auto_CAD']:checked").val(),
                Architectural_Drafting:             ( $("input[name='Courses_selection_Architectural_Drafting']:checked").length < 1 )          ? 'no' : $("input[name='Courses_selection_Architectural_Drafting']:checked").val(),
                Auto_Mechanic:                      ( $("input[name='Courses_selection_Auto_Mechanic']:checked").length < 1 )                   ? 'no' : $("input[name='Courses_selection_Auto_Mechanic']:checked").val(),
                Building_Construction:              ( $("input[name='Courses_selection_Building_Construction']:checked").length < 1 )           ? 'no' : $("input[name='Courses_selection_Building_Construction']:checked").val(),
                Blue_Print_Reading:                 ( $("input[name='Courses_selection_Blue_Print_Reading']:checked").length < 1 )              ? 'no' : $("input[name='Courses_selection_Blue_Print_Reading']:checked").val(),
                Beauty_Therapy:                     ( $("input[name='Courses_selection_Beauty_Therapy']:checked").length < 1 )                  ? 'no' : $("input[name='Courses_selection_Beauty_Therapy']:checked").val(),
                Carpentry:                          ( $("input[name='Courses_selection_Carpentry']:checked").length < 1 )                       ? 'no' : $("input[name='Courses_selection_Carpentry']:checked").val(),
                Computer_Software:                  ( $("input[name='Courses_selection_Computer_Software']:checked").length < 1 )               ? 'no' : $("input[name='Courses_selection_Computer_Software']:checked").val(),
                Computer_Hardware:                  ( $("input[name='Courses_selection_Computer_Hardware']:checked").length < 1 )               ? 'no' : $("input[name='Courses_selection_Computer_Hardware']:checked").val(),
                Computer_Software_Professional:     ( $("input[name='Courses_selection_Computer_Software_Professional']:checked").length < 1 )  ? 'no' : $("input[name='Courses_selection_Computer_Software_Professional']:checked").val(),
                Catering:                           ( $("input[name='Courses_selection_Catering']:checked").length < 1 )                        ? 'no' : $("input[name='Courses_selection_Catering']:checked").val(),
                Electricity:                        ( $("input[name='Courses_selection_Electricity']:checked").length < 1 )                     ? 'no' : $("input[name='Courses_selection_Electricity']:checked").val(),
                Event_Management:                   ( $("input[name='Courses_selection_Event_Management']:checked").length < 1 )                ? 'no' : $("input[name='Courses_selection_Event_Management']:checked").val(),
                Electronic:                         ( $("input[name='Courses_selection_Electronic']:checked").length < 1 )                      ? 'no' : $("input[name='Courses_selection_Electronic']:checked").val(),
                Estimating:                         ( $("input[name='Courses_selection_Estimating']:checked").length < 1 )                      ? 'no' : $("input[name='Courses_selection_Estimating']:checked").val(),
                Fashion_Design:                     ( $("input[name='Courses_selection_Fashion_Design']:checked").length < 1 )                  ? 'no' : $("input[name='Courses_selection_Fashion_Design']:checked").val(),
                Hotel_Management:                   ( $("input[name='Courses_selection_Hotel_Management']:checked").length < 1 )                ? 'no' : $("input[name='Courses_selection_Hotel_Management']:checked").val(),
                Interior_Decoration:                ( $("input[name='Courses_selection_Interior_Decoration']:checked").length < 1 )             ? 'no' : $("input[name='Courses_selection_Interior_Decoration']:checked").val(),
                Tailoring:                          ( $("input[name='Courses_selection_Tailoring']:checked").length < 1 )                       ? 'no' : $("input[name='Courses_selection_Tailoring']:checked").val(),
                Courses_selection_Pastry:           ( $("input[name='Courses_selection_Pastry']:checked").length < 1 )                          ? 'no' : $("input[name='Courses_selection_Pastry']:checked").val(),
                Plumbling:                          ( $("input[name='Courses_selection_Plumbling']:checked").length < 1 )                       ? 'no' : $("input[name='Courses_selection_Plumbling']:checked").val(),
                Project_Managame:                   ( $("input[name='Courses_selection_Project_Managament']:checked").length < 1 )              ? 'no' : $("input[name='Courses_selection_Project_Managament']:checked").val(),

            }, (data, status) => {
                components.generic.closeModal();
                
                if (data.status == true) {
                    studentInstance.displayListOfStudents();
                    components.generic.prompt({
                        icon: true,
                        notice: '',
                        details: data.body.message,
                        controls: false
                    });
                } else {
                    components.generic.prompt({
                        notice: '',
                        details: data.body.message,
                        controls: false
                    });
                }
            }, studentInstance.errorFunction );
        });

        // 
        $("body").on('click', '.status-switcher', function() {
            // 
            api_resquest_maker(apiEndpoints.updateStudentInfo, 'POST', {}, {
                user_id: $("#enrollment-form").attr('user-id'),
                status:  $(this).val()
            }, (data, status) => {
                components.generic.closeModal();
                // console.log(data);
                if (data.status == true) {
                    
                } else {
                    components.generic.prompt({
                        notice: '',
                        details: data.body.message,
                        controls: false
                    });
                }
            }, studentInstance.errorFunction );
        });
    }

    updateStudentGraphicalInfo() {
        // preview newly selected photo
        $("body").on('change', '#photo', function() {
            // access newly selected file
            const tempFile    = $(this)[0].files[0];
            // access and save orginal file
            studentInstance.orginalFile= $("#photo-bg").attr("original-file");
            // remove orginal file from element
            if ( studentInstance.orginalFile != undefined || studentInstance.orginalFile != false ) {
                $("#photo-bg").removeAttr("original-file");
            } 
            $("#photo-bg").css({'background-image': `url('${URL.createObjectURL(tempFile)}')`});
            $("#student-image-change-confirmation-section").slideDown('slow');
        });
        // update 
        $("body").on("click", "#save-student-new-image", function() {
            var form = new FormData();
            form.append("user_id",   $("#enrollment-form").attr('user-id') );
            form.append("photo",     $("#photo")[0].files[0] );
            
            $.ajax({
                url: apiEndpoints.updateStudentInfo,
                method: "POST",
                timeout: 0,
                processData: false,
                mimeType: "multipart/form-data",
                contentType: false,
                data: form
            }).done(function (response) {
                const data = JSON.parse(response);
                components.generic.closeModal();
                if ( data.status == true ) {
                    studentInstance.displayListOfStudents();
                    components.generic.prompt({
                        icon: true,
                        notice: '',
                        details: data.body.message,
                        controls: false
                    });
                } else {
                    components.generic.prompt({
                        notice: '',
                        details: data.body.message,
                        controls: false
                    });
                }
            });
        });
        // cancel
        $("body").on("click", "#remove-student-new-image", function() {
            $("#photo-bg").css({'background-image': studentInstance.orginalFile });
            $("#student-image-change-confirmation-section").slideUp('slow');
            $("#photo-bg").attr("original-file", studentInstance.orginalFile);
        });
    }

    deleteStudentInfo() {

    }

    StudentsDetailsFormQuestionSkipper() {
        // scholarship skip
        $("body").on('click', '.applicant_tuition_status', function() {
            const skipedItem = $(".scholarship-skip-section");
            if ($(this).val() == 'yes') {
                skipedItem.show('slow');
            } else {
                skipedItem.find('input').each(function() {
                    $(this).val('');
                });
                skipedItem.hide('slow');
            }
        });
        // previous vocation school skip
        $("body").on('click', '.previousVocationSchool', function() {
            const skipedItem = $(".previous_vocational_training_school");
            if ($(this).val() == 'yes') {
                skipedItem.show('slow');
            } else {
                skipedItem.find('input').each(function() {
                    $(this).val('');
                });
                skipedItem.hide('slow');
            }
        });
    }

    studentMetaData(dataset) {
        studentMetaData['id']      =  dataset.id;
        studentMetaData['photo']   =  fileEndPoints.img.students+dataset.photo;
        studentMetaData['name']    =  dataset.Fullname;
        studentMetaData['mobile']  =  dataset.Mobile;
        studentMetaData['email']   =  dataset.emial;
    }

    errorFunction(response) {
        components.generic.fullPageLoader('hide');
        let erMsg = '<b>Error:</b> ' + response.status +' - '+ response.statusText;
        components.generic.message('alert-warning', erMsg);
    }
}



// 
class applicantManager {
    constructor() {
        applicantInstance = this;
        this.applicants();
        this.searchApplicant();
    }

    searchApplicant() {
        $(".search-applicant").on('search', function() {
            applicantInstance.applicants($(this).val());
        });
        // 
        $(".search-applicant-btn").click(function() {
            applicantInstance.applicants($(".search-applicant").val());
        });
    }

    applicants(phrase=0) {
        // display excerpt list of students
        api_resquest_maker(apiEndpoints.fetchApplicant, 'GET', {}, (phrase==0)?{applicant: true}:{searchPhrase:phrase}, (data, status) => {
            if (data.status == true) {
                const content = data.body.dataset[0];
                // 
                $("#applicant-tbl-list").find(".custom-table-data-section").remove();
                // 
                for (let index = 0; index < content.length; index++) {
                    const contents = content[index];
                    // set and display applicants partial data in table 
                    components.generic.applicantTbl({
                        destination: "#applicant-tbl-list",
                        id:          contents.id,
                        image:       fileEndPoints.img.students + contents.photo,
                        fullname:    contents.Fullname,
                        gender:      contents.gender,
                        contact:     contents.Mobile,
                        trade_areas: 'asdasdas',
                    });
                }
                // call applicant details widget  
                $(".show-applicant-details").click(function() {
                    const potential_student_detail_btn   = $(this)
                    const btnIconHolder                  = $(this).find('.show-applicant-details-spinner');
                    const btnIcon                        = btnIconHolder.html();
                    // 
                    btnIconHolder.html(`<i class="fad fa-circle-notch fa-spin"></i>`);
                    // hide detail view 
                    $(".applicant-detail-view").click();
                    // 
                    api_resquest_maker(apiEndpoints.fetchApplicant, 'GET', {}, { id: $(this).data('atlas-id') }, (data, status) => {
                        // 
                        if (data.status == true) {
                            const content = data.body.dataset[0][0];
                            // set applicant meta data
                            applicantInstance.applicantMetaData(content);
                            // set and display selected applicant details 
                            components.generic.applicantDetailFormFields({
                                destination:                                 "#applicant-detail-form-fields",
                                id:                                          content.id,
                                photo:                                       fileEndPoints.img.students+content.photo,
                                Fullname:                                    content.Fullname,
                                Mobile:                                      content.Mobile,
                                status:                                      content.status,
                                emial:                                       content.emial,
                                gender:                                      content.gender,
                                DOB:                                         content.DOB,
                                place_of_birth:                              content.place_of_birth,
                                nationality:                                 content.nationality,
                                address:                                     content.address,
                                tuition_status:                              content.tuition_status,
                                t_s_institution_or_sponsor_name:             content.t_s_institution_or_sponsor_name,
                                t_s_phone:                                   content.t_s_phone,
                                t_s_email:                                   content.t_s_email,
                                academic_status:                             content.academic_status,
                                first_time_attending_vocational_school:      content.first_time_attending_vocational_school,
                                name_of_school_have_attended:                content.name_of_school_have_attended,
                                location_of_school_have_attended:            content.location_of_school_have_attended,
                                emc_first_name:                              content.emc_first_name,
                                emc_last_name:                               content.emc_last_name,
                                emc_gender:                                  content.emc_gender,
                                emc_address:                                 content.emc_address,
                                emc_phone:                                   content.emc_phone,
                                terms_agreement:                             content.terms_agreement
                            });
                            // replace btn load indicator with default long arrow
                            btnIconHolder.html(btnIcon);
                            // attach applicant controls [cancel, decline, accept] functionalities in scope
                            applicantInstance.applicantDetailsController(potential_student_detail_btn);
                        } else {

                        }
                    }, applicantInstance.errorFunction );
                });
            } else {
            }
        }, this.errorFunction );    
    }

    applicantMetaData(dataset) {
        applicantMetaData['id']      =  dataset.id;
        applicantMetaData['photo']   =  fileEndPoints.img.students+dataset.photo;
        applicantMetaData['name']    =  dataset.Fullname;
        applicantMetaData['mobile']  =  dataset.Mobile;
        applicantMetaData['email']   =  dataset.emial;
    }

    applicantDetailsController(potential_student_detail_btn) {
        // open detail viewer
        $(".applicant-detail-box").removeClass('applicant-detail-box-hide');
        $(".applicant-detail-box").addClass('applicant-detail-box-show');
        // close detail viewer
        $(".applicant-detail-view").click(function() {
            $(".applicant-detail-box").removeClass('applicant-detail-box-show');
            $(".applicant-detail-box").addClass('applicant-detail-box-hide');
            $(".show-applicant-details").removeAttr('disabled');
        });

        // decline applicant
        $("#decline-applicant").click(function() {
            // decline confirmation
            components.generic.prompt({
                notice:  'Are you sure you want to Decline ' + applicantMetaData.name + ' application?',
                details: '',
                controls: true,
                callback: (status) => {
                    if (status) {
                        // reason(s) for decline
                        components.generic.modal(
                            `<b>Decline Application</b>`, 
                            `<form id="decline-applicant-form">
                                <div class="col-12 mb-3 p-0">
                                    <label>Please explain why <b>${applicantMetaData.name}</b> application is unacceptable: </label>
                                    <textarea id="decline-applicant-form-reason" class="form-control" rows="10" required placeholder="Eg: Scholarship provider phone number must be valid"></textarea>
                                </div>
                                <!-- controls -->
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <button class="btn btn-primary col-12 shadow-1" id="accept-applicant-btn">Decline Application <span id="accept-applicant-btn-loader"></span> </button>
                                    </div>
                                </div>
                            </form>`, 
                            'md', 
                            {
                                auto: true,
                            }
                        );
                        // deliver reason for rejection to applicant
                        $("#decline-applicant-form").submit(function(e) {
                            e.preventDefault();
                            // 
                            const BTN             =  $(this).find("#accept-applicant-btn");
                            const defaultContent  =  BTN.html();
                            BTN.attr('disabled', 'disabled');
                            // 
                            BTN.html(` <i class="fad fa-circle-notch fa-spin"></i> Declining applicant please wait.... `);
                            // 
                            api_resquest_maker(apiEndpoints.rejectApplicant, 'POST', {}, {
                                applicant_id: applicantMetaData.id,
                                name: applicantMetaData.name,
                                contacts: {
                                    email: applicantMetaData.email,
                                    mobile: applicantMetaData.mobile
                                },
                                rejectionMessage: $("#decline-applicant-form-reason").val()
                            }, (data, status) => {
                                // 
                                if (data.status == true) {
                                    $(this).parents("#generic-modal").find('.close').click();
                                    $(window).scrollTop(0);
                                    // 
                                    components.generic.prompt({
                                        icon:     true,
                                        notice:   '',
                                        details:  data.body.message,
                                        controls: false
                                    });
                                    setTimeout(() => {
                                        potential_student_detail_btn.parents(".custom-table-data-section").hide('slow', function() {
                                            $(this).remove();
                                            $(".applicant-detail-view").click();
                                        });
                                    }, 1000);
                                } else {
                                    BTN.html(`Applicant declined <i class="fad fa-check"></i> `);
                                    // 
                                    setTimeout(() => {
                                        BTN.html(defaultContent);
                                        BTN.removeAttr('disabled');
                                    }, 1000);
                                }
                            }, applicantInstance.errorFunction );

                        });
                    }
                }
            });
        });

        // accept applicant
        $("#accept-applicant").click(function() {
            components.generic.prompt({
                notice: 'Are you sure this applicant qualifies?',
                details: 'Clicking proceed will accept '+applicantMetaData.name+'',
                controls: true,
                callback: (status) => {

                    // reason(s) for decline
                    components.generic.modal(
                        `<b>Accept Application</b>`, 
                        `<form id="accept-applicant-form">
                            <div class="col-12 mb-3 p-0">
                                <label>Please explain what <b>${applicantMetaData.name}</b> will have to do next: </label>
                                <textarea id="accept-applicant-form-reason" class="form-control" rows="10" required placeholder="Eg: Scholarship provider phone number must be valid"></textarea>
                            </div>
                            <!-- controls -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <button class="btn btn-primary col-12 shadow-1" id="accept-applicant-btn">Decline Application <span id="accept-applicant-btn-loader"></span> </button>
                                </div>
                            </div>
                        </form>`, 
                        'md', 
                        {
                            auto: true,
                        }
                    );

                    // 
                    $("#accept-applicant-form").submit(function(e) {
                        e.preventDefault();
                        // 
                        const BTN             =  $(this).find("#accept-applicant-btn");
                        const defaultContent  =  BTN.html();
                        BTN.attr('disabled', 'disabled');
                        // 
                        BTN.html(` <i class="fad fa-circle-notch fa-spin"></i> Declining applicant please wait.... `);
                        // 
                        api_resquest_maker(apiEndpoints.acceptApplicant, 'POST', {}, {
                            applicant_id: applicantMetaData.id,
                            name: applicantMetaData.name,
                            contacts: {
                                email:  applicantMetaData.email,
                                mobile: applicantMetaData.mobile
                            },
                            rejectionMessage: $("#accept-applicant-form-reason").val()
                        }, (data, status) => {
                            // 
                            if (data.status == true) {
                                $(this).parents("#generic-modal").find('.close').click();
                                $(window).scrollTop(0);
                                // 
                                components.generic.prompt({
                                    icon:     true,
                                    notice:   '',
                                    details:  data.body.message,
                                    controls: false
                                });
                                setTimeout(() => {
                                    potential_student_detail_btn.parents(".custom-table-data-section").hide('slow', function() {
                                        $(this).remove();
                                        $(".applicant-detail-view").click();
                                    });
                                }, 1000);
                            } else {
                                BTN.html(`Applicant declined <i class="fad fa-check"></i> `);
                                // 
                                setTimeout(() => {
                                    BTN.html(defaultContent);
                                    BTN.removeAttr('disabled');
                                }, 1000);
                            }
                        }, applicantInstance.errorFunction );

                    });


                }
            });
        });
    }

    errorFunction(response) {
        components.generic.fullPageLoader('hide');
        let erMsg = '<b>Error:</b> ' + response.status +' - '+ response.statusText;
        components.generic.message('alert-warning', erMsg);
    }
}



