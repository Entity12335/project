
//function addFormField() {
        
    // var form = document.getElementById("myForm");
    // var section = form.getElementsByClassName("hasztag");
    // var newA = document.getElementsByClassName("hasz");
    // newA.innerHTML = `
    // <a href="../strona prepisu/index.html"  class="hasztag" >  
    //               #hasz
    //             </a>
    // `;
    // section.appendChild(newA);
    // };

function addHashtagElement() {
    var newHashtag = document.createElement("a");
    newHashtag.setAttribute("href", "../strona prepisu/index.html");
    newHashtag.classList.add("hasztag");
    newHashtag.textContent = "hasz";  
    var section = document.querySelector("article");
    section.appendChild(newHashtag);
}
function addButtonClick() {
    addHashtagElement();
}
var button = document.querySelector("przycisk");
button.addEventListener("click", addButtonClick);
