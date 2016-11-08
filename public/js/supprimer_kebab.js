(function () {
    $(document).ready(function () {
        return $("#valider").on("click",function () {
            if ($("#mdp").val().length < 1) {
                alert("Le mot de passe est obligatoire");
                return false;
            } else {
                return true;
            }
        });
    });
}).call(this);