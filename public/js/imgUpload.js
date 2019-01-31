$(document).ready(function (e) {
  $("#uploadimage").on('submit',(function(e) {
    e.preventDefault();
    $("#message").empty();
    $('#loading').show();
    $.ajax({
      url: "./model/ajaxImgUpload.php", // Url to which the request is send
      type: "POST",             // Type of request to be send, called as method
      data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
      contentType: false,       // The content type used when sending data to the server.
      cache: false,             // To unable request pages to be cached
      processData:false,        // To send DOMDocument or non processed data file it is set to false
      success: function(data)   // A function to be called if request succeeds
      {
        $('#loading').hide();
        $("#message").html(data);
        $('#newImage').appendTo($('#thePictures'));
        $('#thePictures img').on('click', function(){
          $('#thePictures img').removeClass('selectedImg');
          $(this).addClass('selectedImg');
          var lurl = $(this).attr('src');
          $('#id_image').attr('value', lurl);
          $('#imgPreview').attr('src', lurl);
        });
      }
    });
  }));

  // Function to preview image after validation
  $(function() {
    $("#file").change(function() {
      $("#message").empty(); // To remove the previous error message
      var file = this.files[0];
      var imagefile = file.type;
      var match= ["image/jpeg","image/png","image/jpg"];
      if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
      {
        $('#previewing').attr('src','./img/no-image.jpg');
        $("#message").html("<p id='error'>Merci de sélectionner un format d'image valide (jpg, jpeg, png)</p>");
        return false;
      }
      else
      {
        var reader = new FileReader();
        reader.onload = imageIsLoaded;
        reader.readAsDataURL(this.files[0]);
      }
    });
  });
  function imageIsLoaded(e) {
    $("#file").css("color","green");
    $('#image_preview').css("display", "block");
    $('#previewing').attr('src', e.target.result);
    $('#previewing').attr('width', '250px');
  };

  function tableImg(){
    var tableauImg = [];
    $('#thePictures img').each(function(){
      tableauImg.push($(this).attr('src'));
    });
  }

$('#thePictures img').on('click', function(){
  $('#thePictures img').removeClass('selectedImg');
  $(this).addClass('selectedImg');
  var lurl = $(this).attr('src');
  $('#id_image').attr('value', lurl);
  $('#imgPreview').attr('src', lurl);
});


});
