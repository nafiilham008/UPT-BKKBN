<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script src="{{ asset('css/app.css') }}"></script>
<style>
    @keyframes bar {
        from {
            width: 0%;
        }

        to {
            width: 100%;
        }
    }

    .darken {
        filter: brightness(0.4) contrast(1.1);
    }

    .grayout {
        filter: brightness(0.4) contrast(0.7);
    }

    .tint-blue {
        filter: sepia(1) contrast(0.6) hue-rotate(170deg) saturate(9) brightness(0.7);
    }

    .tint-teal {
        filter: sepia(1) contrast(0.7) hue-rotate(120deg) saturate(5) brightness(0.75);
    }

    .tint-red {
        filter: sepia(1) contrast(0.7) hue-rotate(-50deg) saturate(6) brightness(0.65);
    }

    .tint-green {
        filter: sepia(1) contrast(0.7) hue-rotate(80deg) saturate(4) brightness(0.7);
    }

    .tint-yellow {
        filter: sepia(1) contrast(0.6) hue-rotate(-5deg) saturate(7) brightness(0.65);
    }

    .tint-orange {
        filter: sepia(1) contrast(0.6) hue-rotate(-30deg) saturate(7) brightness(0.65);
    }

    .tint-purple {
        filter: sepia(1) contrast(0.65) hue-rotate(225deg) saturate(7) brightness(0.65);
    }

    .tint-pink {
        filter: sepia(1) contrast(0.75) hue-rotate(255deg) saturate(5) brightness(0.7);
    }

    .hero-section {
        height: 45vw;
        min-height: 500px;
        width: 100%;
        background: black;
    }

    .spotlight-container {
        /*   background: red; */
        height: 45vw;
        min-height: 500px;
        width: 100%;
        /*   overflow:hidden; */
        position: relative;
    }

    .slide-container {
        position: absolute;
        width: 100%;
        height: 45vw;
        min-height: 500px;
        transition-duration: 500ms;
    }

    .slide {
        position: absolute;
        z-index: 2;
        width: 100%;
        height: 45vw;
        min-height: 500px;
        background-image: url("/banner.png");
        background-repeat: no-repeat, repeat;
        background-position: center;
        background-size: cover;
    }

    .slide-2 {
        position: absolute;
        z-index: 2;
        width: 100%;
        height: 45vw;
        min-height: 500px;
        background-image: url("https://images.pexels.com/photos/380768/pexels-photo-380768.jpeg?cs=srgb&dl=pexels-marc-mueller-380768.jpg&fm=jpg");
        background-repeat: no-repeat, repeat;
        background-position: center;
        background-size: cover;
    }

    .slide-3 {
        position: absolute;
        z-index: 2;
        width: 100%;
        height: 45vw;
        min-height: 500px;
        background-image: url("https://images.pexels.com/photos/37347/office-sitting-room-executive-sitting.jpg?cs=srgb&dl=pexels-pixabay-37347.jpg&fm=jpg");
        background-repeat: no-repeat, repeat;
        background-position: center;
        background-size: cover;
    }

    .info-area-container {
        width: 100%;
        height: 100%;
        position: absolute;
        z-index: 5;
        background: none;
    }

    .info-area {
        width: calc(100% - 200px);
        max-width: 1000px;
        height: auto;
        margin-left: auto;
        margin-right: auto;
        margin-top: 0px;
        transition-duration: 400ms;
        transform: translateY(0px);
        opacity: 1;
    }

    .spacer-div {
        height: 12vw;
        height: 75%;
    }

    .slide-title {
        color: white;
        font-family: helvetica;
        font-size: 60px;
        margin-bottom: 0px;
        text-shadow: 0px 3px 10px rgba(0, 0, 0, 0.36);
        text-transform: uppercase;
        transition-duration: 200ms;
        transform: translateY(0px);
        filter: blur(0px);
        opacity: 1;
        cursor: default;
    }

    .slide-title:hover {
        transform: scale(1.01) translateY(-2px);
        text-shadow: 0px 10px 15px rgba(0, 0, 0, 0.3);
        transition-duration: 400ms;
    }

    .slide-sub-text {
        color: white;
        font-family: helvetica;
        font-weight: 200;
        font-size: 22px;
        margin-bottom: -20px;
        text-shadow: 0px 3px 10px rgba(0, 0, 0, 0.36);
        transition-duration: 200ms;
        transform: translateY(0px);
        filter: blur(0px);
        opacity: 1;
        cursor: default;
    }

    .slide-sub-text:hover {
        transform: scale(1.01) translateY(0px);
        text-shadow: 0px 6px 15px rgba(0, 0, 0, 0.3);
        transition-duration: 400ms;
    }

    .text-out {
        transform: translateY(70px);
        filter: blur(20px);
        opacity: 0;
    }

    .slide-button {
        cursor: pointer;
        display: block;
        margin-top: 50px;
        font-size: 20px;
        font-family: arial;
        padding: 20px 40px;
        border: none;
        border-radius: 50px;
        background: rgb(255, 0, 138);
        background: linear-gradient(0deg, rgba(255, 0, 138, 1) 0%, rgba(252, 216, 69, 1) 100%);
        text-shadow: 0px 3px 10px rgba(0, 0, 0, 0.36);
        color: white;
        text-transform: uppercase;
        box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.2);
        transition-duration: 400ms;
    }

    .slide-button:hover {
        filter: brightness(1.1) contrast(1.3);
        transform: scale(1.05);
        box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.2);
        transition-duration: 400ms;
    }

    .button-out {
        transform: scale(0);
        opacity: 0;
    }

    .next-sec {
        width: 100%;
        height: 500px;
        background: white;
        border-radius: 0px;
    }

    .ctrl-right {
        position: absolute;
        right: 0px;
        bottom: 50%;
        padding: 0px;
        font-size: 50px;
        border: none;
        background: rgba(0, 0, 0, 0.2);
        z-index: 8;
        cursor: pointer;
    }

    .ctrl-left {
        position: absolute;
        left: 0px;
        bottom: 50%;
        padding: 0px;
        font-size: 50px;
        border: none;
        background: rgba(0, 0, 0, 0.2);
        height: max-content;
        z-index: 8;
        cursor: pointer;
    }

    .ctrl-left:hover {
        background: rgba(0, 0, 0, 0.9);
    }

    .ctrl-right:hover {
        background: rgba(0, 0, 0, 0.9);
    }

    .out-left {
        transform: translateX(-100vw);
        height: 0px;
        transition-duration: 500ms;
    }

    .out-right {
        transform: translateX(100vw);
        height: 0px;
        transition-duration: 500ms;
    }

    .out-fade-down {
        transition-duration: 1000ms;
        transform: translateY(100px) rotate(0deg) scale(0.3);
        opacity: 0;
    }

    button:focus {
        outline: none;
    }

    .page-counter {
        background: none;
        position: absolute;
        bottom: 20px;
        width: 60px;
        height: 10px;
        z-index: 8;
        left: 50%;
        margin-left: -30px;
        display: flex;
        justify-content: space-around;
    }

    .page-ball {
        width: 10px;
        height: 10px;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 50px;
        transform: scale(0.5);
        transition-duration: 500ms;
    }

    .active-pb {
        background: white !important;
        transform: scale(1);
        transition-duration: 500ms;
    }

    .timer-bar {
        position: absolute;
        z-index: 9;
        bottom: 0;
        background: rgba(0, 0, 0, 0.35);
        backdrop-filter: blur(8px);
        width: calc(100% - 145px);
        height: 7px;
        left: 73px;
        border-bottom: 1px solid black;
    }

    .bar-inner {
        width: 100%;
        height: 6px;
        margin-top: 1px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 0px 50px 50px 0px;
    }

    .bar-anim {
        animation-name: bar;
        animation-duration: 10s;
        animation-iteration-count: infinite;
        animation-timing-function: linear;
    }

    .cover {
        object-fit: cover;
        width: 560px;
        height: 421px;
    }

    .cover2 {
        object-fit: cover;
        width: 295px;
        height: 180px;
    }

    .line-clamp {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    @media only screen and (max-width: 1200px) {
        .spacer-div {
            height: 8vw;
        }
    }

    @media only screen and (max-width: 1200px) {
        .spacer-div {
            height: 10vw;
        }

        .slide-title {
            font-size: 5vw;
        }

        .slide-sub-text {
            font-size: 2vw;
        }
    }

    @media only screen and (max-width: 1000px) {
        .spacer-div {
            height: 13vw;
        }

        .slide-title {
            font-size: 40px;
        }

        .slide-sub-text {
            font-size: 20px;
        }
    }

    @media only screen and (max-width: 600px) {
        .spacer-div {
            height: 25vw;
        }

        .slide-title {
            font-size: 30px;
        }

        .slide-sub-text {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .slide-button {
            font-size: 14px;
            margin-top: 20px;
        }

        .info-area {
            width: calc(100% - 40px);
        }
    }
</style>
