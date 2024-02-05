$(document).ready(function(){
    let packageText=$(".package-text");
    let packageItems=packageText.find("li")
    let packageSvg='<div><svg style="width:23px; margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" fill="#FF7E21" viewBox="0 0 512 512"><path d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm-28.9 143.6l75.5 72.4H120c-13.3 0-24 10.7-24 24v16c0 13.3 10.7 24 24 24h182.6l-75.5 72.4c-9.7 9.3-9.9 24.8-.4 34.3l11 10.9c9.4 9.4 24.6 9.4 33.9 0L404.3 273c9.4-9.4 9.4-24.6 0-33.9L271.6 106.3c-9.4-9.4-24.6-9.4-33.9 0l-11 10.9c-9.5 9.6-9.3 25.1.4 34.4z"></path></svg></div>'
    packageItems.each(function () {
        $(this).prepend(packageSvg);
    });
})