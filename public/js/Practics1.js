function func(audioId) {
  let myaudio = document.getElementById(audioId);
  const playIcon = document.getElementById('playIcon-' + audioId);
  const pauseIcon = document.getElementById('pauseIcon-' + audioId);

  if (myaudio.paused) {
    myaudio.play();
    playIcon.style.display = 'none';
    pauseIcon.style.display = 'block';
  } else {
    myaudio.pause();
    playIcon.style.display = 'block';
    pauseIcon.style.display = 'none';
  }
  if (event) {
    event.preventDefault();
  }
}
let like = false;
// function likefunc() {
  //   console.log(likeicon);
  //   console.log(unlikeicon);
  // document.addEventListener("DOMContentLoaded", function() {
  //   let likeStates = Array.from({ length: {{ count($data) }} }, () => true);

//     function likefunc(index) {
//         const likeIcon = document.getElementsByClassName("like")[index];
//         const unlikeIcon = document.getElementsByClassName("unlike")[index];
//         const num = document.getElementsByClassName("list-number")[index];

//         if (likeStates[index]) {
//             likeIcon.style.display = "none";
//             unlikeIcon.style.display = "block";
//             likeStates[index] = false;
//             num.style.color = "white";
//         } else {
//             likeIcon.style.display = "block";
//             unlikeIcon.style.display = "none";
//             likeStates[index] = true;
//             num.style.color = "green";
//         }
//     }

//     // Attach the click event to each like button
//     const likeButtons = document.querySelectorAll('.list-number');
//     likeButtons.forEach((button, index) => {
//         button.addEventListener('click', () => likefunc(index));
//     });
// // });
  //   param.style.display = "none";
  function likefunc(id) {
    const likeicon = document.querySelector(`#like-${id}`);
    const unlikeicon = document.querySelector(`#unlike-${id}`);
    const num = document.querySelector(`#list-number-${id}`);

    if (!likeicon || !unlikeicon || !num) {
        console.error(`Elements with ID like-${id}, unlike-${id}, or list-number-${id} not found.`);
        return;
    }

    // Ensure likeStates is defined globally
    window.likeStates = window.likeStates || {};

    // Toggle the like state and update icon backgrounds
    likeStates[id] = !likeStates[id];

    if (likeStates[id]) {
      // console.log('if case run');
        likeicon.style.display = "block";
        unlikeicon.style.display = "none  ";
        // unlikeicon.style.fill = "black"; 
        num.style.color = "green";
    } else {
      // console.log('else case run');

        likeicon.style.display = "none";
        unlikeicon.style.display = "block";
        // unlikeicon.style.fill = "red"; 
        num.style.color = "white";
    }
    if (event) {
      event.preventDefault();
    }
}

  


