window.addEventListener('load', function() { 

    let lookupBtn = document.getElementById("lookup");
    let resultDiv = document.getElementById("result");
    
    lookupBtn.addEventListener('click',function(event) {
        event.preventDefault();
        let country = document.querySelector("#country").value.trim();
    
        fetch(`world.php?country=${country}`)
            .then(response =>{
                if (response.ok) {
                    return response.text()
                } else {
                    return Promise.reject('Something went wrong!')
                }
            })
            .then(data => {
                resultDiv.innerHTML = data;

            })
            .catch(error => alert(error));
    });


});