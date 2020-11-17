function getDate() {
    var date = new Date();
    $('.nav__time').text(date)
}

setInterval(getDate, 1000);     
