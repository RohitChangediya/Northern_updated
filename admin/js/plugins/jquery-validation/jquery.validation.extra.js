jQuery.validator.addMethod("nospace", function(value, element) { 
     return value.indexOf(" ") < 0 && value != ""; 
}, "Space are not allowed");



