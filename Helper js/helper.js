

//include section 
document.write('<script src="https://code.jquery.com/jquery-3.6.4.min.js"><\/script>');


/*
* @package Helper.js
* @Author Shubham Gautam 
* @description Prints the info of a specified div.
* @param {string} DivId - The ID of the div to be printed. Default is "printSection".
* @return {void}
*/

function printSection(DivId = "template-page") {
    var printinfo = DivId ? document.getElementById(DivId).innerHTML : '';
    var originalinfo = document.body.innerHTML;
    document.body.innerHTML = printinfo;
    window.print();
    document.body.innerHTML = originalinfo;
}


/*
* @package Helper.js
* @Author Shubham Gautam 
*/

function FormSubmit(formId){
    $(document).ready(function () {
        $(formId).submit(function (event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: $(this).serialize(),
                success: function (response) {
                    console.log(response);
                },
                error: function (error) {
                    console.error(error);
                }
            });
        });
    });
}


