<template>
    <div class="modal">
        <div class="loader"></div>
    </div>
</template>

<style scoped>
.modal {
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
}

.loader {
    width: 40px;
    aspect-ratio: 1;
    color: #f03355;
    position: relative;
    background: radial-gradient(10px, currentColor 94%, #0000);
}

.loader:before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 50%;
    background:
        radial-gradient(9px at bottom right, #0000 94%, currentColor) top left,
        radial-gradient(9px at bottom left, #0000 94%, currentColor) top right,
        radial-gradient(9px at top right, #0000 94%, currentColor) bottom left,
        radial-gradient(9px at top left, #0000 94%, currentColor) bottom right;
    background-size: 20px 20px;
    background-repeat: no-repeat;
    animation: l18 1.5s infinite cubic-bezier(0.3, 1, 0, 1);
}

@keyframes l18 {
    33% {
        inset: -10px;
        transform: rotate(0deg)
    }

    66% {
        inset: -10px;
        transform: rotate(90deg)
    }

    100% {
        inset: 0;
        transform: rotate(90deg)
    }
}
</style>