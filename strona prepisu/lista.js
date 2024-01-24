function addFormField() {
    var form = document.getElementById("myForm");
    var ul = form.querySelector("ul");

    var newLi = document.createElement("li");
    newLi.innerHTML = `
    
    <input type="text" placeholder="składniki" name="składnik" required>`;
    ul.appendChild(newLi);
    left.style.height = (ul.offsetHeight + 5) + "vh";
}