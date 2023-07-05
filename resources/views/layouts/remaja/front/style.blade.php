<link
    href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@100;200;300;400;500;600;700;800;900|Poppins:400,700|Titan+One&display=swap"
    rel="stylesheet">

<style>
    @import url('https://rsms.me/inter/inter.css');
    @import url('https://fonts.googleapis.com/css2?family=Titan+One&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');
    .font-be-vietnam {
        font-family: 'Be Vietnam Pro', sans-serif;
    }

    .font-titan {
        font-family: 'Titan One', cursive;
    }

    .font-poppins {
        font-family: 'Poppins', sans-serif;
    }
    .font-inter {
        font-family: 'Inter', sans-serif;
    }

    .bg {
        background: linear-gradient(137deg, #DFF2FF 0%, #DFF2FF 0.01%, #BCCAFF 100%);

    }

    .box-shadow {
        box-shadow: -2px -1px 14px 0px rgba(133, 145, 255, 0.30);
        backdrop-filter: blur(35px);
    }

    .button-shadow {
        box-shadow: 2px 4px 17px 0px rgba(12, 0, 86, 0.25);
    }

    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(137deg, #DFF2FF 0%, #DFF2FF 0.01%, #BCCAFF 100%);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
    }

    .loading-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .loading-spinner {
        display: inline-block;
        width: 50px;
        height: 50px;
        border: 3px solid #ffffff;
        border-top-color: #3498db;
        border-radius: 50%;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
