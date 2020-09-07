import { api_resquest_maker } from './../util/ajaxHandler.js'; // function
import { apiEndpoints } from './../util/apiEndpoints.js';      // object
import { fileEndPoints } from './../util/fileEndPoints.js';    // object
import { components } from './../util/components.js';          // object

console.log(apiEndpoints);
let loginAttempts = 0;

let auth = {
    initialize: function() {
        auth.sessionCheck();
        auth.staffLogin();
        auth.studentLogin();
    },
    sessionCheck: function() {
        // automatically route user to workspace if session exist
        api_resquest_maker('../'+apiEndpoints.ControllerAid, 'GET', {}, { FetchUserType: 'true' }, auth.sessionCheckResultHandler, auth.errorM );
    },
    staffLogin: function () {
        // prevent password guess attack
        if (localStorage.getItem('YSWEDR') == 'true') {
            components.generic.message('alert-danger', 'Login Banned. Too many failed attempts', '.notice', 'infinite');
            $("#educator-login-form").find('input, button').attr('disabled', 'disabled');
        }
        //  allow user to attempt a login
        else {
            $("#educator-login-form").submit(function( event ) {
                event.preventDefault();
                let credentials = {
                    Phone_number: $("#phone_number").val(), 
                    Password:     $("#password").val()
                };
                // restrict attempts to 5
                if (loginAttempts == 4) {
                    components.generic.message('alert-danger', 'Login Banned. Too many failed attempts', '.notice', 'infinite');
                    $(this).find('input, button').attr('disabled', 'disabled');
                    // perpectually prohibit login
                    localStorage.setItem('YSWEDR', true);
                } 
                else {
                    api_resquest_maker('../'+apiEndpoints.educator_Login, 'POST', {}, credentials, auth.staffLoginDecisionHandler, auth.errorM);
                }
            });
        }
    },
    studentLogin: function () {
        // prevent password guess attack
        if (localStorage.getItem('_YSWEDR_') == 'true') {
            components.generic.message('alert-danger', 'Login Banned. Too many failed attempts', '.notice', 'infinite');
            $("#educator-login-form").find('input, button').attr('disabled', 'disabled');
        }
        //  allow user to attempt a login
        else {
            $("#student-login-form").submit(function( event ) {
                event.preventDefault();
                let credentials = {
                    UserName: $("#username").val(), 
                    phone: $("#password").val()
                };
                // restrict attempts to 5
                if (loginAttempts == 4) {
                    components.generic.message('alert-danger', 'Login Banned. Too many failed attempts', '.notice', 'infinite');
                    $(this).find('input, button').attr('disabled', 'disabled');
                    // perpectually prohibit login
                    localStorage.setItem('_YSWEDR_', true);
                } 
                else {
                    api_resquest_maker('../'+apiEndpoints.student_Login, 'POST', {}, credentials, auth.studentLoginDecisionHandler, auth.errorM);
                }
            });
        }
    },
    staffLoginDecisionHandler: function(data, status) {
        if (data.status == true) {
            components.generic.message('alert-success', data.body.message+'. Please wait, redirecting.. ', '.notice');
            // store info
            localStorage.setItem( 'dXNlcl9pbmZv', [
                data.body.dataset._10,
                data.body.dataset._1010,
                data.body.dataset._101010,
                data.body.dataset._10101010,
                data.body.dataset._1010101010
            ]);
            setTimeout(() => {
                window.location.href = '../workspace.html';
            }, 6000);
        } 
        else if (data.status_code == 403) {
            components.generic.message('alert-danger', data.body.message, '.notice', 'infinite');
            $("#educator-login-form").find('input, button').attr('disabled', 'disabled');
            // perpectually prohibit login
            localStorage.setItem('_YSWEDR_', true);
        }
        else {
            loginAttempts++;
            components.generic.message('alert-warning', data.body.message+' '+ (5 - loginAttempts) + ' more trial(s)', '.notice');
        }
    },
    studentLoginDecisionHandler: function(data, status) {
        if (data.status == true) {
            components.generic.message('alert-success', data.body.message+'. Please wait, redirecting.. ', '.notice');
            setTimeout(() => {
                window.location.href = '../workspace.html';
            }, 6000);
        } 
        else if (data.status_code == 403) {
            components.generic.message('alert-danger', data.body.message, '.notice', 'infinite');
            $("#educator-login-form").find('input, button').attr('disabled', 'disabled');
            // perpectually prohibit login
            localStorage.setItem('_YSWEDR_', true);
        }
        else {
            loginAttempts++;
            components.generic.message('alert-warning', data.body.message+' '+ (5 - loginAttempts) + ' more trial(s)', '.notice');
        }
    },
    sessionCheckResultHandler: function(data, success) {
        if (data.status == true) {
            components.generic.message('alert-success', 'Welcome Back '+ data.body.dataset.user_type + '!', '.notice');
            setTimeout(() => {
                window.location.href = '../workspace.html';
            }, 3000);
        } else {
            // console.log(data.body.message);
        }
    },
    errorM: function(response) {
        components.generic.fullPageLoader('hide');
        let erMsg = '<b>Error:</b> ' + response.status +' - '+ response.statusText;
        components.generic.message('alert-warning', erMsg);
    }
}
auth.initialize();