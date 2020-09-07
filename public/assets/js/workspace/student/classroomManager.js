import { api_resquest_maker } from './../../util/ajaxHandler.js';
import { apiEndpoints } from './../../util/apiEndpoints.js';
import { fileEndPoints } from './../../util/fileEndPoints.js';
import { components } from './../../util/components.js';

export class studentClassroomManager {
    constructor() {
        this.toggleSubjectHallAndClassList();
        this.courseEssentialsTabs();
        this.questions();
    }

    toggleSubjectHallAndClassList() {
        $(".open-student-hall").click(function() {
            const teacher = $(this).parents('.student-classroom-subject-card').find(".teacher-name").text();
            const photo   = $(this).parents('.student-classroom-subject-card').find(".student-classroom-subject-card-image").attr('src');
            const subject = $(this).parents('.student-classroom-subject-card').find(".subject-name").text();
            // 
            $("#student-classroom-subject-list-view").fadeOut('slow', function() {
                // show selected subject name in header
                $(".classroom-name").addClass('hidden');
                $(".tag").html(subject + ' Course');
                $("#student-classroom-study-hall-view").fadeIn('slow');
            });
        });
        $("#exit-student-classroom-study-hall-view").click(function() {
            $("#student-classroom-study-hall-view").fadeOut('slow', function () {
                $(".tag").html('');
                $(".classroom-name").removeClass('hidden');
                $("#student-classroom-subject-list-view").fadeIn('slow');
            });
        });
    }

    courseEssentialsTabs() {
        $(".student-classrom-course-essential-tabs").click(function() {
            $(".student-classrom-course-essential-tabs").removeClass('student-classrom-course-essential-tabs-active');
            $(this).addClass('student-classrom-course-essential-tabs-active');
        });
    }
    
    questions() {
        // NOTE: toggle new question and question list
        $("#ask-new-question").click(function() {
            $("#inquiry-section").toggleClass("hidden");
            $("#questions-list-wrapper").toggleClass("hidden");
        });
        // NOTE: view all anwswers to selected question
        $(".read-answers").click(function() {
            components.generic.modal(
                "title", 
                "content", 
                'lg', 
                { auto: true } 
            ); 
        });
    }
}



