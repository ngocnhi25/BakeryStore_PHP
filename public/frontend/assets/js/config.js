const VIETNAMDONG = '\u20ab';

function format_curency(money, symbol='') {
  if (symbol == '') {
    symbol = VIETNAMDONG;
  }
  money = money.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
  return money+symbol;
};

function isValidNumber(number) {
  if (typeof number == "number") {
    return true;
  }
  return false;
}

function isGreaterThan(number, compareTo) {
  if (isValidNumber(number) && number > compareTo) {
    return true;
  }
  return false;
}


function toggleOverlayHidden() {
  $('.fullscreen-overlay').toggleClass('active');
  $('body').toggleClass('active-100vh');
}

function toggleMessageBox(msg) {
  // $('.messagebox').toggleClass('active');
  let messageBox = new MessageBox(msg);
}


function setCookie(cname,cvalue,exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires=" + d.toGMTString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
