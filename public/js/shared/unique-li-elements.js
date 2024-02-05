$(document).ready(function () {
    let firstBox = $(".unique-box .unique-product:first");
    let elList = firstBox.find("li");
    elList.addClass('parent v-center');
    let svg = '<div><svg style="width: 20px; margin-right: 5px;" xmlns="http://www.w3.org/2000/svg" fill="#00A412" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg></div>';
    elList.each(function () {
        $(this).prepend(svg);
    });

    let secondBox = $(".unique-box .unique-product").eq(1);
    let elList2 = secondBox.find("li");
    elList2.addClass('parent v-center');
    let svg2 = '<div><svg style="width: 20px; margin-right: 5px;" xmlns="http://www.w3.org/2000/svg" fill="#FF0000" viewBox="0 0 512 512"><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z"/></svg></div>';
    elList2.each(function () {
        $(this).prepend(svg2);
    });
});