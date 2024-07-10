<template>
    <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-10">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden w-11/12 max-w-2xl">
            <div class="p-4 border-b">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold">Detalles de la Visita</h2>
                    <button class="text-black" @click="$emit('close')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="p-4">
                <div class="flex space-x-4 mb-4">
                    <button class="text-red-500 border-b-2 border-red-500 pb-1 focus:outline-none">Detalles</button>
                    <button class="text-gray-500 pb-1 focus:outline-none">Fotos Durante la Visita</button>
                </div>
                <div class="mb-4">
                    <h3 class="font-semibold text-gray-700">Tiempos</h3>
                    <div class="grid grid-cols-3 gap-4 mt-2">
                        <div>
                            <label class="block text-gray-500">Llegada</label>
                            <div class="text-lg font-medium text-gray-900">10:30 AM</div>
                        </div>
                        <div>
                            <label class="block text-gray-500">Salida</label>
                            <div class="text-lg font-medium text-gray-900">11:00 AM</div>
                        </div>
                        <div>
                            <label class="block text-gray-500">Tiempo</label>
                            <div class="text-lg font-medium text-gray-900">30 Minutos</div>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <h3 class="font-semibold text-gray-700">Ubicación</h3>
                    <div class="flex items-center space-x-4 mt-2">
                        <button class="text-red-500 border-b-2 border-red-500 pb-1 focus:outline-none">INICIO</button>
                        <button class="text-gray-500 pb-1 focus:outline-none">FINAL</button>
                    </div>
                    <div class="mt-2 text-gray-700">Calle Las Redes 341, La Molina</div>
                    <div class="mt-2">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15606.484890621829!2d-76.94569140672685!3d-12.069561876416747!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c6c34f1fe2c7%3A0xa091f19f413baad7!2sBCP%20Sede%20Central!5e0!3m2!1ses-419!2spe!4v1719395879455!5m2!1ses-419!2spe"
                            width="800" height="500" style="border:0;" allowfullscreen="true" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" allow="geolocation"></iframe>
                    </div>
                </div>
                <div class="mb-4">
                    <h3 class="font-semibold text-gray-700">Bitácora</h3>
                    <div class="p-4 bg-gray-100 rounded-md text-gray-700">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tristique at ipsum sed
                        maximus. Nulla at aliquet neque, a pulvinar quam. Lorem ipsum dolor sit amet, consectetur
                        adipiscing elit.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    components: {},
    props: [''],
    data() {
        return {

        };
    },
    mounted() {

    },
    methods: {
        closeModal() {
            this.$emit('close');
        }
    }
};
</script>
<style scoped>
iframe {
    max-width: 100%;
    height: auto;
}
</style>