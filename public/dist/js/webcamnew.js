feather.replace();

const controls = document.querySelector('.controls');
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
    }
    // facingMode: {
    //   exact: 'environment'
    // },
    // facingMode: "environment"
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

const ios = () => {
  if (typeof window === `undefined` || typeof navigator === `undefined`) return false;

  return /iPhone|iPad|iPod/i.test(navigator.userAgent || navigator.vendor || (window.opera && opera.toString() === `[object Opera]`));
};

$(document).ready(function() {
  const isiPhone = ios();

  if( !isiPhone ) {
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
  }

  $("#btn_capture").on('click', ()=> {
    if( isiPhone ) {
      $("#btn_ios_capture").click();
    } else {
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
    }
  })
});

const handleImageSelect = (event) => {
  $("#iosphotosection").show();
  const file = event.target.files[0];
  const fileReader = new FileReader();
  fileReader.onload = function() {
      const image = new Image();
      image.src = fileReader.result;
      image.className = "ios-img";
      $("#photoData").val(fileReader.result);
      $("#iosphotosection").html(image);
  }

  fileReader.readAsDataURL(file);
}


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