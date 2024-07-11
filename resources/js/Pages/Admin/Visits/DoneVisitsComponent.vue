<template>
    <div class="bg-white pt-2 pb-2 px-3 rounded-lg shadow-md flex items-center justify-between space-x-4 my-3">
        <div class="flex items-center">
            <div class="flex items-center space-x-2">
                <div>
                    <div class="flex items-center">
                        <i class="fa-solid fa-user"></i>
                        <div class="font-bold text-gray-900 ml-2">{{ visit.point_of_sale.code }} -
                            {{ visit.point_of_sale.name }}</div>
                    </div>
                    <div class="flex items-center">
                        <i class="fa-solid fa-clock"></i>
                        <div class="font-medium text-gray-900 ml-2">{{ new
                            Date(visit.visit_started_at).toLocaleTimeString() }} - {{ new
                            Date(visit.visit_ended_at).toLocaleTimeString() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right border-l border-gray-200 pl-2">
            <div class="flex items-center space-x-2">
                <div>
                    <div class="flex items-center">
                        <div class="font-medium text-gray-900">{{ calculateTotalTime(visit.visit_started_at,
                            visit.visit_ended_at) }}</div>
                    </div>
                    <div class="flex items-center">
                        <button
                            class="bg-black text-white px-5 py-1 rounded-md inline-flex items-center w-full font-bold"
                            @click="toggleModal">
                            <i class="fa-solid fa-eye mr-2"></i>
                            Detalles
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <VisitDetailsModal v-if="isModalVisible" @close="toggleModal" :visit="visit" />
</template>
<script>
import axios from 'axios';
import VisitDetailsModal from './VisitDetailsModal.vue';

export default {
    components: { VisitDetailsModal },
    props: ['visit'],
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