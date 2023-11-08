window.addEventListener("DOMContentLoaded",()=>{
    let x = document.forms.search
    x.addEventListener("submit",(event)=>{
        event.preventDefault()
            if(x.Szukaj.value == "rick"){
            document.querySelector("#rick").style.display = "block"
        }
        })
})