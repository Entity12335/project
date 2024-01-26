


        function addFormField() {
            
            var form = document.getElementById("myForm");
            var ul = form.querySelector("ul");

            var newLi = document.createElement("li");
            newLi.innerHTML = `
            
            <input type="text" placeholder="składniki" name="składnik" required>`;
            ul.appendChild(newLi);
            let wysokość = document.getElementsByClassName("left");
            // console.log(wysokość);
            wysokość.style.height+='5vh';
            
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

