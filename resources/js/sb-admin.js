/*!
    * Start Bootstrap - SB Admin v7.0.4 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2021 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */

const { isArguments } = require("lodash");

    //
// Scripts
//

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }
    showRedStarRequired();
    setLabelTextDivider();
    autoResizeMoreCard();
});

window.showRedStarRequired = () => {
    let formControlElements = $('.form-control, .form-select');
    jQuery.each(formControlElements, (index, element) => {
        if ($(element).prop('required')) {
            let label = $(`label[for='${element.id}']`);
            if (label) {
                label.append(`<span class="text-danger">*</span>`);
            }
        }
    });
}

window.showErrorField = (errors) => {
    Object.keys(errors).forEach(key => {
        let errorField = $(`#${key}_error_field`);
        if (errorField) {
            errorField.html(errors[key].join(' | '));
            errorField.removeClass('d-none');
        }
    });
}

window.clearErrorField = () => {
    $('.error-field').each(el => {
        $(el).html('');
        $(el).addClass('d-none');
    });
}

window.activateTooltip = () => {
    let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
}

window.setLabelTextDivider = () => {
    let labelTextDiv = document.querySelectorAll('.text-divider label');
    labelTextDiv.forEach(label => {
        halfWidth = $(label).width() / 2;
        $(label).css({left: `calc(50% - ${halfWidth}px)`});
    });
}

window.copyToClipboard = (elem) => {
    // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);

    // copy the selection
    var succeed;
    try {
        succeed = document.execCommand("copy");
    } catch (e) {
        succeed = false;
    }
    return succeed;
}

window.autoResizeMoreCard = () => {
    let cards = document.querySelectorAll('.card-auto-resize');
    let heights = [];
    cards.forEach(card => {
        heights.push($(card).height());
    });
    let maxHeight = Math.max(...heights);
    cards.forEach(card => {
        $(card).css({height: `${maxHeight}px`});
    });
}
