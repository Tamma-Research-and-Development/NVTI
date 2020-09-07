export function api_resquest_maker(
    ENDPOINT, 
    METHOD, 
    HEADER, 
    DATA_VALUES, 
    FUNCTIONN_NAME,
    ERROR_HANDLER = 0
) {
    $.ajax({
        url:      ENDPOINT,
        method:   METHOD,
        headers:  HEADER,
        data:     DATA_VALUES,
        success:  FUNCTIONN_NAME,
        error:    (ERROR_HANDLER == 0) ? '' : ERROR_HANDLER
    });
}

export function api_resquest_maker2(
    ENDPOINT, 
    METHOD, 
    HEADER, 
    DATA_VALUES,
    RETURN_TYPE
) {
    return fetch(ENDPOINT, {
        method: METHOD, 
        mode: 'cors', 
        cache: 'no-cache',
        credentials: 'same-origin', // include, *same-origin, omit
        headers: (ENDPOINT == undefined) ? {'Content-Type': 'application/x-www-form-urlencoded'} : HEADER,
        redirect: 'follow', // manual, *follow, error
        referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
        DATA_VALUES // body: {}
    })
    .then((response) => {
        return (RETURN_TYPE == 'JSON') ? response.json() : (RETURN_TYPE == 'TEXT') ? response.text(): {status: false, body: { mesage: 'JSON/TEXT' }};
    })
    .then((result) => {
        return result;
    })
    .catch(error => console.log('error', error))
}