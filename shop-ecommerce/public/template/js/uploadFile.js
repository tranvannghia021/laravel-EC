
function ImagesFileAsURL(id,divimg) {
    var fileSelected = document.getElementById(id).files;
    if (fileSelected.length > 0) {
        var fileToLoad = fileSelected[0];
        var fileReader = new FileReader();
        fileReader.onload = function(fileLoaderEvent) {
            var srcData = fileLoaderEvent.target.result;
            var newImage = document.createElement('img');
            newImage.src = srcData;
            newImage.style.width=200+'px';
            document.getElementById(divimg).innerHTML = newImage.outerHTML;
        }
        fileReader.readAsDataURL(fileToLoad);
    }
}
function GetValuefile($id,$idshow){
    const name=document.getElementById($id).value;
    const fileName=name.slice(12);
    const label=document.getElementById($idshow);
   label.innerHTML=`<p>${fileName}</p>`;
    


}
