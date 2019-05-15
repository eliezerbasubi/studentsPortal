const load =() => {
    // let xhr = new XMLHttpRequest()
    // xhr.open("GET","dump.php",true)

    // xhr.onreadystatechange = ()=>{
    //     if (xhr.readyState == 4 && xhr.status == 200) {
    //         // let json = JSON.parse(xhr.responseText)
    //         console.log(xhr.responseText)
    //     }
    // }

    // xhr.send()

    fetch("dump.php").then((response)=>{
        return response.text()
    }).then(myJson =>{
        console.log(JSON.stringify(myJson))
    })
}

const onLoadEvent = () =>{
    document.querySelector("#load").addEventListener("click", load)
}

const runApp = () =>{
    load()
}

runApp()