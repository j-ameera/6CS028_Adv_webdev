document.addEventListener("DOMContentLoaded", function() {
    // Select the video element
    var video = document.querySelector("#video");

    // Check for getUserMedia support and access the camera
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function(stream) {
                video.srcObject = stream;
                video.play();
            })
            .catch(function(error) {
                console.error("Error accessing the camera", error);
                alert("Error accessing the camera: " + error.message);
            });
    } else {
        alert("getUserMedia is not supported by your browser.");
    }

    // Capture the image when the snap button is clicked
    document.getElementById("snap").addEventListener("click", function() {
        var canvas = document.getElementById("canvas");
        var context = canvas.getContext("2d");

        // Draw the video frame on the canvas
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        // Convert canvas content to a blob
        canvas.toBlob(function(blob) {
            // Create a file from the blob
            var file = new File([blob], "capture.png", { type: "image/png" });

            // Create a DataTransfer object and add the file to it
            var dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);

            // Set the file input's files property to the new DataTransfer object
            var fileInput = document.getElementById("image");
            fileInput.files = dataTransfer.files;

            // Display a message confirming the capture
            alert("Image captured and added to the form!");

            // Display the captured image on the page
            var capturedImageContainer = document.getElementById("captured-image-container");
            var img = document.createElement("img");
            img.src = URL.createObjectURL(blob);
            img.classList.add('captured-image');  // Add class for styling

            // Clear previous images if needed
            capturedImageContainer.innerHTML = '';
            capturedImageContainer.appendChild(img);
        });
    });
});
