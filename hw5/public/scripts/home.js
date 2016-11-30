function changeWellImage() {
    
    var image_name = $("#input_fountain").val();
    
    $("#well-image").attr("src", "./public/images/" + image_name + ".jpg");
    
}
