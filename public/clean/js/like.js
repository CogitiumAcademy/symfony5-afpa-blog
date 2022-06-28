window.onload = () => {
    let like = document.getElementById("like")
    like.addEventListener("click", function(e){
        e.preventDefault()
        let xmlhttp = new XMLHttpRequest
        //if (this.dataset.like)
        xmlhttp.open("get", `/post/like/${this.dataset.id}`)
        xmlhttp.send() 
        console.log(`Like : ${this.dataset.id}`)
    })
}
