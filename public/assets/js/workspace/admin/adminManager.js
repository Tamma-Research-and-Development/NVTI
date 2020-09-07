import { api_resquest_maker } from './../../util/ajaxHandler.js';
import { apiEndpoints } from './../../util/apiEndpoints.js';
import { fileEndPoints } from './../../util/fileEndPoints.js';
import { components } from './../../util/components.js';

let instance;

export class adminManager {
    constructor() {
        instance = this;
        this.bulletinManager();
        this.callNewBulletinForm();
        // 
        new employeeManager;
    }

    bulletinManager() {
        // 
        api_resquest_maker(apiEndpoints.FetchBulletinItems, 'GET', {}, {audiance: 'admin'}, (data, status) => {
            if (data.status == true) {
                const payload = data.body.dataset[0];
                // 

                $(".BulletinEditableCard").remove();

                for (let index = 0; index < payload.length; index++) {
                    let content = payload[index];
                    // 
                    components.generic.BulletinEditableCard({
                        destination:      "#bulletin-list-view",
                        id:               content.id,
                        file:             (content.file == null) ? '' : "../assets/media/img/bulletin/"+content.file,
                        title:            content.title,
                        date_and_sharer:  content.postedOn,
                        audiance:         content.audience,
                        description:      content.details,
                    });
                }
                // 
                instance.placeBulletinTileInEditMode();
            } else {
                components.generic.message('alert-warning', data.body.message);
            }
        }, this.errorFunction );
    }
    // 
    callNewBulletinForm() {
        $("#add-new-bulletin-post").click(function() {
            // 
            if ( $("#AdminBulletinNewCard").length < 1 ) {
                components.generic.BulletinNewCard();
                instance.saveNewBulletinItem();
                // 
                $("#dismiss-new-bulletin-tile").click(function() {
                    $("#AdminBulletinNewCard").fadeOut(0, function() {
                        $(this).remove();
                    });
                });
            } else {
                components.generic.prompt({
                    notice: 'Multitasking not allowed',
                    details: 'Please complete interaction with the existing widget',
                    controls: false
                });
            }
        });
    }
    // 
    saveNewBulletinItem() {
        $("#AdminBulletinNewCard").submit(function(e) {
            e.preventDefault();
            // 
            var form = new FormData();
            form.append("files", $("#AdminBulletinNewCard-file")[0].files[0]);
            form.append("news_title", $("#AdminBulletinNewCard-title").val() );
            form.append("news_details", $("#AdminBulletinNewCard-details").val() );
            form.append("news_target_audience", $("#AdminBulletinNewCard-audiance").val() );

            let SAVE_BTN      = $("#AdminBulletinNewCard-save");
            let default_label = SAVE_BTN.html();
            SAVE_BTN.html(`<i class="fad fa-circle-notch fa-spin"></i> Processing...`);


            $.ajax({
                url: apiEndpoints.AddBulletinItem,
                method: "POST",
                timeout: 0,
                processData: false,
                mimeType: "multipart/form-data",
                contentType: false,
                data: form
            }).done(function (data) {
                const response = JSON.parse(data);
                // 
                if (response.status == true) {
                    components.generic.prompt({
                        icon: true,
                        notice: response.body.message,
                        details: '',
                        controls: false,
                    });
                    // 
                    $("#AdminBulletinNewCard").fadeOut(0, function() {
                        $(this).remove();
                    });
                } else {
                    components.generic.prompt({
                        notice: 'Ops!',
                        details: response.body.message,
                        controls: false,
                        callback: (status) => {
                        }
                    });
                }
            });
        });
    }
    // edit exisitng bulletin item
    editExistingBulletinItem() {
        // 
        $(".admin-bulletin-control-btns-save").click(function() {
            let existingTile = $(this).parents(".admin-editable-bulletin");
            // 
            let recordId  =  existingTile.attr('record-id');
            let title     =  existingTile.find('.bulletin-title-field').val();
            let message   =  existingTile.find('.bulletin-message-field').val();
            let audiance  =  existingTile.find('.AdminBulletinNewCard-audiance-editable').val();
            let file      =  existingTile.find(".file-selector")[0].files[0];

            console.log(recordId);


            var form = new FormData();
            if (file != undefined || file != null || file != "") {
                form.append("files", file);
            } 
            form.append("recordID",             recordId);
            form.append("news_title",           title);
            form.append("news_details",         message);
            form.append("news_target_audience", audiance);

            $.ajax({
                url: apiEndpoints.EditBulletinItem,
                method: "POST",
                timeout: 0,
                processData: false,
                mimeType: "multipart/form-data",
                contentType: false,
                data: form
            }).done(function (data) {
                console.log(data);
                const response = JSON.parse(data);
                // 
                if (response.status == true) {
                    components.generic.prompt({
                        icon: true,
                        notice: response.body.message,
                        details: '',
                        controls: false,
                    });
                    // refresh bulletin contents on page
                    instance.bulletinManager();
                } else {
                    components.generic.prompt({
                        notice: 'Ops!',
                        details: response.body.message,
                        controls: false,
                    });
                }
            });                    
        });
        // 
        $(".admin-bulletin-control-btns-delete").click(function() {
            let recordId = $(this).parents(".admin-editable-bulletin").attr('record-id');

            components.generic.prompt({
                notice: 'Are you sure you want to delete this?',
                details: 'Deleted bulletin items are not recoverable. proceed only if certain',
                callback: function(result) {
                    if (result == true) {
                        // 
                        api_resquest_maker(apiEndpoints.DeleteBulletinItem, 'POST', {}, {recordID: recordId}, (data, status) => {
                            console.log(data);
                            if (data.status == true) {
                                components.generic.prompt({
                                    icon: true,
                                    notice: data.body.message,
                                    details: '',
                                    controls: false,
                                });
                                // refresh bulletin contents on page
                                instance.bulletinManager();
                            } else {
                                components.generic.prompt({
                                    notice: 'Ops!',
                                    details: data.body.message,
                                    controls: false,
                                    callback: (status) => {
                                    }
                                });
                            }
                        }, instance.errorFunction );
                    }
                }
            });
        });
    }
    // 
    placeBulletinTileInEditMode() {
        $(".admin-editable-btn").click(function() {
            const EDITABLE       = $(this).parents(".admin-editable-bulletin");
            const TITLE          = EDITABLE.find(".admin-editable-bulletin-title");
            const MESSAGE        = EDITABLE.find(".admin-bulletin-content");

            const AUDIANCE       = EDITABLE.find(".admin-bulletin-audiance");

            const CONTROL_BTNS   = EDITABLE.find(".admin-bulletin-control-btns");
            const FILE_PREVIEWER = EDITABLE.find(".file-previewer");
            const FILE_SELECTOR  = EDITABLE.find(".file-selector");
            // 
            if ( EDITABLE.find('.bulletin-title-field').length == 0 ) {
                // 
                TITLE.after(` <input type="text" class="form-control bulletin-title-field"  name="bulletin-title-field" required   value="${TITLE.html()}">`); 
                MESSAGE.after(`<textarea class=" form-control  bulletin-message-field" name="bulletin-message-field"  required rows="5" >${MESSAGE.find('p').html()}</textarea>`);
                // 
                TITLE.hide();
                FILE_PREVIEWER.removeClass('d-flex').addClass("hidden");
                FILE_SELECTOR.show();
                MESSAGE.hide();
                // 
                CONTROL_BTNS.find('span').hide();
                CONTROL_BTNS.append(`
                    <div class="row p-2 admin-bulletin-control-btns-section">
                        <div class="col-6">
                            <i class="fad fa-trash admin-bulletin-control-btns-delete pointer"></i>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <i class="fad fa-save admin-bulletin-control-btns-save pointer" ></i>
                        </div>
                    </div>  
                `);
                // 
                AUDIANCE.find('p').hide();
                AUDIANCE.append(`
                    <select class="custom-select form-control AdminBulletinNewCard-audiance-editable" required>
                        <option value="${AUDIANCE.find('p').find('span').text()}" selected>${AUDIANCE.find('p').find('span').text()}</option>
                        <option value="public">public</option>
                        <option value="admin">admin</option>
                        <option value="teacher">teacher</option>
                        <option value="student">student</option>
                    </select>
                `);
                $(this).removeClass('fa-edit').addClass('fa-times');

                // NOTE: initiate update existing bulletin item
                instance.editExistingBulletinItem();
            } else {
                TITLE.show();
                FILE_PREVIEWER.removeClass('hidden').addClass("d-flex");
                FILE_SELECTOR.hide();
                MESSAGE.show();
                EDITABLE.find('.bulletin-title-field, .bulletin-message-field').remove();
                EDITABLE.find('.admin-bulletin-control-btns-section, .AdminBulletinNewCard-audiance-editable').remove();
                $(this).removeClass('fa-times').addClass('fa-edit');
                CONTROL_BTNS.find('span').show();
                AUDIANCE.find('p').show();
            }
        });
    }
    // 
    errorFunction(response) {
        components.generic.fullPageLoader('hide');
        let erMsg = '<b>Error:</b> ' + response.status +' - '+ response.statusText;
        components.generic.message('alert-warning', erMsg);
    }
}



// 
// let bulletinManager_instance;

// class bulletinManager() {
//     constructor() {

//     }

//     listItems() {

//     }

//     addNewItem() {

//     }

//     editExistingItem() {

//     }

//     deleteExistingItem() {

//     }
// }


let employeeManager_instance;
let responsibilitiesPackage   = [];
let responsibilitiesTradeArea = [];

class employeeManager {
    constructor() {
        employeeManager_instance = this;
        this.searchEmployee();
        this.getAndDisplayEmployees();
        this.resetFormForNewInput();
        this.addEmployee();
        this.addResponsibility();
    }

    // 
    searchEmployee() {
        $("#search-employee-submit-btn").click(function() {
            employeeManager_instance.getAndDisplayEmployees({
                searchPhrase: $("#search-employee-value").val()
            });
        });
        // 
        $("#search-employee-value").on('search', function() {
            employeeManager_instance.getAndDisplayEmployees({
                searchPhrase: $("#search-employee-value").val()
            });
        });
    }

    // 
    getAndDisplayEmployees(option=0) {
        let searchPhrase = ( option == 0 ) ? {} : option;
        // 
        api_resquest_maker(apiEndpoints.fetchAllEducators, 'GET', {}, searchPhrase, (data, status) => {
            if (data.status == true) {
                const content = data.body.dataset;
                $('#staff-chat-list').html("");
                // 
                for (let index = 0; index < content.length; index++) {
                    const contents = content[index];
                    // 
                    components.generic.employee_search_result({
                        destination: '#staff-chat-list',
                        id:          contents.id,
                        image:       fileEndPoints.img.staff + contents.photo,
                        fullname:    contents.First_Name +' '+ contents.Last_Name,
                        position:    contents.accountType,
                    });        
                }
                // reveal selected user info in details section
                $(".employee_search_result").click(function() {
                    const id = $(this).attr('record-id');
                    // empty responsiblity section
                    $("#assigned-classes-and-subjects").html("");
                    // flush responibilities 
                    responsibilitiesPackage = responsibilitiesTradeArea = []; 
                    // 
                    api_resquest_maker(apiEndpoints.fetchAllEducators, 'GET', {}, {record_id: id}, (data, status) => {
                        // 
                        if (data.status == true) {
                            const  content   =  data.body.dataset[0];
                            const  userId    =  content.id;
                            const  picture   =  (content.photo == "") ? '../assets/media/img/avatar/staff-avatar-one.png': fileEndPoints.img.staff + content.photo;


                            console.log(picture);

                            // 
                            $("#admin-employees-manager-form").attr('data-user-id', userId);
                            
                            // $("#admin-employees-manager-form-image-previewer").css('background-image', 'url('+picture+')'); 0
                            $("#admin-employees-manager-form-image-previewer").attr('src', picture); 



                            $("#fullname").val(content.First_Name); 
                            $("#lastname").val(content.Last_Name); 
                            $("#position").val(content.accountType); 
                            $("#gender").val(content.Gender); 
                            $("#email").val(content.email); 
                            $("#mobile").val(content.Phone_number); 
                            $("#address").val(content.address); 
                            $("#Date_of_Birth").val(content.dob); 
                            $("#Professional_Qualifications").val(content.professional_qualification); 
                            $("#Academic_Qualifications").val(content.academic_qualification); 
                            $("#Years_In_Teaching").val(content.years_in_teaching); 
                            $("#National_Id").val(content.national_id); 
                            $("#Payroll_Number").val(content.payroll_number); 
                            $("#Emergency_contact_fullname").val(content.ec_fullname); 
                            $("#Emergency_contact_relationship").val(content.ec_relationship); 
                            $("#Emergency_contact_primary_contact").val(content.ec_primary_tel); 
                            $("#Emergency_contact_secondary_contact").val(content.ec_secondaary_tel); 
                            $("#Emergency_contact_biography").val(content.biography); 

                            // remove requirement from image picker
                            $("#admin-employee-image").removeAttr('required');


                            // get and display employee responsibilities if found
                            api_resquest_maker(apiEndpoints.fetchTeacherResponsibilities, 'GET', {}, { employee_id: userId }, (data, status) => {
                                if (data.status_code == 200) {
                                    let content = data.body.dataset;
                                    // 
                                    $('#assigned-classes-and-subjects').html(" ");
                                    // 
                                    for (let index = 0; index < content.length; index++) {
                                        const items = content[index];
                                        employeeManager_instance.stackResponsibility(items.id, items.trade_area, items.subjects);
                                        responsibilitiesTradeArea.push(items.trade_area);
                                    }
                                    // 
                                    employeeManager_instance.unassignResponsibility();
                                } 
                            }, instance. errorFunction );   
                        } else {
                            components.generic.message('alert-warning', data.body.message);
                        }
                    }, instance.errorFunction );

                });
            } else {
                components.generic.message('alert-warning', data.body.message);
            }
        }, this.errorFunction );
    }

    // 
    addResponsibility() {
        $("#Responsibilities-submit-btn").click(function() {
            let responsibilityForm   =  $(this).parents("#responsibilities-section");
            let trade_areaVal        =  responsibilityForm.find("#trade_area").val()
            let trade_area_subjects  =  responsibilityForm.find("#trade_area_subjects").val();
            // 
            if (responsibilitiesTradeArea.includes(trade_areaVal)) {
                // console.log( trade_areaVal + ' now exist');
                components.generic.prompt({
                    notice: 'Duplicate detected!',
                    details: '<b>'+trade_areaVal+'</b> already exist',
                    controls: false,
                    callback: function(status) {
                        if (status == true) {
                            // update array with new subjects
                            for (let index = 0; index < responsibilitiesPackage.length; index++) {
                                const item = responsibilitiesPackage[index];
                                // 
                                if ( item.trade_area == trade_areaVal ) {
                                    responsibilitiesPackage.splice(index, 1);
                                    break;
                                }
                            }
                            // find and remove duplicated tile from view and update [responsibilitiesTradeArea] array
                            $('#assigned-classes-and-subjects').find('.assigned_classes_and_subjects_card').each(function() {
                                if ($(this).find('.question-card-header3').text().trim() == trade_areaVal) {
                                    $(this).hide('slow', function() {
                                        $(this).remove();
                                        // 
                                        for (let index = 0; index < responsibilitiesTradeArea.length; index++) {
                                            const tradeAreas = responsibilitiesTradeArea[index];
                                            // 
                                            if (tradeAreas == trade_areaVal) {
                                                responsibilitiesTradeArea.splice(index, 1);
                                                break;
                                            } 
                                        }
                                    });
                                    return false;
                                } else {
                                    console.log('miss');
                                }
                            });
                        }
                    }
                });
            } else {
                employeeManager_instance.stackResponsibility('null', trade_areaVal, trade_area_subjects);
                responsibilitiesTradeArea.push(trade_areaVal);
                employeeManager_instance.unassignResponsibility();
            }
        });
    }

    // 
    stackResponsibility(itemId, trade_areaVal, trade_area_subjects) {
        responsibilitiesPackage.push({
            trade_area:  trade_areaVal,
            subjects:    trade_area_subjects
        });
        // 
        components.generic.assigned_classes_and_subjects_card({
            destination:   '#assigned-classes-and-subjects',
            id:             itemId,
            trade_area:     trade_areaVal,
            subject_list:   trade_area_subjects
        });
    }

    // 
    removeTradeAreaFromPackage(trade_areaVal, callback=0) {
        // 
        for (let index = 0; index < responsibilitiesPackage.length; index++) {
            const item = responsibilitiesPackage[index];
            // 
            if ( item.trade_area == trade_areaVal ) {
                responsibilitiesPackage.splice(index, 1);
                break;
            }
        }
        // 
        for (let index = 0; index < responsibilitiesTradeArea.length; index++) {
            const tradeAreas = responsibilitiesTradeArea[index];
            // 
            if (tradeAreas == trade_areaVal) {
                responsibilitiesTradeArea.splice(index, 1);
                break;
            } 
        }
        if (typeof callback == "function") {
            callback();
        }
    }

    // 
    unassignResponsibility() {
        $(".unassign-tradeArea").click(function() {
            const responsibilityTileBtn = $(this);
            const responsibilityTile    = $(this).parents(".assigned_classes_and_subjects_card");
            const itemId                = $(this).data('trade-area-id');
            // remove temporarily stored responsibility
            if ( itemId == 'null' ) {
                
            }
            // remove permanently stored responsibility
            else {
                api_resquest_maker(apiEndpoints.deleteTeacherResponsibilities, 'POST', {}, {id: itemId}, (data, status) => {
                    if (data.status_code == 200) {
                        const trade_area = responsibilityTileBtn.data('trade-area');
                        // 
                        responsibilityTile.hide('slow', function() {
                            employeeManager_instance.removeTradeAreaFromPackage( trade_area , () => {
                                responsibilityTile.remove();
                            });
                        });
                    } else {
                        
                    }
                }, employeeManager_instance.errorFunction );    
            }
        });
    }

    // 
    resetFormForNewInput() {
        $("#clear-employee-form").click(function() {
            // reset form
            $("#admin-employees-manager-form")[0].reset();
            // 
            $("#admin-employees-manager-form").attr('data-user-id', '');
            // add requirement from image picker
            $("#admin-employee-image").attr('required', 'required');
            // reset image thumbnail
            $("#admin-employees-manager-form-image-previewer").attr('src', "../assets/media/img/avatar/user.png");
            // empty responsiblity section
            $("#assigned-classes-and-subjects").html("");
            // flush responibilities 
            responsibilitiesPackage = responsibilitiesTradeArea = []; 
        });
    }

    // 
    addEmployee() {
        $("#admin-employees-manager-form").submit(function(e) {
            e.preventDefault();
            // 
            var form = new FormData();
            // 
            form.append('First_Name',                   $("#fullname").val() ); 
            form.append('Last_Name',                    $("#lastname").val() ); 
            form.append('Gender',                       $("#gender").val() );
            form.append('Phone_number',                 $("#mobile").val() );
            form.append('accountType',                  $("#position").val() ); 
            form.append('email',                        $("#email").val() );
            form.append('dob',                          $("#Date_of_Birth").val() );
            form.append('years_in_teaching',            $("#Years_In_Teaching").val() );
            form.append('professional_qualification',   $("#Professional_Qualifications").val() );
            form.append('national_id',                  $("#National_Id").val() );
            form.append('address',                      $("#address").val() );
            form.append('academic_qualification',       $("#Academic_Qualifications").val() );
            form.append('biography',                    $("#Emergency_contact_biography").val() );
            form.append('payroll_number',               $("#Payroll_Number").val() );
            form.append('ec_fullname',                  $("#Emergency_contact_fullname").val() );
            form.append('ec_relationship',              $("#Emergency_contact_relationship").val() );
            form.append('ec_primary_tel',               $("#Emergency_contact_primary_contact").val() );
            form.append('ec_secondaary_tel',            $("#Emergency_contact_secondary_contact").val() );

            let URL;

            // Get responsibilities if any exist
            if ( responsibilitiesPackage.length > 0 ) {
                form.append('responsibilities', JSON.stringify(responsibilitiesPackage));
            } 
            // Get image if it exist
            if ($("#admin-employee-image")[0].files[0] != '') {
                form.append('photo', $("#admin-employee-image")[0].files[0] );
            }
            // NOTE: edit mode
            if ( $("#admin-employees-manager-form").data('user-id')) {
                form.append('employee_id', $("#admin-employees-manager-form").data('user-id') ); 
                URL = apiEndpoints.editEducatorProfile;
            } else {
                URL = apiEndpoints.educator_Signup;
            }



            // if record has id/originated from server
            //  do this: 
            // URL = apiEndpoints.editEducatorProfile
            // get Id
            // else, do this:
            // 


            // 
            $.ajax({
                url: URL,
                method: "POST",
                timeout: 0,
                processData: false,
                mimeType: "multipart/form-data",
                contentType: false,
                data: form
            }).done(function (response) {
                console.log(response);
            });





            // for (let pair of form.entries()) {
            //     console.log( pair[0] +', '+ pair[1] );
            // }
        });
    }

    // 
    errorFunction(response) {
        components.generic.fullPageLoader('hide');
        let erMsg = '<b>Error:</b> ' + response.status +' - '+ response.statusText;
        components.generic.message('alert-warning', erMsg);
    }
}

