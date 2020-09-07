// utility modules
import { api_resquest_maker, api_resquest_maker2 } from './../util/ajaxHandler.js';
import { apiEndpoints } from './../util/apiEndpoints.js';
import { fileEndPoints } from './../util/fileEndPoints.js';
import { components } from './../util/components.js';
import { globals } from './../util/global.js';



$("#call-propmt").click(function() {
    components.generic.prompt({
        icon: true,
        notice: 'Test',
        details: 'asdoaishjfahfweiuhewew',
        controls: true,
        callback: (status) => {
            console.log(status);
        }
    });
});


console.log(apiEndpoints);

const request = {
    preference: '',
    age: '26'
}





api_resquest_maker(apiEndpoints.UpdateTextContent, 'POST', {}, request, (data, status) => {

    // const payload = data.body.dataset;

    console.log(data);


    // for (let index = 0; index < payload.length; index++) {
    //     const content = payload[index];

    //     components.generic.employee_search_result({
    //         destination: ".container",
    //         id: content.id,
    //         image: fileEndPoints.img.staff + content.photo,
    //         fullname: content.First_Name,
    //         position: content.accountType,
    //     });

        
    // }


    


}, errorFunction );


function errorFunction(responseTxt) {
    console.log(responseTxt);
}

