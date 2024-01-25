
        function addFormField() {
            
            var form = document.getElementById("myForm");
            var ul = form.querySelector("ul");

            var newLi = document.createElement("li");
            newLi.innerHTML = `
            
            <input type="text" placeholder="składniki" name="składnik" required>`;
            ul.appendChild(newLi);
            // left.style.height = (ul.offsetHeight + 5) + "vh";
        }

        //przycisk do usuwania elementu
        // function removeFormField() {
            
        //     var form = document.getElementById("myForm");
        //     var ul = form.querySelector("ul");

        //     var newLi = document.removeChild("li");
           
        //     ul.appendChild(newLi);
            
        // }
        // do podglądu obrazu
        //scieżka ma byc z value z wybranego elementu
// let sciezka = '';
// #podgladObrazu.style.backgroundImage = sciezka;