<template>
    <div class="bg-white pt-2 pb-2 px-3 rounded-lg shadow-md flex items-center justify-between space-x-4 my-3">
        <div class="flex items-center">
            <div class="flex items-center space-x-2">
                <div>
                    <div class="flex items-center">
                        <i class="fa-solid fa-user"></i>
                        <div class="font-bold text-gray-900 ml-2">{{ visit.point_of_sale.code }} - {{ visit.point_of_sale.name }}</div>
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
                            @click="toggleQRModal">
                            <i class="fa-solid fa-qrcode mr-2"></i>
                            Marcar Visita
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
    components: {  },
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
            console.log("Hola1");
            this.$emit('scan');
        }
    }
};
</script>