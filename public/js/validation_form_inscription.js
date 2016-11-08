(function() {
  $(document).ready(function() {
    var validator;
    validator = new FormValidator('form_inscription', [
      {
        name: 'mail',
        display: 'Adresse email',
        rules: 'required'
      }, {
        name: 'pseudo',
        display: 'Pseudo',
        rules: 'required'
      }, {
        name: 'prenom',
        display: 'Prénom',
        rules: 'required'
      }, {
        name: 'nom',
        display: 'Nom',
        rules: 'required'
      },   {
        name: 'ville',
        display: 'Ville',
        rules: 'required'
      }, {
        name: 'mdp',
        display: 'Mot de passe',
        rules: 'required'
      }, {
        name: 'confirm_mdp',
        display: 'confirmation du mot de passe',
        rules: 'required|matches[mdp]|min_length[6]'
      }
    ], function(errors, event) {
      var error, _i, _len, _results;
      if (errors.length > 0) {
        $(".error").remove();
        _results = [];
        for (_i = 0, _len = errors.length; _i < _len; _i++) {
          error = errors[_i];
          _results.push($("<span>").text(error.message).attr("class", "error").insertBefore(".boutons"));
        }
        return _results;
      }
    });
    validator.setMessage("required", "Le champ %s est requis.");
    validator.setMessage("matches", "La %s n'est pas valide");
    return validator.setMessage("min_length", "Le champ %s doit contenir au moins %s caractères");
  });

}).call(this);
