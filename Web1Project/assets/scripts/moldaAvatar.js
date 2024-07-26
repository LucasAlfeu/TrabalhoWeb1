let btnEsquerdo = document.getElementById("btn__esquedo")

let cabelo = "./assets/images/cabelo/1.png"
let rosto = "./assets/images/rosto/1.png"
let pele = "./assets/images/pele/1.png"
let torso = "./assets/images/torso/1.png"
let pernas = "./assets/images/pernas/1.png"

function aumentarCabelo(element, imgCabelo){
    const num = 5
    let path
    pecaLego = parseInt(element.value, 10)
    if(pecaLego < num){
        pecaLego += 1
    } else {
        element.value = 1
        pecaLego = 1
    }
    path = `./assets/images/cabelo/${pecaLego}.png`
    imgCabelo.src = path
    element.value = pecaLego
    cabelo = path
}

function diminuirCabelo(element, imgCabelo){
    const num = 5
    let path
    pecaLego = parseInt(element.value, 10)
    if(pecaLego > 1){
        pecaLego -= 1
    } else {
        element.value = num
        pecaLego = num
    }
    path = `./assets/images/cabelo/${pecaLego}.png`
    imgCabelo.src = path
    element.value = pecaLego
    cabelo = path
}

function aumentarRosto(element, imgRosto){
    const num = 17
    let path
    pecaLego = parseInt(element.value, 10)
    if(pecaLego < num){
        pecaLego += 1
    } else {
        element.value = 1
        pecaLego = 1
    }
    path = `./assets/images/rosto/${pecaLego}.png`
    imgRosto.src = path
    element.value = pecaLego
    rosto = path
}

function diminuirRosto(element, imgRosto){
    const num = 17
    let path
    pecaLego = parseInt(element.value, 10)
    if(pecaLego > 1){
        pecaLego -= 1
    } else {
        element.value = num
        pecaLego = num
    }
    path = `./assets/images/rosto/${pecaLego}.png`
    imgRosto.src = path
    element.value = pecaLego
    rosto = path
}

function aumentarPele(element, imgPele){
    const num = 9
    let path
    pecaLego = parseInt(element.value, 10)
    if(pecaLego < num){
        pecaLego += 1
    } else {
        element.value = 1
        pecaLego = 1
    }
    path = `./assets/images/pele/${pecaLego}.png`
    imgPele.src = path
    element.value = pecaLego
    pele = path
}

function diminuirPele(element, imgPele){
    const num = 9
    let path
    pecaLego = parseInt(element.value, 10)
    if(pecaLego > 1){
        pecaLego -= 1
    } else {
        element.value = num
        pecaLego = num
    }
    path = `./assets/images/pele/${pecaLego}.png`
    imgPele.src = path
    element.value = pecaLego
    pele = path
}

function aumentarTorso(element, imgTorso){
    const num = 21
    let path
    pecaLego = parseInt(element.value, 10)
    if(pecaLego < num){
        pecaLego += 1
    } else {
        element.value = 1
        pecaLego = 1
    }
    path = `./assets/images/torso/${pecaLego}.png`
    imgTorso.src = path
    element.value = pecaLego
    torso = path
}

function diminuirTorso(element, imgTorso){
    const num = 21
    let path
    pecaLego = parseInt(element.value, 10)
    if(pecaLego > 1){
        pecaLego -= 1
    } else {
        element.value = num
        pecaLego = num
    }
    path = `./assets/images/torso/${pecaLego}.png`
    imgTorso.src = path
    element.value = pecaLego
    torso = path
}

function aumentarPerna(element, imgPerna){
    const num = 9
    let path
    pecaLego = parseInt(element.value, 10)
    if(pecaLego < num){
        pecaLego += 1
    } else {
        element.value = 1
        pecaLego = 1
    }
    path = `./assets/images/pernas/${pecaLego}.png`
    imgPerna.src = path
    element.value = pecaLego
    pernas = path
}

function diminuirPerna(element, imgPerna){
    const num = 9
    let path
    pecaLego = parseInt(element.value, 10)
    if(pecaLego > 1){
        pecaLego -= 1
    } else {
        element.value = num
        pecaLego = num
    }
    path = `./assets/images/pernas/${pecaLego}.png`
    imgPerna.src = path
    element.value = pecaLego
    pernas = path
}

function mostraPaths(){
    console.log(cabelo)
    console.log(rosto)
    console.log(pele)
    console.log(torso)
    console.log(pernas)
}