<template>
    <div @click="() => $inertia.get(route('admin.visits'))" class="bg-white pt-2 pb-2 px-3 rounded-lg shadow-md flex items-center justify-between space-x-4 my-3 w-full transition-transform transform hover:scale-105 active:scale-95 cursor-pointer">
        <div class="w-full">
            <div :class="progressBarBgColor" class="relative overflow-hidden h-2 mb-1 text-xs flex rounded w-full">
                <div :style="{ width: `${progressPercentage}%` }"
                    :class="progressBarColor"
                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center">
                </div>
            </div>
            <div class="grid grid-cols-8 w-full py-2">
                <div class="flex items-center col-span-4">
                    <i class="fa-solid fa-user mr-1"></i>
                    <div class="font-bold text-gray-900">{{ merchantProgress.name }}</div>
                </div>
                <div class="flex items-center col-span-2">
                    <div class="flex items-center">
                        <div :class="progressTextColor" class="font-bold rounded mr-1 py-1 px-2 text-white">{{ merchantProgress.done }}</div>
                        <span class="text-xl font-bold">/</span>
                        <div :class="progressTextColor" class="font-bold rounded ml-1 py-1 px-2 text-white">{{ merchantProgress.total }}</div>
                    </div>
                </div>
                <div class="flex items-center col-span-2">
                    <span :class="progressLabelColor"
                        class="text-md font-semibold inline-block py-1 px-4 uppercase rounded-full">
                        {{ progressPercentage }}%
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    components: {},
    props: ['merchantProgress'],
    data() {
        return {
            isModalVisible: false
        };
    },
    computed: {
        progressPercentage() {
            return Math.floor((this.merchantProgress.done / this.merchantProgress.total) * 100);
        },
        progressBarColor() {
            if (this.progressPercentage <= 59) {
                return 'bg-red-500';
            } else if (this.progressPercentage <= 79) {
                return 'bg-yellow-500';
            } else {
                return 'bg-green-500';
            }
        },
        progressBarBgColor() {
            if (this.progressPercentage <= 59) {
                return 'bg-red-200';
            } else if (this.progressPercentage <= 79) {
                return 'bg-yellow-200';
            } else {
                return 'bg-green-200';
            }
        },
        progressTextColor() {
            if (this.progressPercentage <= 59) {
                return 'bg-red-700';
            } else if (this.progressPercentage <= 79) {
                return 'bg-yellow-700';
            } else {
                return 'bg-green-700';
            }
        },
        progressLabelColor() {
            if (this.progressPercentage <= 59) {
                return 'text-red-600 bg-red-200';
            } else if (this.progressPercentage <= 79) {
                return 'text-yellow-600 bg-yellow-200';
            } else {
                return 'text-green-600 bg-green-200';
            }
        }
    },
    mounted() {

    },
    methods: {

    }
};
</script>