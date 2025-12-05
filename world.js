window.onload = function() {
    var lookup = document.getElementById("lookup");
    var result = document.getElementById("result");
    var cityLookUpBtn = document.getElementById("city-Btn");

    lookup.addEventListener("click", function() {
        var country = document.getElementById("country").value;

        fetch("world.php?country=" + country)
            .then(function(res) {
                return res.text();
            })
            .then(function(data) {
                result.innerHTML = data;
            })
            .catch(function() {
                result.innerHTML = "Error!!";
            });
    });
    cityLookUpBtn.addEventListener("click", function () {
        const countryInput = document.getElementById("country").value;
        const url = "world.php?country=" + encodeURIComponent(countryInput) + "&lookup=cities";
        fetch(url)
        .then(function(response) {
            return response.text();
        })
        .then(function(data) {
            const result = document.getElementById("result");
            result.innerHTML = data;
        })
        .catch(function(error) {
            console.error("Error getting the data:", error);
            const result = document.getElementById("result");
            result.innerHTML = "<p>Error getting the data.</p>";
        });
});

};
