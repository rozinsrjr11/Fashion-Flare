// index== home page js

const bar = document.getElementById('bar');
const close = document.getElementById('close');
const nav = document.getElementById('navbar');


if (bar) {
    bar.addEventListener('click', () => {
        nav.classList.add('active');
    })
}
if (close) {
    close.addEventListener('click', () => {
        nav.classList.remove('active');
    })
}



let AccountBox = document.querySelector('.account-box');

document.querySelector('#user-btn').onclick = () =>{
    AccountBox.classList.toggle('active');
    nav.classList.remove('active');
}


window.onscroll = () =>{
   nav.classList.remove('active');
   AccountBox.classList.remove('active');
}






 let accountBox = document.querySelector('.account-box1');


document.querySelector('#mbl-user').onclick = () =>{
   accountBox.classList.toggle('active');
    nav.classList.remove('active');
 }
 
 





// user 

 var MainImg = document.getElementById('MainImg');
 var smallimg = document.getElementsByClassName("small-img");
 
 smallimg[0].onclick = function () {
     MainImg.src = smallimg[0].src;
 }
 smallimg[1].onclick = function () {
     MainImg.src = smallimg[1].src;
 }
 smallimg[2].onclick = function () {
     MainImg.src = smallimg[2].src;
 }
 smallimg[3].onclick = function () {
     MainImg.src = smallimg[3].src;
 }
 



 
// cart

document.querySelector('#close-update').onclick = () =>{
    document.querySelector('.edit-product-form').style.display = 'none';
    window.location.href = 'admin_product.php';
 }