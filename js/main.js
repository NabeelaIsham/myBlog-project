const navItems = document.querySelector('.nav_items');
const navOpenBtn = document.querySelector('#open_nav-btn');
const closeNavBtn= document.querySelector('#close_nav-btn');

//opens nav dropdown

const openNav = () => {
    navItems.style.display = 'flex';
    navOpenBtn.style.display = 'none';
    closeNavBtn.style.display = 'inline-block';
}

//close nav dropdown

const closeNav = () => {
    navItems.style.display = 'none';
    navOpenBtn.style.display = 'inline-block';
    closeNavBtn.style.display = 'none';
}

navOpenBtn.addEventListener('click', openNav);
closeNavBtn.addEventListener('click',closeNav);

//sidebar

const sidebar = document.querySelector('aside');
const showSidebarBtn = document.querySelector('#show_sidebar-btn');
const hideSidebarBtn = document.querySelector('#hide_sidebar-btn');

//shows sidebar on small devices

const showSidebar = () => {
    sidebar.style.left = '0';
    showSidebarBtn.style.display = 'none';
    hideSidebarBtn.style.display = 'inline-block';
}

const hideSidebar = () => {
    sidebar.style.left = '-100%';
    showSidebarBtn.style.display = 'inline-block';
    hideSidebarBtn.style.display = 'none';
}

showSidebarBtn.addEventListener('click', showSidebar);
hideSidebarBtn.addEventListener('click', hideSidebar);



//rating

const stars = document.querySelectorAll('.star');
const ratingValue = document.querySelector('#rating-value');

let rating = 0;

stars.forEach((star) => {
  star.addEventListener('click', setRating);
});

stars.forEach((star) => {
  star.addEventListener('mouseover', fillStars);
});

stars.forEach((star) => {
  star.addEventListener('mouseout', resetStars);
});

function setRating(e) {
  const value = parseInt(e.target.getAttribute('data-value'));
  rating = value;
  ratingValue.textContent = `rated: ${rating} `;
}

function fillStars(e) {
  const value = parseInt(e.target.getAttribute('data-value'));

  stars.forEach((star, index) => {
    if (index < value) {
      star.style.color = 'gold';
    }
  });
}

function resetStars() {
  stars.forEach((star) => {
    star.style.color = '#ccc';
  });
}

//popup

const openPopupButton = document.getElementById('open-popup');
const closePopupButton = document.getElementById('close-popup');
const popupOverlay = document.getElementById('divone');

openPopupButton.addEventListener('click', openPopup);
closePopupButton.addEventListener('click', closePopup);

function openPopup() {
  popupOverlay.style.display = 'flex';
}

function closePopup() {
  popupOverlay.style.display = 'none';
}

//clear
let btnclear = document.querySelector('#close-popup');
let inputs = document.querySelector('input');

btnclear.addEventListener('click', () => {
  inputs.forEach(input =>  input.value = '');
});



