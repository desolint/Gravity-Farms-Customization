jQuery(document).ready(function ($) {
$(".acf-field-62a85e3fbcfd5 input").after("<span class='errno'></span>");
acf.addAction("new_field/key=field_62a85e3fbcfd5", function ($field) {
    $field.on("keyup", function (e) {
        var arraydata = [];
        var value = $field.val();
    jQuery(".acf-field-62a85e3fbcfd5 input").each(function() {
             var datavalue = jQuery(this).val()
             arraydata.push(datavalue)
        });
        arraydata.splice(arraydata.length - 2, 2);
        if(arraydata.indexOf(value) !== -1){
            // var colortext = '';
            // $field.$el[0].children[0].after("<p class='errno'></p>");
            $field.$el[0].children[0].querySelector(".errno").innerHTML = `${value} allready Use`;
            $field.$el[0].children[0].querySelector(".errno").classList.add("active");
            document.getElementById("submit").disabled = true;
            // console.log($field.$el[0].children[0].querySelector(".errno"));
            }else{
                $field.$el[0].children[0].querySelector(".errno").innerHTML = ``;
                $field.$el[0].children[0].querySelector(".errno").classList.remove("active");
                document.getElementById("submit").disabled = false;
            }
    });
});
});