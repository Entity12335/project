

//dodawanie elementu
function addFormField() {
        
    var form = document.getElementById("myForm");
    var ul = form.querySelector("ul");
    var newLi = document.createElement("li");
    newLi.innerHTML = `
    <input type="text" placeholder="składniki" name="składnik" required>
    <span class="remove-btn" onclick="removeFormField(this)">usuń składnik</span>
    `;
    ul.appendChild(newLi);
    };

//przycisk do usuwania elementu
    function removeFormField(element) {
        var form = document.getElementById("myForm");
        var ul = form.querySelector("ul");
        var li = element.parentNode;
        ul.removeChild(li);
    }
// do podglądu obrazu
//scieżka ma byc z value z wybranego elementu
// let sciezka = '';
// #podgladObrazu.style.backgroundImage = sciezka;

