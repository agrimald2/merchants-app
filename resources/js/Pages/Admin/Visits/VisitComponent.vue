<template>
    <div class="bg-white pt-2 pb-2 px-3 rounded-lg shadow-md flex items-center justify-between space-x-4 my-3">
        <div class="flex items-center">
            <div class="flex items-center space-x-2">
                <div>
                    <div class="flex items-center">
                        <i class="fa-solid fa-user"></i>
                        <div class="font-bold text-gray-900 ml-2">93921823 - Luis Rosales</div>
                    </div>
                    <div class="flex items-center">
                        <i class="fa-solid fa-clock"></i>
                        <div class="font-medium text-gray-900 ml-2">30 Minutos</div>
                    </div>
                    <div class="flex items-center">
                        <i class="fa-regular fa-face-smile"></i>
                        <div class="text-gray-500 ml-2">Salvador Merca</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right border-l border-gray-200 pl-2">
            <div class="flex items-center space-x-2">
                <div>
                    <div class="flex items-center">
                        <div class="font-bold text-gray-900">Lun 18 Junio</div>
                    </div>
                    <div class="flex items-center">
                        <div class="font-medium text-gray-900">30 Minutos</div>
                    </div>
                    <div class="flex items-center">
                        <button
                            class="bg-black text-white px-5 py-1 rounded-md inline-flex items-center w-full font-bold" @click="toggleModal">
                            <i class="fa-solid fa-eye mr-2"></i>
                            Detalles
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <VisitDetailsModal v-if="isModalVisible" @close="toggleModal" />
</template>

<script>
import axios from 'axios';
import VisitDetailsModal from './VisitDetailsModal.vue';

export default {
    components: { VisitDetailsModal },
    props: [''],
    data() {
        return {
            isModalVisible: false
        };
    },
    mounted() {

    },
    methods: {
        toggleModal() {
            this.isModalVisible = !this.isModalVisible;
        }
    }
};
</script>