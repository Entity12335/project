window.addEventListener("DOMContentLoaded", () => {
    let temp = document.querySelector("#liTemp");
    let ul = document.querySelector('#ul');
    let butt = document.querySelector('#przycisk');
    
    let buttRemove = document.querySelectorAll(".remove-btn");
    
    butt.addEventListener("click",()=>{
        let clone = temp.content.cloneNode(true);
        console.log("tak")
        ul.appendChild(clone);
        buttRemove = document.querySelectorAll(".remove-btn");
        buttRemove.forEach(el => {
            el.addEventListener("click",()=>{
                ul.removeChild(el.parentNode);
                buttRemove = document.querySelectorAll(".remove-btn");
            });
        });
    });
});
var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };