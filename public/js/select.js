const toggle = document.querySelectorAll("[data-toggle-select]");
const get_area = document.querySelectorAll("[data-area-select]");

toggle.forEach((el, index) => {
    el.addEventListener("change", () => {

        var set = get_area[index].querySelectorAll("[data-set-select]");
        set.forEach((el, index) => {
            el.toggleAttribute("checked");
        });
    });
});