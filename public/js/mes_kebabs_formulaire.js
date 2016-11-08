(function () {
    $(document).ready(function () {
        return $("#valider").on("click", function () {
            var regexp = /^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/;
            var mail =$("#mail").val();
            if (mail.length < 1) {
                alert("L'adresse électronique est obligatoire");
                return false;
            } else if (!regexp.exec(mail)) {
                alert("Veuillez saisir une adresse électronique valide");
                return false;
            } else {
                $("#valider").attr("href", $("#valider").attr("href") + "/mes_kebabs/" + mail);
                return true;
            }
        });
    });
}).call(this);