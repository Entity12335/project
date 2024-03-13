

//dodawanie elementu
function addFormField() {
        
    var form = document.getElementById("myForm");
    var section = form.querySelector("hasz");
    var newA = document.createElement("hasztag");
    newA.innerHTML = `
    <a href="../strona prepisu/index.html"  class="hasztag" >  
                    <div>
                    #hasz1
                    </div>
                </a>
    `;
    section.appendChild(newA);
    };

//przycisk do usuwania elementu
    // function removeFormField(element) {
    //     var form = document.getElementById("myForm");
    //     var ul = form.querySelector("ul");
    //     var li = element.parentNode;
    //     ul.removeChild(li);
    // }
// do podglądu obrazu
//scieżka ma byc z value z wybranego elementu
// let sciezka = '';
// #podgladObrazu.style.backgroundImage = sciezka;

