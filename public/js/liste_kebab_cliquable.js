(function() {
  $(document).ready(function() {
    return $(".wrapper").on("click", function() {
      var lien;
      lien = $(this).children(".element-titre").children("a").attr("href");
      return $(location).attr('href', lien);
    });
  });

}).call(this);
