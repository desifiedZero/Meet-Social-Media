var navHidden = true;

function navSeek() {
  $(".navcontainer").animate(
    {
      width: "350px",
      overflow: "visible",
    },
    400
  );

  $(".menuoverlay").show();
  $("#cross-nav").show();

  $("body").css({
    position: "fixed",
  });
}

function navHide() {
  $(".navcontainer").animate(
    {
      width: "0",
      overflow: "hidden",
    },
    400
  );
  $(".menuoverlay").hide();
  $("#cross-nav").hide();
  $("body").css({
    position: "static",
  });
}
