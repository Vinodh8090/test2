export const getPermissions = () => {
  console.log("Checking for navigator.mediaDevices...");

  if (!navigator.mediaDevices) {
    console.warn(
      "navigator.mediaDevices is not defined. Creating an empty object."
    );
    navigator.mediaDevices = {};
  }

  console.log("Checking for navigator.mediaDevices.getUserMedia...");

  if (!navigator.mediaDevices.getUserMedia) {
    console.warn(
      "navigator.mediaDevices.getUserMedia is not defined. Providing a polyfill."
    );

    navigator.mediaDevices.getUserMedia = function (constraints) {
      const getUserMedia =
        navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

      if (!getUserMedia) {
        console.error("getUserMedia is not implemented in this browser.");
        return Promise.reject(
          new Error("getUserMedia is not implemented in this browser")
        );
      }

      console.log(
        "Using legacy getUserMedia via webkitGetUserMedia or mozGetUserMedia."
      );
      return new Promise((resolve, reject) => {
        getUserMedia.call(navigator, constraints, resolve, reject);
      });
    };
  }

  console.log("Requesting media permissions for video and audio...");

  return navigator.mediaDevices
    .getUserMedia({ video: true, audio: true })
    .then((stream) => {
      console.log("Media stream obtained successfully.");
      return stream;
    })
    .catch((err) => {
      console.error("Error accessing media devices:", err);
      alert(
        "Could not access your camera and microphone. Please ensure you have given the necessary permissions."
      );
      return Promise.reject(err);
    });
};
