<!DOCTYPE html>
<html>
<head>

</head>
<body>

    <link rel="stylesheet" href="fancybox/jquery.fancybox.css">
    <a href="filemanager/dialog.php?type=1&field_id=img" class="btn iframe-btn btn-success" type="button" style="margin-bottom:10px;"><i class="ion ion-android-camera"> Slider Image</i></a>
    <span style="color:red;margin-left:10px">*1280 x 480 px</span>
    <br/>
    <img src="" id="previmg" class="img-responsive" style="max-width:500px;max-height:500px;"/><br/>
    <input type="text" name="image" class="form-control" id="img">

      <textarea>Easy! You should check out MoxieManager!</textarea>

      <script src="js/jquery-2.2.1.min.js"></script>
      <script src="tinymce/js/tinymce/tinymce.min.js"></script>
      <script src="fancybox/jquery.fancybox.js"></script>
      <script>
      	$('.iframe-btn').fancybox({
      	 'width'     : 900,
      	 'height'    : 600,
      	 'type'      : 'iframe',
      	 'autoScale' : false
       	});
      	function responsive_filemanager_callback(field_id){
      		console.log(field_id);
      		var image = $('#' + field_id).val();
      		$('#'+"prev"+field_id).attr('src', image);
      		$('#fancybox-wrap').hide(750);
      		$('#fancybox-overlay').hide(750);
      	};
      </script>
      <script>
      tinymce.init({
        selector: "textarea",theme: "modern",width: 1000,height: 300,
        plugins: [
             "advlist autolink link image lists charmap print preview hr anchor pagebreak",
             "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
             "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
       ],
       toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
       toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
       image_advtab: true ,

       external_filemanager_path:"/media/filemanager/",
       filemanager_title:"Responsive Filemanager" ,
       external_plugins: { "filemanager" : "/media/filemanager/plugin.min.js"}
     });
     </script>
</body>
</html>
