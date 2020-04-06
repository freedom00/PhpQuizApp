//"quiz.js"
/**
 * a function to geneate a confirm popup
 * @param {str} message
 * 
 * @returns boolean 
 */
function confirmDelete(message){
    return window.confirm(message);   
}

function exportPdf() {
    const html = document.getElementById("printArea").innerHTML;
    document.getElementById("html_value").value = html;
    document.forms["html_form"].submit();
}