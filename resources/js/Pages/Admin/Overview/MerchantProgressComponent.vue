<template>
    <div class="bg-white pt-2 pb-2 px-3 rounded-lg shadow-md flex items-center justify-between space-x-4 my-3 w-full">
        <div class="w-full">
            <div class="relative overflow-hidden h-2 mb-1 text-xs flex rounded bg-red-200 w-full">
                <div :style="{ width: `${(merchantProgress.done / merchantProgress.total) * 100}%` }"
                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-red-ac">
                </div>
            </div>
            <div class="grid grid-cols-8 w-full py-2">
                <div class="flex items-center col-span-4">
                    <i class="fa-solid fa-user mr-1"></i>
                    <div class="font-bold text-gray-900">{{ merchantProgress.name }}</div>
                </div>
                <div class="flex items-center col-span-2">
                    <div class="flex items-center">
                        <div class="font-bold text-gray-900 bg-red-700 rounded mr-1 py-1 px-2 text-white">{{ merchantProgress.done }}</div>
                        <span class="text-xl font-bold">/</span>
                        <div class="font-bold text-gray-900 bg-red-900 rounded ml-1 py-1 px-2 text-white">{{ merchantProgress.total }}</div>
                    </div>
                </div>
                <div class="flex items-center col-span-2">
                    <span
                        class="text-md font-semibold inline-block py-1 px-4 uppercase rounded-full text-red-600 bg-red-200">
                        {{ Math.floor((merchantProgress.done / merchantProgress.total) * 100) }}%
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
    mounted() {

    },
    methods: {

    }
};
</script>