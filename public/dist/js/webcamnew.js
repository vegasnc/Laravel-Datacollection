feather.replace();

const controls = document.querySelector('.controls');
const cameraOptions = document.querySelector('.video-options>select');
const video = document.querySelector('video');
const canvas = document.querySelector('canvas');
const screenshotImage = document.querySelector('img');
const buttons = [...controls.querySelectorAll('button')];
let streamStarted = false;

const [play, pause, screenshot] = buttons;

const constraints = {
  video: {
    width: {
      min: 1280,
      ideal: 1920,
      max: 2560,
    },
    height: {
      min: 720,
      ideal: 1080,
      max: 1440
    },
    facingMode: {
      exact: 'environment'
    },
  }
};

const getCameraSelection = async () => {
  const devices = await navigator.mediaDevices?.enumerateDevices();
  const videoDevices = devices.filter((device) => device.kind === "videoinput");
  if (videoDevices[0]) {
      //TODO find the other cameras on the phone
      // document.querySelector("body").innerHTML = JSON.stringify(devices)
      return videoDevices[0];
  } else {
      return null;
  }
};

$(document).ready(function() {
  // debugger;
  getCameraSelection().then((r) => {
      sessionStorage.setItem(
          "camera",
          JSON.stringify({
              ...constraints,
              deviceId: { exact: r.deviceId },
          })
      );
  }).catch(
      (e) => {
        console.log(e)
      }
  );

  $("#btn_capture").on('click', ()=> {
    $("#photosection").show();
    if (streamStarted) {
      video.play();
      return;
    }
    if ('mediaDevices' in navigator && navigator.mediaDevices.getUserMedia) {
      if (sessionStorage.getItem("camera")) {
        startStream(JSON.parse(sessionStorage.getItem("camera")));
      }
    }
  })

});


const startStream = async (constraints) => {
  const stream = await navigator.mediaDevices.getUserMedia(constraints);
  handleStream(stream);
};

const handleStream = (stream) => {
  video.srcObject = stream;
  streamStarted = true;
  $("#btn_screenshot").removeClass("d-none");
};

const doScreenshot = () => {
  canvas.width = video.videoWidth;
  canvas.height = video.videoHeight;
  canvas.getContext('2d').drawImage(video, 0, 0);

  screenshotImage.src = canvas.toDataURL('image/webp');
  $("#photoData").val(canvas.toDataURL('image/webp'));
  screenshotImage.classList.remove('d-none');

  $("#btn_screenshot").addClass("d-none");
  video.pause();
};

$("#btn_screenshot").on("click", doScreenshot);