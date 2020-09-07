// utility modules
import { api_resquest_maker, api_resquest_maker2 } from './../util/ajaxHandler.js';
import { apiEndpoints } from './../util/apiEndpoints.js';
import { fileEndPoints } from './../util/fileEndPoints.js';
import { components } from './../util/components.js';
import { globals } from './../util/global.js';
// admin modules
import { adminManager } from './admin/adminManager.js';
// admissions modules
import { admissionsManager } from './admissions/admissionsManager.js';
// finance modules
import { financeManager } from './finance/financeManager.js';
// teacher modules
import { teacherHomeManager } from './teacher/teacherManager.js';
// student modules
import { studentHomeManager } from './student/homeManager.js';
import { studentClassroomManager } from './student/classroomManager.js';


// NOTE: refers to [this] for accessibility
let instance; 

class workspace extends globals {
    constructor() {
        super();
        instance = this;
        instance.sessionCheck();
        instance.connectionStats();
    }
    sessionCheck() {
        api_resquest_maker(apiEndpoints.ControllerAid, 'GET', {}, { FetchUserType: 'true' }, instance.getUserType, instance.errorM );
    }
    getUserType(data, status) {
        if (data.status == true) {
            components.generic.fullPageLoader('show');
            instance.displayNavLinks(data.body.dataset.user_type);
        } else {
            instance.pageRouter('401.html');
        }
    }
    displayNavLinks(userType) {
        if (userType == 'admin') {
            $(".sidebar-nav-dynamic-section").html(components.nav.admin);
            instance.initialViewSelector('admin-home');
        } 
        else if (userType == 'admission') {
            $(".sidebar-nav-dynamic-section").html(components.nav.admission);
            instance.initialViewSelector('admission-home');
        } 
        else if (userType == 'finance') {
            $(".sidebar-nav-dynamic-section").html(components.nav.finance);
            instance.initialViewSelector('finance-home');
        } 
        else if(userType == 'teacher') {
            $(".sidebar-nav-dynamic-section").html(components.nav.teacher);
            instance.initialViewSelector('teacher-home');
        } 
        else if(userType == 'student') {
            $(".sidebar-nav-dynamic-section").html(components.nav.student);
            instance.initialViewSelector('studentHome');
        } 
        // let user click link to display desired view
        instance.navLinksControls();
    }
    navLinksControls() {
        // fetch user desired widget
        $(".sidebar-nav-btn").click(function() {
            if (window.navigator.onLine == true) {
                let targeted_view = $(this).data('target-view');
                if (targeted_view == 'Exit') {
                    // 
                    components.generic.prompt({
                        notice: 'Are you ready to exit?',
                        details: 'Please ensure all of your work is saved',
                        callback: function(result) {
                            if (result == true) {
                                localStorage.removeItem('atlas-current-workspace')
                                api_resquest_maker(apiEndpoints.signout, 'GET', {}, { }, instance.signout, instance.errorM );
                            } 
                        }
                    });
                } else {
                    instance.navigationHistory({main: true, log: targeted_view });
                    api_resquest_maker('widgets/'+targeted_view+'.widget.html', 'GET', {}, { }, instance.displayWidget, instance.errorM );
                }
            } else {
                components.generic.prompt({
                    notice:  'Internet Error!',
                    details: 'This action cannot be completed in the absence of a network connection',
                    controls:false,
                });
            }
        });
        // display password reset form with functionality for non admin users
        $(".regular-account-pwdRest-btn").click(function( event ) {
            components.generic.pwdRest();
            instance.resetPwd(); 
        });
    }    
    initialViewSelector(targeted_view) {
        // load view from navigationHistory
        if (localStorage.getItem('atlas-current-workspace') != null ) {
            targeted_view = JSON.parse(localStorage.getItem('atlas-current-workspace'));
            api_resquest_maker('widgets/'+targeted_view[0].main+'.widget.html', 'GET', {}, { }, instance.displayWidget, instance.errorM );
        } 
        // load default view 
        else {
            instance.navigationHistory({main: true, log: targeted_view });
            api_resquest_maker('widgets/'+targeted_view+'.widget.html', 'GET', {}, { }, instance.displayWidget, instance.errorM );
        }
    }
    navigationHistory(options) {
        if (options.main == true && options.log != "") {
            const user_navigationHistory = []; // empty
            user_navigationHistory.push({main: options.log, sub: ''});
            localStorage.setItem('atlas-current-workspace', JSON.stringify(user_navigationHistory));
        } 
        if (options.sub == true && options.log != "") {
            const user_navigationHistory = JSON.parse(localStorage.getItem('atlas-current-workspace'));
            user_navigationHistory[0].sub = options.log;
            localStorage.setItem('atlas-current-workspace', JSON.stringify(user_navigationHistory));
        }
        if (options.retorePrevious == true) {
            const user_navigationHistory = JSON.parse(localStorage.getItem('atlas-current-workspace'));
            $("body").find('.toggable').each(function() {
                if ($(this).data('target') == user_navigationHistory[0].sub) {
                    $(this).click();
                }
            });
        }
    }
    displayWidget(data, status) {
        $(".workspace-dynamic-area").html( data );
        components.generic.fullPageLoader('hide'); // remove when [WidgetFunctionalities] is done
        instance.WidgetFunctionalities();
        instance.navigationHistory({retorePrevious: true});
    }
    WidgetFunctionalities() {
        const widget = JSON.parse(localStorage.getItem('atlas-current-workspace'));
        switch (widget[0].main) {
            case 'studentHome':
                new studentHomeManager();
                break;
            case 'student-classroom':
                new studentClassroomManager();
                break;  
            case 'teacher-home':
                teacherHomeManager.initialize();
                break;
            case 'admin-home':
                new adminManager();
                break;
            case 'admission-home':
                new admissionsManager();
                break;
            case 'finance-home':
                financeManager.initialize();
                break;
            case '':
                break;
            default:
                break;
        } //components.generic.fullPageLoader('hide'); // actual location
        // NOTE: global 
        globals.sharedFunctionalities();
    }
    connectionStats() {
        setInterval(() => {
            if (window.navigator.onLine == true) {
                    localStorage.setItem('onlineStatus', 'true');
                    components.generic.onlineStatus({type: 'online'});
                } else {
                    localStorage.setItem('onlineStatus', 'false');
                    components.generic.onlineStatus({type: 'offline'});
                }
        }, 3000);
    }
    resetPwd() {
        $("#password-reset-form").submit(function( event ) {
            event.preventDefault();
            alert();
        });
    }
    signout(data, status) {
        localStorage.removeItem('atlas-current-workspace')
        instance.pageRouter();
    }
    pageRouter(destination=0, timer=0) {
        setTimeout(() => {
            window.location.href = (destination != "") ? destination : 'index.html';
        }, timer);
    }
    errorM(response) {
        components.generic.fullPageLoader('hide');
        let erMsg = '<b>Error:</b> ' + response.status +' - '+ response.statusText;
        components.generic.message('alert-warning', erMsg);
    }
}
// 
new workspace();






