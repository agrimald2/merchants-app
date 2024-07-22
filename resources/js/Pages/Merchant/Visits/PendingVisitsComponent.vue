<template>
    <div
        class="bg-white pt-2 pb-2 px-3 rounded-lg shadow-md flex items-center justify-between space-x-4 my-3 border border-red-500">
        <div class="flex items-center">
            <div class="flex items-center space-x-2">
                <div>
                    <div class="flex items-center">
                        <i class="fa-solid fa-user"></i>
                        <div class="font-bold text-gray-900 ml-2">{{ visit.point_of_sale.code }} - {{
                            visit.point_of_sale.name }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right border-l border-gray-200 pl-2">
            <div class="flex items-center space-x-2">
                <div>
                    <div class="flex items-center">
                        <button
                            class="bg-red-ac text-white px-5 py-1 rounded-md inline-flex items-center w-full font-bold"
                            @click="startVisit">
                            <i class="fa-solid fa-qrcode mr-2"></i>
                            Visitar
                        </button>
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
            isModalVisible: false
        };
    },
    mounted() {

    },
    methods: {
        toggleQRModal() {
            this.$emit('scan');
        },
        startVisit() {
            console.log(this.visit.id);
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(async (position) => {
                    const { latitude, longitude } = position.coords;
                    try {
                        const response = await axios.post(route('merchant.startVisit'), {
                            code: this.visit.point_of_sale.code,
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
                    if (error.code === error.PERMISSION_DENIED) {
                        alert('Activa los permisos de ubicación para realizar una visita.');
                    }
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