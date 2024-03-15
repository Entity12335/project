window.addEventListener("DOMContentLoaded", () => {
    let temp = document.querySelector("#liTemp");
    let ul = document.querySelector('#ul');
    let butt = document.querySelector('#przycisk');
    butt.addEventListener("click",()=>{
        let clone = temp.content.cloneNode(true);
        console.log("tak")
        ul.appendChild(clone);
        console.log(ul.childNodes)
        
    });
});