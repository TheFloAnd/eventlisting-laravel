const toggle_disable = document.querySelectorAll("[data-toggle-disable]");
const get_disable_area = document.querySelectorAll("[data-area=disable]");
toggle_disable.forEach((el, index) => {
    el.addEventListener("change", () => {
        var set_disabled = get_disable_area[index].querySelectorAll(
            "[data-set-disabled]"
        );
        set_disabled.forEach((el, index) => {
            el.toggleAttribute("disabled");
        });
    });
});