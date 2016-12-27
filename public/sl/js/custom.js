jQuery(document).ready(function ($) {

    var jssor_1_options = {
      $AutoPlay: false,
      $ArrowNavigatorOptions: {
        $Class: $JssorArrowNavigator$
      },
      $ThumbnailNavigatorOptions: {
        $Class: $JssorThumbnailNavigator$,
        $Cols: 3,
        $SpacingX: 3,
        $SpacingY: 3,
        $Align: 260
      }
    };

    var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

///////////////////////////////////

	var jssor_2_options = {
	      $AutoPlay: false,
	      $ArrowNavigatorOptions: {
	        $Class: $JssorArrowNavigator$
	      },
	      $ThumbnailNavigatorOptions: {
	        $Class: $JssorThumbnailNavigator$,
	        $Cols: 3,
	        $SpacingX: 3,
	        $SpacingY: 3,
	        $Align: 260
	      }
	    };

	   var jssor_2_slider = new $JssorSlider$("jssor_2", jssor_2_options);
    




    function ScaleSlider() {
        var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
        if (refSize) {
            refSize = Math.min(refSize, 600);
            jssor_1_slider.$ScaleWidth(refSize);
        }
        else {
            window.setTimeout(ScaleSlider, 130);
        }
    }
    ScaleSlider();
    $(window).bind("load", ScaleSlider);
    $(window).bind("resize", ScaleSlider);
    $(window).bind("orientationchange", ScaleSlider);



     function ScaleSlider2() {
        var refSize = jssor_2_slider.$Elmt.parentNode.clientWidth;
        if (refSize) {
            refSize = Math.min(refSize, 600);
            jssor_2_slider.$ScaleWidth(refSize);
        }
        else {
            window.setTimeout(ScaleSlider, 130);
        }
    }
    ScaleSlider2();
    $(window).bind("load", ScaleSlider2);
    $(window).bind("resize", ScaleSlider2);
    $(window).bind("orientationchange", ScaleSlider2);













});