/**
 * Created by Nabila on 26/01/2016.
 */
$(document).ready(function() {


    $("#target").on("click", ".btn-info", function () {
        $("#form").clone().fadeIn("slow").appendTo("#target");
    });

    $("#target").on("click", ".btn-danger", function () {
        $(this).parent().parent().fadeOut("slow");
    });

    $("#target2").on("click", ".btn-info", function () {
        $("#form2").clone().fadeIn("slow").appendTo("#target2");
    });

    $("#target2").on("click", ".btn-danger", function () {
        $(this).parent().parent().fadeOut("slow");
    });

    $('.list').on({
        mouseenter: function () {
            $(this).addClass('animated infinite pulse');
        },
        mouseleave: function () {
            $(this).removeClass('animated infinite pulse');
        }
    });

    $('.toplist').on({
        mouseenter: function () {
            $(this).addClass('animated swing');
        },
        mouseleave: function () {
            $(this).removeClass('animated swing');
        }
    });

        // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();

    $(".button-collapse").sideNav();
});

