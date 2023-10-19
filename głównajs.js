function rick(){
    let pruf = document.forms["myForm"]["Szukaj"].value
    let x = document.querySelector("#rick")
    if(pruf=="rick")
    {
        document.querySelector("#rick").style = "display: block;"
    }
}