/**
*    Changes wellImage.
*
*    @return void.
*/

function changeWellImage() {
    
    var image_name = $("#input_fountain").val();
    
    $("#well-image").attr("src", "./public/images/" + image_name + ".jpg");
    
}

/**
*    Changes wellborder.
*
*    @return void.
*/
function changeWellBorder() {
    
    var border_style = $("#input_border-style").val();
    var border_color = $("#input_border-color").val();
    var border, width;
    
    if (border_style == 'none') {
        border = 'none';
        width = '265px';
    } else {
        border = '3px ' + border_style + ' ' + border_color;
        width = '259px'; // 265 - 2 * 3
    }
    
    $("#well-container")
            .css('border', border) // set border with jquery
            .css('width', width); // adjust width
    
}