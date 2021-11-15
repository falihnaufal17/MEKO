const appendMessage = (el, message, elChild = "small") => {
    let formText =
        el !== null ? el.getElementsByClassName("form-text")[0] : undefined;

    if (formText !== undefined) formText.parentNode.removeChild(formText);

    message =
        el.getAttribute("message") && el.getAttribute("message") !== ""
            ? el.getAttribute("message")
            : message;

    let node = document.createElement(elChild);
    let textNode = document.createTextNode(message);

    node.appendChild(textNode);
    node.classList.add("form-text");
    node.classList.add("red-color");

    el.appendChild(node);
};

const checkValidFromResponse = (
    params = {
        el: "",
        source: {},
        errResponse,
    }
) => {
    let error = [];

    const data = params.source;

    for (const key in data) {
        const elForm = document.getElementById(params.el + key);

        if (elForm) {
            const formText = elForm.getElementsByClassName("form-text")[0];

            if (formText !== undefined)
                formText.parentNode.removeChild(formText);

            if(params.errResponse != undefined){

                if(params.errResponse[key] != undefined){
                    error.push(key);
                    elForm.classList.add('error');
                    appendMessage(elForm, params.errResponse[key][0])
                }else{
                    elForm.classList.remove('error')
                }
            }else{
                elForm.classList.remove('error')
            }
        }
    }

    if (error.length === 0) return true;

    return false;
};

const formatDate = (date, isStringMonth = true, time = false) => {
    let d = new Date(date),
        month = "" + (d.getMonth() + 1),
        day = "" + d.getDate(),
        year = d.getFullYear(),
        hours = d.getHours(),
        minutes = d.getMinutes();

    const stringMonth = [
        "Jan",
        "Febr",
        "Mar",
        "Apr",
        "Mei",
        "Jun",
        "Jul",
        "Agu",
        "Sep",
        "Okt",
        "Nov",
        "Des",
    ];

    if (hours < 10) {
        hours = "0" + hours;
    }

    if (minutes < 10) {
        minutes = "0" + minutes;
    }

    if (isStringMonth) {
        month = stringMonth[month - 1];
    }

    if (month.length < 2) month = "0" + month;
    if (day.length < 2) day = "0" + day;

    return isStringMonth
        ? [day, month, year].join(" ") + (time ? " " + `${hours}:${minutes}` : '')
        : [year, month, day].join("-");
};
