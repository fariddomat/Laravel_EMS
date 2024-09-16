// image preview
$(".image1").change(function () {
  if (this.files && this.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $(".image1-preview").attr("src", e.target.result);
      $(".image1-preview").show();
    };
 
    reader.readAsDataURL(this.files[0]);
  } else {
    $(".image1-preview").attr("src", "");
    $(".image1-preview").hide();
  }
});

$(".image2").change(function () {
  if (this.files && this.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $(".image2-preview").attr("src", e.target.result);
      $(".image2-preview").show();
    };

    reader.readAsDataURL(this.files[0]);
  } else {
    $(".image2-preview").attr("src", "");
    $(".image2-preview").hide();
  }
});

$(".image3").change(function () {
  if (this.files && this.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $(".image3-preview").attr("src", e.target.result);
      $(".image3-preview").show();
    };

    reader.readAsDataURL(this.files[0]);
  } else {
    $(".image3-preview").attr("src", "");
    $(".image3-preview").hide();
  }
});

$(".image4").change(function () {
  if (this.files && this.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $(".image4-preview").attr("src", e.target.result);
      $(".image4-preview").show();
    };

    reader.readAsDataURL(this.files[0]);
  } else {
    $(".image4-preview").attr("src", "");
    $(".image4-preview").hide();
  }
});

$(".image5").change(function () {
  if (this.files && this.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $(".image5-preview").attr("src", e.target.result);
      $(".image5-preview").show();
    };

    reader.readAsDataURL(this.files[0]);
  } else {
    $(".image5-preview").attr("src", "");
    $(".image5-preview").hide();
  }
});

$(".image6").change(function () {
  if (this.files && this.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $(".image6-preview").attr("src", e.target.result);
      $(".image6-preview").show();
    };

    reader.readAsDataURL(this.files[0]);
  } else {
    $(".image6-preview").attr("src", "");
    $(".image6-preview").hide();
  }
});

$(".image7").change(function () {
  if (this.files && this.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $(".image7-preview").attr("src", e.target.result);
      $(".image7-preview").show();
    };

    reader.readAsDataURL(this.files[0]);
  } else {
    $(".image7-preview").attr("src", "");
    $(".image7-preview").hide();
  }
});
