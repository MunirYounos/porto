//nav toggle
const Nav = document.querySelector('.navigation');
const toggleWrap = document.querySelector('.toggle-wrap');
const navToggle = document.querySelector('.nav-toggle');
const navItems = document.querySelectorAll('.menu-item');
let showMenu = false;
toggleWrap.addEventListener('click', toggleMenu);

function toggleMenu(){
if(!showMenu){
    navToggle.classList.add('close');
    Nav.classList.add('show');
    navItems.forEach(item => item.classList.add('show'));
    showMenu = true;
}else{
    navToggle.classList.remove('close');
    Nav.classList.remove('show');
    navItems.forEach(item => item.classList.remove('show'));
    showMenu = false;
}
}

//search toggle
const searchIcon = document.querySelector('.search-icon');
const searchForm = document.querySelector('.search-form');
const searchCloser = document.querySelector('.search-closer');

searchIcon.addEventListener('click', addClassToForm);
function addClassToForm(e){
    searchForm.classList.add('show');
}
searchCloser.addEventListener('click', removeClassFromForm);
function removeClassFromForm(){
    searchForm.classList.remove('show');
}

// text animate
  var TxtType = function(el, toRotate, period) {
    this.toRotate = toRotate;
    this.el = el;
    this.loopNum = 0;
    this.period = parseInt(period, 10) || 2000;
    this.txt = '';
    this.tick();
    this.isDeleting = false;
};

TxtType.prototype.tick = function() {
    var i = this.loopNum % this.toRotate.length;
    var fullTxt = this.toRotate[i];

    if (this.isDeleting) {
    this.txt = fullTxt.substring(0, this.txt.length - 1);
    } else {
    this.txt = fullTxt.substring(0, this.txt.length + 1);
    }

    this.el.innerHTML = '<span class="wrap">'+this.txt+'</span><strong class="blinker"></strong>';

    var that = this;
    var delta = 200 - Math.random() * 100;

    if (this.isDeleting) { delta /= 2; }

    if (!this.isDeleting && this.txt === fullTxt) {
    delta = this.period;
    this.isDeleting = true;
    } else if (this.isDeleting && this.txt === '') {
    this.isDeleting = false;
    this.loopNum++;
    delta = 500;
    }

    setTimeout(function() {
    that.tick();
    }, delta);
};

window.onload = function() {
    var elements = document.getElementsByClassName('typewrite');
    for (var i=0; i<elements.length; i++) {
        var toRotate = elements[i].getAttribute('data-type');
        var period = elements[i].getAttribute('data-period');
        if (toRotate) {
          new TxtType(elements[i], JSON.parse(toRotate), period);
        }
    }
};