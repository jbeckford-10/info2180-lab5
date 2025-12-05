window.onload = function() {
    var lookup = document.getElementById("lookup");
    var result = document.getElementById("result");

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
};
