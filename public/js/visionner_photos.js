(function() {
  $(document).ready(function() {
    return $(".mini").on("click", function() {
      return $(".grande").attr("src", this.src);
    });
  });

}).call(this);
