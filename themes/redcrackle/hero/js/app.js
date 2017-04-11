/* -----------------------------------------------
/* How to use? : Check the GitHub README
/* ----------------------------------------------- */

/* To load a config file (particles.json) you need to host this demo (MAMP/WAMP/local)... */
/*
particlesJS.load('particles-js', 'particles.json', function() {
  console.log('particles.js loaded - callback');
});
*/
//
///* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
//particlesJS.load('particles-js', 'particles.json', function() {
//  console.log('callback - particles.js config loaded');
//});

/* Otherwise just put the config content (json): */

particlesJS('particles-js',
    {
      "particles": {
        "number": {
          "value": 50,
          "density": {
            "enable": true,
            "value_area": 950
          }
        },
        "color": {
          "value": "#717c89"
        },
        "shape": {
          "type": "image",
          "stroke": {
            "width": 0,
            "color": "#717c89"
          },
          "polygon": {
            "nb_sides": 4
          },
          "image": {
            "src": "https://d35408cyocioye.cloudfront.net/legacy/hex10a.png",
            "width": 87,
            "height": 100
          }
        },
        "opacity": {
          "value": 0.5,
          "random": false,
          "anim": {
            "enable": false,
            "speed": 0.959040959040959,
            "opacity_min": 0.1,
            "sync": false
          }
        },
        "size": {
          "value": 4,
          "random": true,
          "anim": {
            "enable": false,
            "speed": 40,
            "size_min": 0.1,
            "sync": false
          }
        },
        "line_linked": {
          "enable": true,
          "distance": 160,
          "color": "#a3b6b4",
          "opacity": 0.25,
          "width": 2
        },
        "move": {
          "enable": true,
          "speed": 6,
          "direction": "none",
          "random": false,
          "straight": false,
          "out_mode": "out",
          "bounce": false,
          "attract": {
            "enable": false,
            "rotateX": 700,
            "rotateY": 1200
          }
        }
      },
      "interactivity": {
        "detect_on": "canvas",
        "events": {
          "onhover": {
            "enable": true,
            "mode": "grab"
          },
          "onclick": {
            "enable": true,
            "mode": "push"
          },
          "resize": true
        },
        "modes": {
          "grab": {
            "distance": 400,
            "line_linked": {
              "opacity": 1
            }
          },
          "bubble": {
            "distance": 400,
            "size": 40,
            "duration": 2,
            "opacity": 8,
            "speed": 3
          },
          "repulse": {
            "distance": 200,
            "duration": 0.4
          },
          "push": {
            "particles_nb": 4
          },
          "remove": {
            "particles_nb": 2
          }
        }
      },
      "retina_detect": true
    }
);