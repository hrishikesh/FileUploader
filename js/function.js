/**
 * Created By Hrishikesh
 * User: webonise
 * Date: 27/12/12
 * Time: 7:03 PM
 * To change this template use File | Settings | File Templates.
 */

$(document).ready(function() {

    var errors="";

    $('#aupload').mfupload({

        type		: '',	//all types
        maxsize		: 1024,
        post_upload	: "./upload.php",
        folder		: "./",
        ini_text	: "Drag your files to here or click (max: 2MB each)",
        over_text	: "Drop Here",
        over_col	: 'white',
        over_bkcol	: 'green',

        init		: function(){
            $("#uploaded").empty();
        },

        start		: function(result){
            $("#uploaded").append('<div id="FILE'+result.fileno+'" class="files" ><div class="fname">'+result.filename+'</div><div class="prog"><div id="PRO'+result.fileno+'" class="prog_inn"></div></div></div>');
        },

        loaded		: function(result){
            $("#PRO"+result.fileno).parent().remove();
            $("#FILE"+result.fileno).html("Uploaded: "+result.filename+" ("+result.size+")");
        },

        progress	: function(result){
            $("#PRO"+result.fileno).css("width", result.perc+"%");

        },

        error		: function(error){
            errors += error.filename+": "+error.err_des+"\n";
        },

        completed	: function(){
            if (errors != "") {
                alert(errors);
                errors = "";
            }
        }
    });
});
