import { api_resquest_maker } from './../util/ajaxHandler.js'; // function
import { apiEndpoints } from './../util/apiEndpoints.js';      // object
import { fileEndPoints } from './../util/fileEndPoints.js';    // object
import { components } from './../util/components.js';          // object

let quickAccessSchoolInfo; // store school info for quick access

let homepage = {
    initialize: function() {
        homepage.getPageDynamicContents();
        homepage.helpModal();
    },
    getPageDynamicContents: function() {
        components.generic.fullPageLoader('show');
        api_resquest_maker(apiEndpoints.ControllerAid, 'GET', {}, {FetchSchoolInfo: true}, homepage.addDynamicContentToPage, homepage.errorM );
        api_resquest_maker(apiEndpoints.ControllerAid, 'GET', {}, {FetchBulletin: true}, homepage.addBulletinItemsToModal, homepage.errorM );
    },
    addDynamicContentToPage: function(data, status) {
        // console.log(data);
        if (data.status == true) {
            let info = data.body.dataset[0];
            $(".home-page-bg").css('background-image', 'url(' + fileEndPoints.img.settings + info.app_home_bg_image + ')');
            $(".school-logo").attr('src', fileEndPoints.img.settings + info.app_logo);
            $(".school-name").html(info.app_school_name);
            $(".school-info").html(info.app_about_info);
            // store for quick access
            quickAccessSchoolInfo = info;
            localStorage.setItem('school-name', info.app_school_name);
            localStorage.setItem('school-logo', info.app_logo);
            // 
            components.generic.fullPageLoader('hide');
            // 
            homepage.addSchoolInfoToAboutModal(info);
        } else {
            components.generic.fullPageLoader({
                icon: 'danger',
                description: data.body.message
            });
        }
    },
    addSchoolInfoToAboutModal: function(info) {
        $(".open-info-modal").click(function() {
            components.generic.modal('About '+info.app_school_name, components.homepage.about);
            $(".info-modal-img").attr('src', fileEndPoints.img.settings + info.app_logo);
            $(".about-contact-mobile").attr('href', info.app_contact_phone).html(info.app_contact_phone);
            $(".about-contact-email").attr('href', info.app_contact_email).html(info.app_contact_email);
            $(".about-school-motto").html( info.app_motto );
            $(".about-school-mission-statement").html( info.app_mission );
            $(".about-school-vision").html( info.app_vision );
            $(".about-school-history").html( info.app_history );
            // fetch and add staff list to about
            api_resquest_maker(apiEndpoints.ControllerAid, 'GET', {}, {FetchStaff: true}, homepage.addStaffListToAboutSection, homepage.errorM);
        });
    },
    addStaffListToAboutSection: function(data, status) {
        if (data.status == true) {
            let staffData = data.body.dataset[0];
            for (let index = 0; index < staffData.length; index++) {
                const staffInfo = staffData[index];
                // remove un-needed comma
                staffInfo.subject.pop(); 
                // append tiles to section
                components.generic.staffTile(
                    ".about-staff-list", 
                    fileEndPoints.img.root+'home5.jpg', 
                    staffInfo.First_Name +' '+ staffInfo.Last_Name, 
                    staffInfo.accountType,
                    (staffInfo.subject == "") ? '' : '<p><b>Teaches</b></p>' + staffInfo.subject.join(", ")
                );
            }
        } else {
            // append error to section
            $(".about-staff-list").html(`<div class="text-center text-muted mt-3 mb-3 col-12"><b>${data.body.message}</b></div>`);
        }
    },
    addBulletinItemsToModal: function(data, status) {
        $(".open-public-bulletin").click(function() {
            console.log(data);
            if (data.status == true) {
                let bulletinData = data.body.dataset[0];

                if (bulletinData.length < 1) {
                    components.generic.prompt("Sorry, the bulletin is un-populated at the moment", "Kindly exit the dialogue and check back at a later time");
                } else {
                    components.generic.modal(
                        quickAccessSchoolInfo.app_school_name + "'s Bulletin", 
                        `<div class="row  d-flex justify-content-center" id="homepage-bulletin-content"></div>`
                    );
                    // 
                    for (let index = 0; index < bulletinData.length; index++) {
                        const bulletinInfo = bulletinData[index];
                        components.generic.bulletinCards(
                            "#homepage-bulletin-content",
                            (bulletinInfo.file == "") ? '' : fileEndPoints.img.bulletin + bulletinInfo.file,
                            bulletinInfo.title,
                            bulletinInfo.postedOn,
                            bulletinInfo.postedBy.first_name +' '+ bulletinInfo.postedBy.last_name,
                            bulletinInfo.details
                        );
                    }
                    components.generic.functionalities.bulletinCardsControl();
                }
            } else {
                components.generic.prompt({
                    notice: data.body.message,
                    details: "Kindly exit the dialogue and check back at a later time",
                    controls: false
                });
            }
        });
    },
    helpModal: function (params) {
      $(".open-help-modal").click(function() {
            components.generic.modal('title', components.contactForm, 'xl', {borderless: true} );
            // 
            $(".help-contact-address").text( quickAccessSchoolInfo.app_contact_address  );
            $(".help-contact-mobile").attr('href', 'tel:'+quickAccessSchoolInfo.app_contact_phone ).text( quickAccessSchoolInfo.app_contact_phone  );
            $(".help-contact-email").attr('href', 'mailto:'+quickAccessSchoolInfo.app_contact_email ).text( quickAccessSchoolInfo.app_contact_email  );
            // 
            let facebook   = (quickAccessSchoolInfo.social_facebook != "") ? `
                <a href="${quickAccessSchoolInfo.social_facebook}"><i class="fab fa-facebook fa-2x text-primary p-2"></i></a>
            ` : '';
            let googleplus = (quickAccessSchoolInfo.social_googleplus != "") ? `
                <a href="${quickAccessSchoolInfo.social_googleplus}"><i class="fab fa-google-plus fa-2x text-danger p-2"></i></a>
            ` : '';
            let twitter    = (quickAccessSchoolInfo.social_twitter != "") ? `
                <a href="${quickAccessSchoolInfo.social_twitter}"><i class="fab fa-twitter fa-2x text-info p-2"></i></a>
            ` : '';
            // 
            $(".social-links").html(facebook + googleplus + twitter);
            // 
            homepage.forwardHelpMessage();
      });  
    },
    forwardHelpMessage: function() {
        $("#contact-form").submit(function( event ) {
            event.preventDefault();
            // disable button until server responds
            $(".contact-form-submit-btn").html(`<i class="fad fa-circle-notch"></i> Please Wait`).attr('disabled', 'disabled');

            $("#feedback-message").val();

            // send user message
            api_resquest_maker(
                apiEndpoints.addFeedback, 
                'POST', 
                {}, 
                {
                    first_name: $("#feedback-first_name").val(),
                    last_name:  $("#feedback-last_name").val(),
                    email:      $("#feedback-email").val(),
                    mobile:     $("#feedback-mobile").val(),
                    message:    $("#feedback-message").val()
                }, 
                function(data, status) {
                    // enable button after server responds
                    $(".contact-form-submit-btn").html("Send").removeAttr('disabled');
                    // 
                    if (data.status == true) {
                        $(".notice").html(`<div class='col p-2 rounded alert-success animated notice-self fadeIn'>${data.body.message}</div>`);
                    } else {
                        $(".notice").html(`<div class='col p-2 rounded alert-warning animated notice-self fadeIn'>${data.body.message}</div>`);
                    }
                    setTimeout(() => {
                        $(".notice-self").removeClass('fadeIn').addClass('fadeOut');
                        setTimeout(() => {
                            $(".notice-self").remove();
                        }, 200);
                    }, 4000);
                }, homepage.errorM 
            );
        });
    },
    errorM: function(response) {
        let erMsg = '<b>Error:</b> ' + response.status +' - '+ response.statusText;

        components.generic.fullPageLoader({
            icon: 'danger',
            description: erMsg
        });
        
        // components.generic.message('alert-warning', erMsg);
    }
}
homepage.initialize();