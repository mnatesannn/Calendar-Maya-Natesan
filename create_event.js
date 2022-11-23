document.getElementById('event_btn').addEventListener('click', create_event);

function create_event(){
    
    const event_name = document.getElementById('event_name').value;
    const event_date = document.getElementById('event_datetime').value;
    //now we have values that hold the user inputs for each registration element
    const data = { event_name: event_name, event_date: event_date};
    console.log(data);
    //this is a java script object that makes key value pairs, acts as a map
    fetch(url + '/create_event.php', {
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