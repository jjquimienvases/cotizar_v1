/**
 * Convierta una cadena base64 en un Blob de acuerdo con los datos y contentType.
 * 
 * @param b64Data {String} Cadena pura base64 sin contentType
 * @param contentType {String} el tipo de contenido del archivo i.e (application/pdf - text/plain)
 * @param sliceSize {Int} SliceSize para procesar el byteCharacters
 * @see http://stackoverflow.com/questions/16245767/creating-a-blob-from-a-base64-string-in-javascript
 * @return Blob
 */
 function b64toBlob(b64Data, contentType, sliceSize) {
    contentType = contentType || '';
    sliceSize = sliceSize || 512;

    var byteCharacters = atob(b64Data);
    var byteArrays = [];

    for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
        var slice = byteCharacters.slice(offset, offset + sliceSize);

        var byteNumbers = new Array(slice.length);
        for (var i = 0; i < slice.length; i++) {
            byteNumbers[i] = slice.charCodeAt(i);
        }

        var byteArray = new Uint8Array(byteNumbers);

        byteArrays.push(byteArray);
    }

  var blob = new Blob(byteArrays, {type: contentType});
  return blob;
}

/**
* Cree un archivo PDF de acuerdo con el contenido de su base de datos64 únicamente.
* 
* @param folderpath {String} La carpeta donde se creará el archivo.
* @param filename {String} El nombre del archivo que se creará
* @param content {Base64 String}Importante: el contenido no puede contener la siguiente cadena  (data:application/pdf;base64). Only the base64 string is expected.
*/
function savebase64AsPDF(folderpath,filename,content,contentType){
// Convierta la cadena base64 en un Blob
var DataBlob = b64toBlob(content,contentType);

console.log("Starting to write the file :3");

window.resolveLocalFileSystemURL(folderpath, function(dir) {
    console.log("Access to the directory granted succesfully");
    dir.getFile(filename, {create:true}, function(file) {
        console.log("File created succesfully.");
        file.createWriter(function(fileWriter) {
            console.log("Writing content to file");
            fileWriter.write(DataBlob);
        }, function(){
            alert('Unable to save file in path '+ folderpath);
        });
    });
});
}