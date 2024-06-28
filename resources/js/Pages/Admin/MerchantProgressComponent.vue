<template>
    <div class="bg-white pt-2 pb-2 px-3 rounded-lg shadow-md flex items-center justify-between space-x-4 my-3">
        <div class="flex items-center">
            <div class="flex items-center space-x-2">
                <div>
                    <div class="flex items-center">
                        <i class="fa-solid fa-user"></i>
                        <div class="font-bold text-gray-900 ml-2">Salvador Palacios</div>
                    </div>
                    <div class="flex items-center">
                        <i class="fa-solid fa-list-check"></i>
                        <div class="font-bold text-gray-900 ml-2">5 / 10</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right border-l border-gray-200 pl-2">
            <div class="flex items-center space-x-2">
                <div>
                    <div class="flex items-center w-full">
                        <div class="relative pt-1 w-full">
                            <div class="flex mb-2 items-center justify-between">
                                <div>
                                    <span
                                        class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-blue-600 bg-blue-200">
                                        50%
                                    </span>
                                </div>
                            </div>
                            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-blue-200 w-full">
                                <div style="width:50%"
                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-600">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <button
                            class="bg-black text-white px-5 py-1 rounded-md inline-flex items-center w-full font-bold">
                            <i class="fa-solid fa-eye mr-2"></i>
                            Visitas
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
    props: [''],
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