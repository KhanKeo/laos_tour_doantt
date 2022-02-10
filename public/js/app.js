const showSuccess = (content, time = 5000) => {
    let toastElement = $('#toast');
    
    let toastContentElement = $('#toast-content');
    toastContentElement.removeClass('alert-danger');
    toastContentElement.addClass('alert-success');

    toastContentElement.text(content);

    toastElement.removeClass('toast-hidden');
    hiddenToast(time);
}

const showError = (content, time = 5000) => {
    let toastElement = $('#toast');
    
    let toastContentElement = $('#toast-content');
    toastContentElement.removeClass('alert-success');
    toastContentElement.addClass('alert-danger');

    toastContentElement.text(content);

    toastElement.removeClass('toast-hidden');
    hiddenToast(time);
}

const hiddenToast = (time = 5000) => {
    setTimeout(() => {
        let toastElement = $('#toast');
        toastElement.addClass('toast-hidden');
    }, time);
}

const redirect = (url, message = '', status = 'success') => {
    if (message)
        url += '?rMessage=' + message + '&' + 'rStatus=' + status;
    location.href = url;
}

const showInitMessage = () => {
    let _url = new URL(location.href);
    let rMessage = _url.searchParams.get("rMessage");
    if (rMessage) {
        let rStatus = _url.searchParams.get("rStatus");
        if (rStatus == 'success')
            showSuccess(rMessage);
        else if (rStatus == 'error') showError(rMessage);
    }
}

const validate = (errors) => {
    $('.help-block').remove();
    $('.form-group').removeClass('has-error');
    for (let key in errors) {
        $('#' + key).parent().parent().addClass('has-error');
        $('#' + key).parent().append('<span class="help-block">' + errors[key] + '</span>');
    }
}

$(document).ready(() => {
    showInitMessage();
});

document.querySelectorAll("img").forEach((element) => element.onerror = () => {element.src = "/public/images/main/empty.png"});