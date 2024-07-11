<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <div class="flex items-center justify-between w-full">
                <!-- Back Button-->
                <button @click="goBack" class="text-white">
                    <i class="fa-solid fa-circle-chevron-left"></i>
                </button>
                <h2 class="font-semibold text-lg text-white leading-tight mx-auto">
                    VISITAS / {{merchant.user.name}}
                </h2>
                <div class="w-8"></div> <!-- Placeholder to balance the flex layout -->
            </div>
        </template>

        <div class="max-w-2xl mx-auto">
            <div class="bg-white p-4">
                <div class="filters">
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div class="bg-red-500 text-white rounded-lg p-4 flex flex-col items-center">
                            <div class="text-2xl font-bold">{{ visits.length }}</div>
                            <div class="text-sm">Objetivo</div>
                        </div>
                        <div class="bg-green-500 text-white rounded-lg p-4 flex flex-col items-center">
                            <div class="text-2xl font-bold">{{ done_visits.length }}</div>
                            <div class="text-sm">Realizadas</div>
                        </div>
                        <div class="bg-yellow-500 text-white rounded-lg p-4 flex flex-col items-center">
                            <div class="text-2xl font-bold">{{ Object.keys(pending_visits).length }}</div>
                            <div class="text-sm">Pendientes</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-3 pt-6">
                <p>Visitas Pendientes</p>
                <PendingVisitsComponent v-for="pending_visit in pending_visits" :visit="pending_visit"
                    @scan="toggleQrModal" />
            </div>
            <div class="px-3 pt-6">
                <p>Visitas Realizadas</p>
                <DoneVisitsComponent v-for="done_visit in done_visits" :visit="done_visit" />
            </div>
        </div>
    </AdminLayout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import VisitComponent from './VisitComponent.vue';
import PendingVisitsComponent from './PendingVisitsComponent.vue';
import DoneVisitsComponent from './DoneVisitsComponent.vue';
import axios from 'axios';

export default {
    components: { AdminLayout, VisitComponent, PendingVisitsComponent, DoneVisitsComponent },
    props: [ 'merchant', 'visits', 'pending_visits', 'done_visits', 'date' ],
    data() {
        return {
            objetive: 10,
            done: 3,
            pending: 7,
            selectedDate: new Date().toISOString().substr(0, 10),
        };
    },
    mounted() {
    },
    methods: {
        goBack() {
            this.$inertia.get(route('admin.overviewMerchants'));
        },
    }
};
</script>