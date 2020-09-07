import { api_resquest_maker } from './../../util/ajaxHandler.js';
import { apiEndpoints } from './../../util/apiEndpoints.js';
import { fileEndPoints } from './../../util/fileEndPoints.js';
import { components } from './../../util/components.js';

let counter = 0;

export const teacherHomeManager = {
    initialize: function() {
        this.bulletin.main(this);
        this.notes.main(this);
        this.activities.main(this);
        this.grades.main(this);
        this.attendance.main(this);
        // 
        generalFunctionalities.initialize();
    },
    bulletin: {
        main: (parent) => {
        }
    },
    notes: {
        main: (parent) => {
            parent.notes.createNote();
        },

        createNote() {
            $("#add-note").click(function() {
                components.generic.notes.textLesson({destination: "#notes-viewer-section"});
                // 
                $("#regular-note-form").submit(function(e) {
                    e.preventDefault();

                    const info = localStorage.getItem('dXNlcl9pbmZv').split(',');

                    var form = new FormData();
                    form.append( "note_creator_id",  window.atob(info[0]));
                    form.append( "trade_area",  );
                    form.append( "subject",  );
                    form.append( "note_title", $("#regular-note-title").val() );
                    form.append( "note",  $("#regular-note-body").val() );
                    // attach photo if present
                    if ($("#regular-note-pdf")[0].files[0]) {
                        form.append( "media", $("#regular-note-pdf")[0].files[0] );
                    }
                    // 
                    $.ajax({
                        url: apiEndpoints.addNotes,
                        method:      "POST",
                        timeout:     0,
                        processData: false,
                        mimeType:    "multipart/form-data",
                        contentType: false,
                        data:        form
                    }).done(function (response) {
                        console.log(response);
                    });
                });
                


            });

            $("#add-video").click(function() {
                components.generic.notes.mediaLesson({destination: "#notes-viewer-section"});

                // media-form
                // media-title
                // media-thumbnail
                // media-content


            });
        }
    },
    activities: {
        main: (parent) => {
            parent.activities.newActivity();
            parent.activities.activityBuilderController();
        },
        newActivity: function() {
            $("#open-new-activity-modal").click(function() {
                const buttonWrapper = $(this);
                // show
                if ($("#selected-activity-list-viewer").hasClass('hidden') == true) {
                    $(".teacher-activity-builder").fadeOut('slow', function() {
                        $("#selected-activity-list-viewer").removeClass('hidden');
                        $("#selected-activity-list-viewer").fadeIn('slow');
                        buttonWrapper.html(`
                            <button class="btn btn-primary btn-sm shadow-1"> <i class="fad fa-plus"></i> New Activity</button>
                        `);
                    });
                }
                // hide 
                else {
                    $("#selected-activity-list-viewer").fadeOut('slow', function() {
                        $(this).addClass('hidden');
                        $(".teacher-activity-builder").fadeIn('slow');
                        // 
                        buttonWrapper.html(`
                            <span class="rounded-0 text-uppercase pointer">
                                <i class="fal fa-arrow-left"></i> Back
                            </span>
                        `);
                    });
                }
            });
        },
        activityBuilderController: function() {
            $("#activity-builder-start-live-chat").click(function() {
                components.generic.modal(
                    "Live Chat", 
                    `<video src="" style="width:100%; height:300px"></video>`, 
                    'md', 
                    {
                        auto:true
                    }
                );
            });
            // add new question block
            $("#activity-builder-new-question").click(function() {
                components.generic.questionBlock({
                    target: '#quiz_builder_section',
                    index: counter++
                });
                // scroll to new block
                $("html, body").animate({scrollTop: $(document).height() }, 1000);

                // remove specific question block
                $(".delete-question-block").click(function() {
                    const questionBlockToRemove = $(this).parents(".quiz_builder_question_block");
                    questionBlockToRemove.removeClass("fadeInUp").addClass('fadeOut');
                    setTimeout(() => {
                        questionBlockToRemove.remove();
                    }, 1000);
                });
            });
            // remove all question blocks
            $("#activity-builder-redo").click(function() {
                $(".quiz_builder_question_block").removeClass('fadeInUp').addClass('fadeOut');
                setTimeout(() => {
                    $(".quiz_builder_question_block").remove();
                }, 500);
                // 
                $(".teacher-activity-builder")[0].reset();
            });
            // save new activity
            $("#activity-builder-save").click(function() {
                $(".submit-teacher-activity-builder-form").click();
                $(".teacher-activity-builder").submit(function( event ) {
                    event.preventDefault();

                    alert('save');
                });
            });
        }
    },
    grades: {
        main: (parent) => {
            parent.grades.toggleGradePortal();
            parent.grades.newManualGradeInput();
        },
        toggleGradePortal: function() {
            $(".open-grade-entry-portal").click(function() {
                $("#student-grade-list").removeClass('d-flex').fadeOut('slow', function() {
                    $("#grade-portal").fadeIn('slow');
                });
            });
            $("#exit-grade-portal").click(function() {
                $("#grade-portal").fadeOut(0, function () {
                    $("#student-grade-list").addClass('d-flex').fadeIn(0);
                });
            });
        },
        newManualGradeInput: function() {
            $("#new-manual-grade-input").click(function() {
                if($(".grade-block-new").length == 1) {
                    components.generic.prompt({
                        notice: 'Multitasking not allowed',
                        details: 'Please complete interaction with the current widget before adding a new one',
                        controls: false,
                    });
                } else {
                    components.generic.manualGradeInputField({
                        destination: "#manual-grade-input-form"
                    });
                    // 
                    $("#remove-manual-grade-input").click(function() {
                        $(".grade-block-new").removeClass('fadeIn').addClass('fadeOut');
                        // 
                        setTimeout(() => {
                            $(".grade-block-new").remove();
                        }, 1000);
                    });
                }
            });
        }
    },
    attendance: {
        main: (parent) => {
        }
    }
}






// 
let generalFunctionalities = {
    initialize: function() {
        this.toggleNotesControls();
        this.insertUserDetails();
    },
    toggleNotesControls: function() {
        $(".open-edit-control-section").click(function() {
            const PARENT_SECTION  = $(this).parents('.'+ $(this).data('edit-wrapper') );
            const CONTROL_SECTION = PARENT_SECTION.find('.'+$(this).data('edit-control-section'));

            $('.edit-control-section').css('height', '0px');

            if (CONTROL_SECTION.css('height') == '0px') {
                CONTROL_SECTION.css('height', '24px');
            } else {
                CONTROL_SECTION.css('height', '0px');
            }
        });
    },
    insertUserDetails() {
        const info = localStorage.getItem('dXNlcl9pbmZv').split(',');
        $("#teacher-image").attr('src', ( window.atob(info[1]) == "" ) ? "../assets/media/img/avatar/user.jpg": '../assets/media/img/staff/' + window.atob(info[1]) );
        $("#teacher-name").text( window.atob(info[2]) +' '+ window.atob(info[3]) );
        // $("#teacher-subjects").text();
    }
}

