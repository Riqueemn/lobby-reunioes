
userType = document.getElementById("userType").innerHTML+"";
//userType.inneHTML=2

const domain = 'meet.jit.si';
const options = {
    roomName: document.title,
    //onload: api.executeCommand('displayName', 'New Nickname'),
    width: 700,
    height: 700,
    parentNode: document.querySelector('#meet'),
    lang: 'pt-br',
    userInfo: {
        email: '',
        displayName: userType
    }
};




api = new JitsiMeetExternalAPI(domain, options);

api.exe

api.executeCommands({
    displayName: [ 'moderador' ]});


api.addListener("videoConferenceJoined", participantJoinnedLocal_function);
api.addListener("videoConferenceLeft", participantLeftLocal_function);


api.addListener("participantJoined", participantJoinned_function);
api.addListener("participantLeft", participantLeft_function);



function getLobbys() {
    let request = new XMLHttpRequest()
    request.open("GET", "http://localhost/lobby-reunioes/api/get.php", false);
    request.setRequestHeader("Content-type", "application/json");
    request.send();
    
    return request.responseText;
}

function qtdUsersLogados() {
    let request = new XMLHttpRequest()
    request.open("GET", "http://localhost/lobby-reunioes/api/get_users.php", false);
    request.setRequestHeader("Content-type", "application/json");
    request.send();
    
    return request.responseText;
}

function getUsers() {
    let request = new XMLHttpRequest()
    request.open("GET", "http://localhost/lobby-reunioes/api/get_users.php", false);
    request.setRequestHeader("Content-type", "application/json");
    request.send();

    return request.responseText;
}

function setLobbyOnline(object) {
    let request = new XMLHttpRequest()
    request.open("POST", "http://localhost/lobby-reunioes/api/put_users.php", true);
    request.setRequestHeader("Content-type", "application/json");
    request.send(JSON.stringify(object));
    request.onload = function () {
        //console.log(this.responseText);
    }
}

function liberarSala(object) {
    let request = new XMLHttpRequest()
    request.open("POST", "http://localhost/lobby-reunioes/api/put.php", true);
    request.setRequestHeader("Content-type", "application/json");
    request.send(JSON.stringify(object));
    request.onload = function () {
        //console.log(this.responseText);
    }
}

function setStatusUsers(object) {
    let request = new XMLHttpRequest()
    request.open("POST", "http://localhost/lobby-reunioes/api/put_users.php", true);
    request.setRequestHeader("Content-type", "application/json");
    request.send(JSON.stringify(object));
    request.onload = function () {
        //confirm(this.responseText);
    }
}

function updateLobby() {
    let request = new XMLHttpRequest()
    request.open("GET", "http://localhost/lobby-reunioes/api/get.php", false);
    request.setRequestHeader("Content-type", "application/json");
    request.send();
    var responseData = request.responseText.split(",");

    lobbys['Lobby_1'] = responseData[0];
    lobbys['Lobby_2'] = responseData[1];
    lobbys['Lobby_3'] = responseData[2];
    lobbys['Lobby_4'] = responseData[3];
}


var SendStatusButton = function (object) {
    let request = new XMLHttpRequest()
    request.open("POST", "http://localhost/lobby-reunioes/api/put.php", true);
    request.setRequestHeader("Content-type", "application/json");
    request.send(JSON.stringify(object));
    request.onload = function () {
        //confirm(this.responseText);
    }
};

var participantLeft_function = function () {
    updateLobby();
    lobbys[document.title] = 'Disponivel';
    SendStatusButton(lobbys);
    confirm("participante saiu");
    console.log(api.getParticipantsInfo());

}

var participantJoinned_function = function () {
    updateLobby();
    lobbys[document.title] = 'Ocupado';
    SendStatusButton(lobbys);
    confirm("participante entrou");
    console.log("Participantes" + api.getParticipantsInfo());
}

var participantJoinnedLocal_function = function (object) {
    updateLobby();

    lobbys[document.title] = 'Disponivel';
    SendStatusButton(lobbys);

}

var participantLeftLocal_function = function (object) {
    updateLobby();
    lobbys[document.title] = 'Indisponivel';
    SendStatusButton(lobbys);

}



