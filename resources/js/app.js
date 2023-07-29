import './bootstrap';

const modal =document.querySelector(".modal");
const showModal =document.querySelector(".show-modal");
const closeModal =document.querySelector(".close-modal");

showModal.addEventListener('click' , function () {
    const page = document.querySelector(".page");
    modal.classList.remove('hidden');
})

closeModal.addEventListener('click' , function () {
    const page = document.querySelector(".page");
    modal.classList.add('hidden');
})





