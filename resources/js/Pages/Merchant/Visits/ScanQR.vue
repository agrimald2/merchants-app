<template>
    <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-10">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden w-11/12 max-w-2xl">
            <div class="p-4 border-b">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold">Escanear Código QR</h2>
                    <button class="text-black" @click="closeModal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="p-4">
                <div v-if="!qrScanned">
                    <video id="preview" class="w-full"></video>
                </div>
                <div class="mt-4">
                    <label for="manualCode" class="block text-gray-700">Ingresar Código Manualmente</label>
                    <input id="manualCode" type="text" v-model="manualCode"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Ingresa el código manualmente" />
                    <label v-if="errorText" for="manualCode" class="block text-red-700">{{errorText}}</label>
                    <button type="submit" @click="submitCode"
                        class="mt-2 bg-red-ac text-white w-full px-4 py-2 rounded-md hover:bg-red-600 transition font-bold">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import QrScanner from 'qr-scanner';
import 'qr-scanner/qr-scanner-worker.min.js';
import axios from 'axios';

export default {
    data() {
        return {
            manualCode: '',
            qrScanned: false,
            errorText: null
        };
    },
    mounted() {
        this.initQrScanner();
    },
    methods: {
        closeModal() {
            this.$emit('close');
        },
        initQrScanner() {
            const video = document.getElementById('preview');
            const qrScanner = new QrScanner(video, result => this.onQrScanned(result));
            qrScanner.start();
        },
        onQrScanned(result) {
            this.qrScanned = true;
            this.manualCode = result;
            this.$emit('qrScanned', result);
            this.submitCode();
        },
        async submitCode() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(async (position) => {
                    const { latitude, longitude } = position.coords;
                    try {
                        const response = await axios.post(route('merchant.startVisit'), {
                            code: this.manualCode,
                            start_latitude: latitude,
                            start_longitude: longitude
                        });
                        console.log('Visit started:', response.data);
                        window.location.href = route('merchant.view.visit', { id: response.data.id });
                        this.closeModal();
                    } catch (error) {
                        console.error('Error starting visit:', error);
                        this.errorText = `Error Code 1: ${error.message}`;
                    }
                }, (error) => {
                    console.error('Error getting location:', error);
                    this.errorText = `Error Code 2: ${error.message}`;
                });
            } else {
                console.error('Geolocation is not supported by this browser.');
                this.errorText = 'Not supported by this browser';
            }
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