<div id="loader-wrapper"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black transition-opacity duration-1000">
    <div class="loader-content flex flex-col items-center">
        <svg width="300" height="200" viewBox="0 0 300 200" class="flex items-center justify-center">
            <text x="50%" y="70%" text-anchor="middle" class="elegant-text">19</text>
        </svg>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap');

    .elegant-text {
        font-family: 'Abril Fatface', cursive;
        font-size: 150px;
        fill: transparent;
        stroke: white;
        stroke-width: 2px;
        stroke-dasharray: 500;
        stroke-dashoffset: 500;
        animation: elegantDraw 3s forwards infinite;
    }

    @keyframes elegantDraw {
        0% {
            stroke-dashoffset: 500;
            fill: transparent;
        }

        50% {
            stroke-dashoffset: 0;
            fill: transparent;
        }

        100% {
            stroke-dashoffset: 0;
            fill: white;
        }
    }

    .loader-hidden {
        opacity: 0;
        pointer-events: none;
    }
</style>

<script>
    window.addEventListener('load', function () {
        const loader = document.getElementById('loader-wrapper');
        setTimeout(() => {
            loader.classList.add('loader-hidden');
        }, 3000);
    });
</script>