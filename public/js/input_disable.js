/*(function() {
    'use strict'
    var toogle_disable = document.getElementById("deactivate_group");
    var toogle_disable = document.getElementsByClassName("set_disable");
    var disable = document.getElementsByClassName("disable");
    if (toogle_disable.checked != true) {
        for (var i = 0; i < disable.length; i++) {
            disable[i].disabled = true;
            disable[i].readOnly = true;
        }
    }
    toogle_disable.onchange = function() {
        if (toogle_disable.checked != true) {
            for (var i = 0; i < disable.length; i++) {
                disable[i].disabled = true;
                disable[i].readOnly = true;
            }
        } else {
            for (var i = 0; i < disable.length; i++) {
                disable[i].disabled = false;
                disable[i].readOnly = false;
            }
        }
    };
});*/
$("[data-toggle-disable]").each(function(index, element) {
    var disable = document.getElementsByClassName("disable");
    var get_disabled = document.querySelector("[data-disable-area]")
    get_disabled = get_disabled.querySelectorAll("[data-set-disabled]");
    console.log(get_disabled)
    element.onchange = function() {
        for (var i = 0; i < get_disabled.length; i++) {
            get_disabled[i].toggleAttribute("disabled");
            // get_disabled[i].toggleAttribute("readonly");
        }
    };
});