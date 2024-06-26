document.addEventListener("DOMContentLoaded", function() {
    var video = document.querySelector("#video");
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
            video.srcObject = stream;
            video.play();
        }).catch(function(error) {
            console.error("Error accessing the camera", error);
            alert("Error accessing the camera: " + error.message);
        });
    } else {
        alert("getUserMedia is not supported by your browser.");
    }

    document.getElementById("snap").addEventListener("click", function() {
        var canvas = document.getElementById("canvas");
        var context = canvas.getContext("2d");
        context.drawImage(video, 0, 0, 320, 240);
        canvas.toBlob(function(blob) {
            var fileInput = document.getElementById("image");
            var file = new File([blob], "capture.png", { type: "image/png" });
            var dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            fileInput.files = dataTransfer.files;
            alert("Image captured and added to the form!");
        });
    });
});
