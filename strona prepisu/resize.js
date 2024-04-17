window.addEventListener("DOMContentLoaded", () => {
    function handleResize(){
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    };
    const nazwa = document.querySelector('#formName');
    const formHasz = document.querySelector('#formHasz');
    const formOpis = document.querySelector('#formOpis');
    const formPrzepis = document.querySelector('#formPrzepis');

    nazwa.addEventListener('input',handleResize);
    formHasz.addEventListener('input',handleResize);
    formOpis.addEventListener('input',handleResize);
    formPrzepis.addEventListener('input',handleResize);

});