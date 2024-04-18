function addHashtagElement() {
 
    var newHashtag = document.createElement("a");
    newHashtag.setAttribute("href", "../strona prepisu/index.html");
    newHashtag.classList.add("hasztag");
    newHashtag.textContent = "hasz"; 

    var section = document.querySelector(".hasz");

    if (section) {
        section.appendChild(newHashtag);
    } else {
        console.error("Sekcja o klasie 'hasz' nie została znaleziona.");
    }
}

var button = document.querySelector("przycisk");

button.addEventListener("click", addHashtagElement);
