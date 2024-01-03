window.addEventListener("DOMContentLoaded",()=>{
    let clicked = false
    document.querySelector("#seepass").addEventListener("click",()=>{
        if(clicked == false){
        document.querySelector("#password").type = "text"
        clicked = true
        }else{
        document.querySelector("#password").type = "password"
        clicked = false
        }
    })
})