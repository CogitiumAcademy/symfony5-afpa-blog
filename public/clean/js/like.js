window.onload = () => {
    let like = document.getElementById("like")
        like.addEventListener("click", function(e){
            e.preventDefault()
            let xmlhttp = new XMLHttpRequest
            if (this.dataset.like)
            xmlhttp.open("get", `/post/like/${this.dataset.id}`)
            xmlhttp.send() 
            console.log(`Like : ${this.dataset.id}`)
        })
    
    // let btdeletes = document.querySelectorAll(".modal-trigger")
    // for(let btdelete of btdeletes) {
    //     btdelete.addEventListener("click", function(){
    //         document.querySelector(".modal-footer a").href=`/admin/post/delete/${this.dataset.id}`
    //         console.log(document.querySelector(".modal-footer a").href)
    //         document.querySelector(".modal-body").innerText = `Etes-vous sûr de vouloir supprimer cet article : "${this.dataset.title}"`
    //     })
    // }
}
