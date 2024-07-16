<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-lg text-white leading-tight text-center ">
                En Visita - {{ visit.point_of_sale.name }} - {{ visit.status }}
            </h2>
        </template>
        <div class="max-w-2xl mx-auto">
            <div class="bg-white p-4">
                <h3 class="text-center text-red-ac text-2xl font-bold">
                    {{ time_passed }}
                </h3>
            </div>
            <div class="px-3 pt-6">
                <h3 class="font-bold subtitles">Hora Registrada</h3>
                <p class="font-medium">{{ new Date(visit.visit_started_at).toLocaleTimeString() }}</p>
            </div>
            <div class="px-3 pt-6">
                <h3 class="font-bold subtitles">Tomar Fotos</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div v-for="(photo, index) in photos" :key="index" class="relative">
                        <img :src="photo.url" alt="Captured photo" class="w-full h-32 object-cover rounded-lg">
                        <button @click="removePhoto(index)"
                            class="absolute top-1 right-1 bg-red-500 text-white p-1 rounded-full">
                            &times;
                        </button>
                    </div>
                    <div v-if="photos.length < 4"
                        class="flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg h-32">
                        <button @click="capturePhoto" class="text-gray-500">+</button>
                    </div>
                </div>
            </div>

            <div class="px-3 pt-6">
                <h3 class="font-bold subtitles">Bitácora</h3>
                <textarea v-model="description" class="w-full p-2 border rounded-lg" rows="4"
                    placeholder="Observaciones (opcional)">
        </textarea>
            </div>
            <div class="p-4">
                <button type="submit" @click="endVisit"
                    class="mt-2 bg-red-ac text-white w-full px-4 py-2 rounded-md hover:bg-red-600 transition font-bold">Enviar</button>

                <button type="submit" @click=""
                    class="mt-2 bg-white text-black border border-black w-full px-4 py-2 rounded-md hover:bg-red-600 transition font-bold">Cancelar
                    Visita</button>
            </div>
        </div>
    </AdminLayout>
</template>
<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import axios from 'axios';
export default {
    props: ['visit'],
    components: { AdminLayout },
    data() {
        return {
            time_passed: 0,
            intervalId: null,
            photos: [],
            description: ''
        };
    },
    created() {
        this.startTimer();
    },
    beforeDestroy() {
        clearInterval(this.intervalId);
    },
    methods: {
        startTimer() {
            const visitStartedAt = new Date(this.visit.visit_started_at);
            this.intervalId = setInterval(() => {
                const now = new Date();
                const timeDiff = now - visitStartedAt;
                this.time_passed = this.formatTime(timeDiff);
            }, 1000);
        },
        formatTime(ms) {
            const totalSeconds = Math.floor(ms / 1000);
            const hours = Math.floor(totalSeconds / 3600);
            const minutes = Math.floor((totalSeconds % 3600) / 60);
            const seconds = totalSeconds % 60;
            return `${hours}h ${minutes}m ${seconds}s`;
        },
        capturePhoto() {
            const video = document.createElement('video');
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');

            navigator.mediaDevices.getUserMedia({ video: true })
                .then((stream) => {
                    video.srcObject = stream;
                    video.play();

                    video.addEventListener('loadeddata', () => {
                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;
                        context.drawImage(video, 0, 0, canvas.width, canvas.height);
                        const url = canvas.toDataURL('image/png');
                        if (this.photos.length < 4) {
                            this.photos.push({ url, file: this.dataURLtoFile(url, 'photo.png') });
                        } else {
                            alert('You can upload a maximum of 4 photos.');
                        }
                        stream.getTracks().forEach(track => track.stop());
                    });
                })
                .catch((error) => {
                    console.error('Error accessing camera:', error);
                });
        },
        dataURLtoFile(dataurl, filename) {
            const arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
                bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
            while (n--) {
                u8arr[n] = bstr.charCodeAt(n);
            }
            return new File([u8arr], filename, { type: mime });
        },
        removePhoto(index) {
            this.photos.splice(index, 1);
        },
        async endVisit() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(async (position) => {
                const { latitude, longitude } = position.coords;
                try {
                    const formData = new FormData();
                    formData.append('visit_id', this.visit.id);
                    formData.append('end_latitude', latitude);
                    formData.append('end_longitude', longitude);
                    formData.append('visit_overview', this.description);
                    this.photos.slice(0, 4).forEach((photo, index) => {
                        formData.append(`photos[${index}]`, photo.file);
                    });

                    const response = await axios.post(route('merchant.endVisit'), formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });
                    console.log('Visit ended:', response.data);
                    window.location.href = route('merchant.home');
                } catch (error) {
                    console.error('Error ending visit:', error);
                }
            }, (error) => {
                console.error('Error getting location:', error);
            });
        } else {
            console.error('Geolocation is not supported by this browser.');
        }
    }
    }
};
</script>
<style>
.subtitles {
    font-size: 1.3rem;
}
</style>