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
                    <button :class="{'text-red-500 border-b-2 border-red-500': isDetailsSelected, 'text-gray-500': !isDetailsSelected}" @click="selectDetails" class="pb-1 focus:outline-none">Detalles</button>
                    <button :class="{'text-red-500 border-b-2 border-red-500': !isDetailsSelected, 'text-gray-500': isDetailsSelected}" @click="selectPhotos" class="pb-1 focus:outline-none">Fotos Durante la Visita</button>
                </div>
                <div v-if="isDetailsSelected" class="mb-4">
                    <h3 class="font-semibold text-gray-700">Tiempos</h3>
                    <div class="grid grid-cols-3 gap-4 mt-2">
                        <div>
                            <label class="block text-gray-500">Llegada</label>
                            <div class="text-lg font-medium text-gray-900">{{ new Date(visit.visit_started_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true }) }}</div>
                        </div>
                        <div>
                            <label class="block text-gray-500">Salida</label>
                            <div class="text-lg font-medium text-gray-900">{{ new Date(visit.visit_ended_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true }) }}</div>
                        </div>
                        <div>
                            <label class="block text-gray-500">Tiempo</label>
                            <div class="text-lg font-medium text-gray-900">{{ calculateTotalTime(visit.visit_started_at, visit.visit_ended_at) }}</div>
                        </div>
                    </div>
                </div>
                <div v-if="isDetailsSelected" class="mb-4">
                    <h3 class="font-semibold text-gray-700">Ubicación - {{visit.point_of_sale.address}}</h3>
                    <div class="flex items-center space-x-4 mt-2">
                        <button :class="{'text-red-500 border-b-2 border-red-500': isStartSelected, 'text-gray-500': !isStartSelected}" @click="selectStart" class="pb-1 focus:outline-none">INICIO</button>
                        <button :class="{'text-red-500 border-b-2 border-red-500': !isStartSelected, 'text-gray-500': isStartSelected}" @click="selectEnd" class="pb-1 focus:outline-none">FINAL</button>
                    </div>
                    <div class="mt-2">
                        <iframe
                            :src="mapSrc"
                            width="800" height="500" style="border:0;" allowfullscreen="true" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" allow="geolocation"></iframe>
                    </div>
                </div>
                <div v-if="isDetailsSelected" class="mb-4">
                    <h3 class="font-semibold text-gray-700">Bitácora</h3>
                    <div class="p-4 bg-gray-100 rounded-md text-gray-700">
                        {{visit.visit_overview}}
                    </div>
                </div>
                <div v-if="!isDetailsSelected" class="mb-4">
                    <h3 class="font-semibold text-gray-700">Fotos Durante la Visita</h3>
                    <div class="carousel">
                        <div v-for="(photo, index) in visitPhotos" :key="index" class="carousel-item">
                            <img :src="photo" alt="Visit photo" class="w-full h-64 object-cover rounded-lg">
                        </div>
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
    props: ['visit'],
    data() {
        return {
            isDetailsSelected: true,
            isStartSelected: true
        };
    },
    computed: {
        mapSrc() {
            if (this.isStartSelected) {
                return `https://www.google.com/maps/embed/v1/place?key=AIzaSyD838-bKnRCBtmc2HgdkxH-GvykXOhUKWI&q=${this.visit.start_latitude},${this.visit.start_longitude}`;
            } else {
                return `https://www.google.com/maps/embed/v1/place?key=AIzaSyD838-bKnRCBtmc2HgdkxH-GvykXOhUKWI&q=${this.visit.end_latitude},${this.visit.end_longitude}`;
            }
        },
        visitPhotos() {
            return [this.visit.photo_url_1, this.visit.photo_url_2, this.visit.photo_url_3, this.visit.photo_url_4].filter(url => url);
        }
    },
    methods: {
        closeModal() {
            this.$emit('close');
        },
        selectDetails() {
            this.isDetailsSelected = true;
        },
        selectPhotos() {
            this.isDetailsSelected = false;
        },
        selectStart() {
            this.isStartSelected = true;
        },
        selectEnd() {
            this.isStartSelected = false;
        },
        calculateTotalTime(start, end) {
            const startTime = new Date(start);
            const endTime = new Date(end);
            const diffMs = endTime - startTime;
            const diffHrs = Math.floor(diffMs / 3600000);
            const diffMins = Math.floor((diffMs % 3600000) / 60000);
            return `${diffHrs}h ${diffMins}m`;
        }
    }
};
</script>
<style scoped>
iframe {
    max-width: 100%;
    height: auto;
}
.carousel {
    display: flex;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
}
.carousel-item {
    flex: none;
    width: 100%;
    scroll-snap-align: start;
    margin-right: 16px;
}
</style>