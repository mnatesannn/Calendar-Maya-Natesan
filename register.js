document.getElementById('register_btn').addEventListener('click', register_user);

function register_user(){
    const username = document.getElementById('register_username').value;
    const password = document.getElementById('register_password').value;
    const first_name = document.getElementById('first_name').value;
    const last_name = document.getElementById('last_name').value;
    //now we have values that hold the user inputs for each registration element
    const data = { username: username, password: password, first_name: first_name, last_name: last_name };
    console.log(data);
    
    const url = '/~mnatesan/module5-group-module5-476325-477223';

    //this is a java script object that makes key value pairs, acts as a map
    fetch(url + '/register_ajax.php', {
        method: "POST",
        body: JSON.stringify(data),
        header: { 'content-type': 'application/json' }
    })
    //now the information has been sent to the server, that php page that registers the user, we want to check for a response back
    .then(response => response.json())
    //this method gets the response as a string and then converts it to a json object
    .then(json_response => {
        //this creates another function inside the response function
        console.log(json_response);
    })
}